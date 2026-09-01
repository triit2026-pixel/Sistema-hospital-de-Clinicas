<?php

require "conexion.php";
$sql = "SELECT id, nombre, email, rol,from usuario where activo=1";
$stmt = $pdo->query($sql);
$usuarios = stmt->fetchAll();
?>

<<div
    class="table-responsive"
>
    <table
        class="table table-primary"
    >
        <thead>
            <tr>
                <th scope="col">
                </th>
                <th scope="col">Column 2</th>
                <th scope="col">Column 3</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $u): ?>
            <tr >
                <td><?= $u["nombre"]?></td>
                <td><?= $u["id"]?</td>
                <td><?= $u["email"]?</td>
            </tr>
            
<?php end foreach 

?>


        </tbody>
    </table>

