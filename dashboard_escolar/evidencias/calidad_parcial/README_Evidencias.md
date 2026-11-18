# Evidencias de calidad parcial - v0.3-quality-review

Fecha de revision: 2026-11-05

## Estructura
- `01_requerimientos/` requerimientos derivados (REQ-01..13)
- `02_pruebas/` casos y resultados (CSV), trazabilidad (xlsx/csv), scripts de ejecucion
- `03_defectos/` Registro_Defectos (xlsx/csv)
- `04_postman/` Postman_collection.json (importar y ejecutar con el Runner)
- `05_compatibilidad/` matriz navegador/dispositivo
- `06_capturas/` capturas del alumno (Postman/navegador) y capturas de interfaz antes/despues

## Como reproducir
1. XAMPP: copiar la carpeta a `htdocs/dashboard_escolar`, importar `dashboard_escolar.sql`, iniciar Apache y MySQL.
2. Postman: importar `04_postman/Postman_collection.json` y ejecutar el Runner. Atencion: el item "C" intenta borrar el id 1 con GET; en v0.3-quality-review debe responder 405 (en la version anterior borraba el registro).
3. Pruebas automatizadas (opcional, sin MySQL): `python3 02_pruebas/run_api_tests.py <version> <carpeta_proyecto> <salida.json> <puerto>` usa el servidor integrado de PHP y SQLite; `ui_tests.js` usa Playwright.

## Limitaciones
- Las pruebas automatizadas corrieron en PHP+SQLite, no en MySQL. BUG-006 y BUG-007 dependen de MySQL y quedan pendientes de verificar en XAMPP.
- Firefox/Safari (interfaz) y dispositivos reales no se probaron.
