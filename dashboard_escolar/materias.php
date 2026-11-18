<?php
require 'config/database.php';
$stmt = $pdo->query("SELECT * FROM materias WHERE activo = 1 ORDER BY nombre");
$materias = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Materias</title>
 <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
 <aside class="sidebar">
 <h2>Dashboard Escolar</h2>
 <nav>
 <a href="index.php">Inicio</a>
 <a href="materias.php">Materias</a>
 </nav>
 </aside>
 <main class="content">
 <h1>Materias / Currícula</h1>
 <input type="text" id="buscador"
 placeholder="Buscar materia...">
 <table class="data-table">
 <thead><tr><th>Materia</th><th>Módulo</th><th>Submódulo</th></tr></thead>
 <tbody>
 <?php foreach ($materias as $materia): ?>
 <tr>
 <td><?= htmlspecialchars($materia['nombre']) ?></td>
 <td><?= htmlspecialchars($materia['modulo'] ?? '') ?></td>
 <td><?= htmlspecialchars($materia['submodulo'] ?? '') ?></td>
 </tr>
 <?php endforeach; ?>
 </tbody>
 </table>
 </main>
 <script>
const buscador = document.getElementById("buscador");
buscador.addEventListener("keyup", function () {
 const texto = buscador.value.toLowerCase();
 const filas = document.querySelectorAll("tbody tr");
 filas.forEach(function(fila) {
 const contenido = fila.textContent.toLowerCase();
 if (contenido.includes(texto)) {
 fila.style.display = "";
 } else {
 fila.style.display = "none";
 }
 });
});

 </script>
</body>
</html>