# Primer contrato para PLN (sin voz ni IA todavía)

| Pregunta del usuario | Endpoint | Qué se usa de la respuesta |
|---|---|---|
| ¿Qué materias llevo? | `GET /api/materias/listar.php?semestre=N` | `nombre` y `modulo` |
| ¿Dónde está la biblioteca? | `GET /api/servicios/listar.php` | buscar por `nombre`; leer `ubicacion` y `horario` |
| ¿Qué tipos de servicios hay? | `GET /api/categorias/listar.php` | lista de categorías |
