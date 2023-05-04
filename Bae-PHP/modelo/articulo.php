<?php

require_once 'C:\xampp\htdocs\Bae-PHP\db\db.php';

class Articulo {
        private $db;
        private $cod_articulo;
        private $nombre;
        private $texto;
        private $fecha_creacion;
        private $categoria;

        function __construct() {
            $bd = new bd();
            $this->db = $bd->conectarBD();
        }

        public function listarArticulos() {
            try {

                $querySelect = "SELECT DISTINCT cod_articulo, nombre, texto, fecha_creacion, categoria FROM articulos";
                $listaArticulos = $this->db->prepare($querySelect);

                $listaArticulos->execute();

                if($listaArticulos){
                    return $listaArticulos->fetchAll(PDO::FETCH_CLASS, "articulo");
                }else{
                    echo "Ocurrió un error inesperado al obtener el Listado de Articulos";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
                return null;
            }
        }

        public function obtenerArticulo() {
            try {

                $querySelect = "SELECT * FROM articulos WHERE cod_articulo = :cod_articulo";
                $obtenerArticulo = $this->db->prepare($querySelect);

                $obtenerArticulo->bindParam(":cod_articulo", $this->cod_articulo);

                $obtenerArticulo->execute();

                if($obtenerArticulo){
                    return $obtenerArticulo->fetchAll(PDO::FETCH_CLASS, "articulo")[0];
                }else{
                    echo "Ocurrió un error inesperado al obtener el Articulo";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
                return null;
            }
        }

        public function agregarArticulo() {
            try {                $queryInsert = "INSERT INTO articulos (nombre, texto, fecha_creacion, categoria) VALUES (:nombre, :texto, :fecha_creacion, :categoria)";
                $insertarArticulo = $this->db->prepare($queryInsert);

                $insertarArticulo->bindParam(":nombre", $this->nombre);
                $insertarArticulo->bindParam(":texto", $this->texto);
                $insertarArticulo->bindParam(":fecha_creacion", $this->fecha_creacion);
                $insertarArticulo->bindParam(":categoria", $this->categoria);

                $insertarArticulo->execute();

                if($insertarArticulo){
                    echo "Articulo agregado correctamente";
                    header("Location:../../index.php");
                }else{
                    echo "Ocurrió un error inesperado al agregar el Articulo";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
            }
        }

        public function eliminarArticulo($id) {
            try {

                $queryDelete = "DELETE FROM articulos WHERE cod_articulo = :cod_articulo";
                $eliminarArticulo = $this->db->prepare($queryDelete);

                $eliminarArticulo->bindParam(":cod_articulo", $id);

                $eliminarArticulo->execute();

                if($eliminarArticulo){
                    echo "Articulo eliminado correctamente";
                    header("Location:../../index.php");
                }else{
                    echo "Ocurrió un error inesperado al eliminar el Articulo";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
            }
        }

        public function modificarArticulo() {
            try {

                $queryUpdate = "UPDATE articulos SET nombre = :nombre, texto = :texto, fecha_creacion = :fecha_creacion, categoria = :categoria WHERE cod_articulo = :cod_articulo";
                $modificarArticulo = $this->db->prepare($queryUpdate);

                $modificarArticulo->bindParam(":cod_articulo", $this->cod_articulo);
                $modificarArticulo->bindParam(":nombre", $this->nombre);
                $modificarArticulo->bindParam(":texto", $this->texto);
                $modificarArticulo->bindParam(":fecha_creacion", $this->fecha_creacion);
                $modificarArticulo->bindParam(":categoria", $this->categoria);

                $modificarArticulo->execute();

                if($modificarArticulo){
                    echo "Articulo modificado correctamente";
                    header("Location:../../index.php");
                }else{
                    echo "Ocurrió un error inesperado al modificar el Articulo";
                }
                
            } catch (Exception $ex){
                echo "Ocurrió un error: " . $ex->getMessage();
            }
        }

        public function getCodArticulo() {
            return $this->cod_articulo;
        }

        public function getNombre() {
            return $this->nombre;
        }

        public function getTexto() {
            return $this->texto;
        }

        public function getFechaCreacion() {
            return $this->fecha_creacion;
        }

        public function getCategoria() {
            return $this->categoria;
        }

        public function setCodArticulo($id) {
            $this->cod_articulo = $id;
        }

        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        public function setTexto($texto) {
            $this->texto = $texto;
        }

        public function setFechaCreacion($fecha_creacion) {
            $this->fecha_creacion = $fecha_creacion;
        }

        public function setCategoria($categoria) {
            $this->categoria = $categoria;
        }

    }

?>