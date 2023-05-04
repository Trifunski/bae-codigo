<?php

require_once 'C:\xampp\htdocs\Bae-PHP\db\db.php';

class Comentario {
        private $db;
        private $cod_comentario;
        private $texto;
        private $fecha_creacion;
        private $likes;

        function __construct() {
            $bd = new bd();
            $this->db = $bd->conectarBD();
        }

        public function listarComentarios($id) {
            try {

                $querySelect = "SELECT DISTINCT * FROM comentarios WHERE Cod_Articulo = :id";
                $listaComentarios = $this->db->prepare($querySelect);

                $listaComentarios->bindParam(":id", $id);

                $listaComentarios->execute();

                if($listaComentarios){
                    return $listaComentarios->fetchAll(PDO::FETCH_CLASS, "comentario");
                }else{
                    echo "Ocurrió un error inesperado al obtener el Listado de Comentarios";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
                return null;
            }
        }

        public function obtenerComentario() {
            try {

                $querySelect = "SELECT DISTINCT Cod_Comentario, Texto, fecha_creacion, Likes FROM comentarios WHERE Cod_Comentario = :id";
                $comentario = $this->db->prepare($querySelect);

                $comentario->execute([
                    'id' => $this->cod_comentario
                ]);

                if($comentario){
                    return $comentario->fetchObject('comentario');
                }else{
                    echo "Ocurrió un error inesperado al obtener el Comentario";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
                return null;
            }
        }

        public function agregarComentario() {
            try {

                $queryInsert = "INSERT INTO comentarios (Texto, fecha_creacion, Likes) VALUES (:texto, :fecha_creacion, :likes)";
                $comentario = $this->db->prepare($queryInsert);

                $comentario->execute([
                    'texto' => $this->texto,
                    'fecha_creacion' => $this->fecha_creacion,
                    'likes' => $this->likes
                ]);

                if($comentario){
                    return true;
                }else{
                    echo "Ocurrió un error inesperado al agregar el Comentario";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
                return false;
            }
        }

        public function editarComentario() {
            try {

                $queryUpdate = "UPDATE comentarios SET Texto = :texto, fecha_creacion = :fecha_creacion, Likes = :likes WHERE Cod_Comentario = :id";
                $comentario = $this->db->prepare($queryUpdate);

                $comentario->execute([
                    'id' => $this->cod_comentario,
                    'texto' => $this->texto,
                    'fecha_creacion' => $this->fecha_creacion,
                    'likes' => $this->likes
                ]);

                if($comentario){
                    return true;
                }else{
                    echo "Ocurrió un error inesperado al editar el Comentario";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
                return false;
            }
        }

        public function eliminarComentario() {
            try {

                $queryDelete = "DELETE FROM comentarios WHERE Cod_Comentario = :id";
                $comentario = $this->db->prepare($queryDelete);

                $comentario->execute([
                    'id' => $this->cod_comentario
                ]);

                if($comentario){
                    return true;
                }else{
                    echo "Ocurrió un error inesperado al eliminar el Comentario";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
                return false;
            }
        }

        function getCodComentario() {
            return $this->cod_comentario;
        }

        function getTexto() {
            return $this->texto;
        }

        function getFechaCreacion() {
            return $this->fecha_creacion;
        }

        function getLikes() {
            return $this->likes;
        }

        function setCodComentario($cod_comentario) {
            $this->cod_comentario = $cod_comentario;
        }

        function setTexto($texto) {
            $this->texto = $texto;
        }

        function setFechaCreacion($fecha_creacion) {
            $this->fecha_creacion = $fecha_creacion;
        }

        function setLikes($likes) {
            $this->likes = $likes;
        }

}

?>