<!DOCTYPE html>
<html>

<?php
    include "../../componentes/head.php";
    require "../../modelo/articulo.php";
?>

<body class="bg-dark text-light">

    <nav class="navbar bg-dark border-bottom sticky-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold">WHITEWINGS</a>
            <button class="btn btn-outline-light" type="submit"><a href="../../index.php" class="text-decoration-none text-light">Volver al inicio</a></button>
        </div>
    </nav>

    <div class="container-fluid position-absolute mt-5">
        <div class="jumbotron">

            <h1 class=" text-center">Editar Articulo</h1>

            <?php

                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $id = $_GET['id'];
                    $articulos = new Articulo();
                    $articulos->setCodArticulo($id);
                    $articulo = $articulos->obtenerArticulo();            
                }

                if (
                    isset($_POST['id']) &&
                    isset($_POST['nombre']) &&
                    isset($_POST['texto']) &&
                    isset($_POST['categoria'])

                ) {
                    $id = $_POST['id'];
                    $nombre = $_POST['nombre'];
                    $texto = $_POST['texto'];
                    $categoria = $_POST['categoria'];

                    $articulos = new Articulo();

                    $articulos->setCodArticulo($id);
                    $articulos->setNombre($nombre);
                    $articulos->setTexto($texto);
                    $articulos->setFechaCreacion(date("Y-m-d"));
                    $articulos->setCategoria($categoria);
                    
                    echo $articulos->modificarArticulo();
                }

            ?>
            <div class="container">
                <form action="editar_articulo.php" method="post">

                    <div class="form-group">
                        <label>Id</label>
                        <input type="text" class="form-control" name="id" value="<?php echo $articulo->getCodArticulo(); ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $articulo->getNombre(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Texto</label>
                        <input type="text" class="form-control" name="texto" value="<?php echo $articulo->getTexto(); ?>" required>
                    </div>

                    <br>

                    <?php
                    $categorias = array("Forex", "Criptomonedas", "Acciones", "Futuros", "Bonos");

                    echo "<div class='form-group'>";
                    echo "<label>Categorias</label>";
                    echo "<select class='custom-select' name='categoria' required>";

                    foreach ($categorias as $categoria) {
                        if ($categoria == $articulo->getCategoria()) {
                            echo "<option value='$categoria' selected>$categoria</option>";
                        } else {
                            echo "<option value='$categoria'>$categoria</option>";
                        }
                    }

                    echo "</select>";
                    echo "</div>";
                ?>

                    <br>

                    <button type="submit" class="btn btn-primary">Editar Biblioteca</button>
                </form>
            </div>
            <br>
        </div>
    </div>
</body>