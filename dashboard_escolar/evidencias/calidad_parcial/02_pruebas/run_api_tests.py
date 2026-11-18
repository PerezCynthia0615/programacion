import sys, os, shutil, subprocess, sqlite3, json, time, urllib.request, urllib.error
ver, src, out, port = sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4]
import tempfile; S=tempfile.mkdtemp()
run=f'{S}/run_{ver}'; shutil.rmtree(run, ignore_errors=True); shutil.copytree(src, run)
db=f'{run}/test.sqlite'
c=sqlite3.connect(db)
c.executescript("""
CREATE TABLE materias(id INTEGER PRIMARY KEY AUTOINCREMENT,nombre TEXT,modulo TEXT,submodulo TEXT,semestre INTEGER,descripcion,activo DEFAULT 1);
INSERT INTO materias(nombre,modulo,submodulo,semestre,descripcion) VALUES
('Procesamiento de Lenguaje Natural','Módulo II','Sub 2',3,'x'),('Implementa aplicaciones web','Módulo IV','Sub 2',NULL,'y');
CREATE TABLE servicios(id INTEGER PRIMARY KEY AUTOINCREMENT,nombre NOT NULL,descripcion,activo NOT NULL,categoria,horario,ubicacion);
INSERT INTO servicios(nombre,descripcion,activo) VALUES('Consulta de calificaciones','Consulta de calificaciones',1),('Consulta de calificaciones','Consulta de calificaciones',1);
"""); c.commit(); c.close()
# Solo para el entorno de prueba: la conexión usa SQLite en lugar de MySQL
open(f'{run}/api/conexion.php','w').write(f"""<?php
try {{ $pdo = new PDO('sqlite:{db}'); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); }}
catch (PDOException $e) {{ http_response_code(500); header('Content-Type: application/json'); echo json_encode(['error'=>'No se pudo conectar a la BD']); exit; }}
""")
p=subprocess.Popen(['php','-S',f'127.0.0.1:{port}','-t',run],stdout=subprocess.DEVNULL,stderr=subprocess.DEVNULL)
time.sleep(1.2)
B=f'http://127.0.0.1:{port}/api'
def call(m,path,body=None):
    d=json.dumps(body).encode() if body is not None else None
    r=urllib.request.Request(B+path,data=d,method=m,headers={'Content-Type':'application/json'})
    try:
        x=urllib.request.urlopen(r); return x.status,x.read().decode()
    except urllib.error.HTTPError as e: return e.code,e.read().decode()
def js(t):
    try: return json.loads(t)
    except: return None
res=[]; sid=[None]
def T(id,desc,m,path,body,exp,check=None,note=''):
    st,t=call(m,path,body); j=js(t)
    ok = st==exp and (check(j) if check else True)
    if id=='API-06' and j: sid[0]=j.get('id')
    res.append(dict(id=id,desc=desc,metodo=m,url=path,esperado=exp,real=st,estado='PASS' if ok else 'FAIL',cuerpo=t[:200].replace('\n',' '),nota=note))
T('API-01','Ping','GET','/ping.php',None,200)
T('API-02','Listar materias','GET','/materias/listar.php',None,200,lambda j:isinstance(j,list) and len(j)==2)
T('API-03','Ver materia id=1','GET','/materias/ver.php?id=1',None,200)
T('API-04','Materia inexistente id=9999','GET','/materias/ver.php?id=9999',None,404)
T('API-05','Listar servicios','GET','/servicios/listar.php',None,200)
T('API-06','Crear servicio válido','POST','/servicios/crear.php',{"nombre":"Biblioteca","categoria":"Servicios","descripcion":"Consulta y préstamo de libros","horario":"07:00-20:00","ubicacion":"Edificio B"},201)
T('API-07','Crear sin nombre','POST','/servicios/crear.php',{"categoria":"Servicios"},400)
T('API-08','Actualizar servicio válido','PUT','/servicios/actualizar.php',{"id":sid[0],"nombre":"Biblioteca","categoria":"Servicios Escolares","horario":"07:00-20:00","ubicacion":"Edificio B"},200)
T('API-09','Actualizar id inexistente','PUT','/servicios/actualizar.php',{"id":9999,"nombre":"X"},404)
T('API-10','Eliminar servicio creado','DELETE',f'/servicios/eliminar.php?id={sid[0]}',None,200)
T('API-11','Eliminar sin id','DELETE','/servicios/eliminar.php',None,400)
T('API-12','Filtro semestre=3 devuelve solo semestre 3','GET','/materias/listar.php?semestre=3',None,200,lambda j:isinstance(j,list) and len(j)==1 and j[0]['semestre']==3)
T('API-13','Listar categorías','GET','/categorias/listar.php',None,200,lambda j:isinstance(j,list))
T('API-14','GET no debe poder borrar (método incorrecto)','GET','/servicios/eliminar.php?id=1',None,405,note='Esperado 405 Method Not Allowed')
T('API-15','Error 404 usa formato JSON estándar {ok,error,mensaje}','GET','/materias/ver.php?id=9999',None,404,lambda j:bool(j) and j.get('ok') is False and 'mensaje' in j)
T('API-16','id inválido (abc) usa formato estándar','GET','/materias/ver.php?id=abc',None,400,lambda j:bool(j) and j.get('ok') is False and 'mensaje' in j)
# ¿el GET anterior realmente borró el servicio 1?
st,t=call('GET','/servicios/listar.php'); n=len(js(t) or [])
res.append(dict(id='API-14b',desc='Verificar que el servicio id=1 sigue existiendo tras el GET',metodo='GET',url='/servicios/listar.php',esperado='2 registros',real=f'{n} registros',estado='PASS' if n==2 else 'FAIL',cuerpo='',nota=''))
p.terminate()
json.dump(res,open(out,'w'),ensure_ascii=False,indent=1)
for r in res: print(r['id'],r['esperado'],r['real'],r['estado'])
