# Dashboard Escolar

## Cómo ejecutar
1. Copia la carpeta a `C:\xampp\htdocs\dashboard_escolar`.
2. Abre XAMPP y pulsa Start en Apache y MySQL.
3. En http://localhost/phpmyadmin importa `dashboard_escolar.sql` (crea las tablas `materias` y `servicios`).
4. Prueba http://localhost/dashboard_escolar/api/ping.php
5. En Postman importa `evidencias/Dashboard_Escolar_Semana7.postman_collection.json` y ejecútala con el Runner.

## Endpoints
| Método | URL | Status |
|---|---|---|
| GET | /api/ping.php | 200 |
| GET | /api/materias/listar.php[?semestre=3] | 200 |
| GET | /api/materias/ver.php?id=1 | 200 / 400 / 404 |
| GET | /api/servicios/listar.php | 200 |
| POST | /api/servicios/crear.php | 201 / 400 |
| PUT | /api/servicios/actualizar.php | 200 / 400 / 404 |
| DELETE | /api/servicios/eliminar.php?id=N | 200 / 400 / 404 |
| GET | /api/categorias/listar.php | 200 |

Errores en JSON: `{"ok":false,"error":"...","mensaje":"..."}`.
