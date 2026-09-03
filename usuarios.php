<?php
require "conexion.php";

$sql = "SELECT id, nombre, email, rol FROM funcionarios WHERE activo = 1";
$stmt = $pdo->query($sql);
$funcionarios = $stmt->fetchAll();
?>

<div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($funcionarios as $f): ?>
            <tr>
                <td><?= htmlspecialchars($f["nombre"]) ?></td>
                <td><?= htmlspecialchars($f["id"]) ?></td>
                <td><?= htmlspecialchars($f["email"]) ?></td>
                <td><?= htmlspecialchars($f["rol"]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
