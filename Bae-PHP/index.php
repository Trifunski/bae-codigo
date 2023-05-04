<!DOCTYPE html>
<html lang="es-ES">

    <head>
        
        <?php 
            include "componentes/head.php";
            require "modelo/articulo.php";
            require "modelo/comentario.php";
            require "db/api_call.php";
        ?>

        <title>Lista de Chats</title>

    </head>

    <body class="bg-dark">

        <nav class="navbar bg-dark border-bottom sticky-top" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold">WHITEWINGS</a>
                <button class="btn btn-outline-light" type="submit"><a href="vista/articulo/agregar_articulo.php" class="text-decoration-none text-light">Agregar Articulo</a></button>
            </div>
        </nav>

        <br>

        <?php

            $articulo = new Articulo();
            $listaArticulos = $articulo->listarArticulos();

            echo "<div class='container'>";
                echo "<div class='row'>";

                    $img_url = obtener_imagenes_aleatorias("5059697fcdcc0c11b76398a8fb5f7017","paisaje");

                    foreach ($listaArticulos as $index => $articulo) {
                            echo "<div class='card m-3' style='width: 18rem;'>";
                                echo "<img src='" . $img_url[$index] . "' style='margin-left: -12px; width: 286px; height: 300px; border-radius: 2%'>";
                                echo "<div class='card-body'>";
                                    echo "<h5 class='card-title'>" . $articulo->getNombre() . "</h5>";
                                    echo "<p class='card-text'>" . $articulo->getTexto() . "</p>";
                                    echo "<a href='./vista/articulo/editar_articulo.php?id=" . $articulo->getCodArticulo() . "' class='btn btn-primary m-1'><i class='bi bi-pencil-fill'></i></a>";
                                    echo "<a href='./vista/articulo/eliminar_articulo.php?id=" . $articulo->getCodArticulo() . "' class='btn btn-danger m-1'><i class='bi bi-trash-fill'></i></a>";
                                    echo "<a href='#' class='btn btn-success m-1' data-bs-toggle='modal' data-id='". $articulo->getCodArticulo() . "' data-bs-target='#modalComentarios'><i class='bi bi-chat'></i></a>";
                                echo "</div>";
                                echo "<div class='card-footer'>";
                                    echo "<small class='text-muted'>" . $articulo->getFechaCreacion() . "</small>";
                                    echo "<small class='text-muted float-end'>" . $articulo->getCategoria() . "</small>";
                                echo "</div>";
                            echo "</div>";
                    }

                echo "</div>";

            echo "</div>";

        ?>

        <div class="modal fade" id="modalComentarios" tabindex="-1" role="dialog" aria-labelledby="modalComentariosLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComentariosLabel">Comentarios</h5>
            </div>
            <div class="modal-body">
                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Likes</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaComentarios">
                    <!-- Los comentarios se agregan aquí mediante JavaScript -->
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>


        

            <script>
                $(document).ready(function() {
                    $('#modalComentarios').on('show.bs.modal', function (e) {
                        var id = $(e.relatedTarget).data('id');
                        $.ajax({
                            type : 'post',
                            url : 'componentes/tablaComentarios.php',
                            data :  {'data-id': id},
                            success : function(data){
                            console.log(id);
                            console.log(data);
                            var tabla = '';
                            
                            data.forEach(element => {
                                tabla += '<tr>';
                                tabla += '<td>' + element.codComentario + '</td>';
                                tabla += '<td>' + element.texto + '</td>';
                                tabla += '<td>' + element.fechaCreacion + '</td>';
                                tabla += '<td>' + element.likes + '</td>';
                                tabla += '<td><a href="./vista/comentario/editar_comentario.php?id=' + element.codComentario + '" class="btn btn-primary m-1"><i class="bi bi-pencil-fill"></i></a>';
                                tabla += '</tr>';
                            });
                            
                            $('#tablaComentarios').html(tabla);
                            }

                        });
                    });
                });
            </script>

    </body>
</html>