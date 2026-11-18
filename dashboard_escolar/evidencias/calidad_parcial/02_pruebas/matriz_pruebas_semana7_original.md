# Matriz de pruebas - Dashboard Escolar Semana 7

Llena **Real** con el status que muestra Postman y **Estado** con PASS (Real = Esperado) o FAIL.
Si hay FAIL: no cambies el resultado; registra el defecto, corrige el código y repite la prueba.

|ID|Endpoint|Datos|Esperado|Real|Estado|
|-|-|-|-|-|-|
|API-01|GET /api/ping.php|–|200|200|PASS|
|API-02|GET /api/materias/listar.php|–|200|200|PASS|
|API-03|GET /api/materias/ver.php?id=1|–|200|200|PASS|
|API-04|GET /api/materias/ver.php?id=9999|–|404|404|PASS|
|API-05|GET /api/servicios/listar.php|–|200|200|PASS|
|API-06|POST /api/servicios/crear.php|JSON válido|201|201|PASS|
|API-07|POST /api/servicios/crear.php|sin nombre|400|400|PASS|
|API-08|PUT /api/servicios/actualizar.php|JSON válido|200|200|PASS|
|API-09|PUT /api/servicios/actualizar.php|id 9999|404|404|PASS|
|API-10|DELETE /api/servicios/eliminar.php?id=ID|–|200|200|PASS|
|API-11|DELETE /api/servicios/eliminar.php|–|400|400|PASS|



