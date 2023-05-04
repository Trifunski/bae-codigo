<!DOCTYPE html>
<html>

<?php
    include "../componentes/head.php";
    require "../../modelo/articulo.php";
?>

<body>
    <h1>Borrar Articulo: </h1>
    <br>

    <?php

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $articulo = new Articulo();
            $articulo->setCodArticulo($id);
            echo $articulo->eliminarArticulo($id);
        }

    ?>

</body>

</html> 