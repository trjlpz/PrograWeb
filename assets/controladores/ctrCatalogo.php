<?php

require_once  __DIR__ . '/../../modelos/conexion.php';
include_once __DIR__ . '/../../assets/adodb5/adodb.inc.php';

    $controller = new CatalogoController();
    $controller->procesarFormulario();


class CatalogoController {
    
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function procesarFormulario() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $accion = $_POST['accion'];
    
            switch ($accion) {
                case 'nuevo':
                        $nombre = $_POST['nombre'];
                        $descripcion = $_POST['descripcion'];
                        $precio = $_POST['precio'];
                        $unidadStock = $_POST['unidadStock'];
                        $puntoReorden = $_POST['puntoReorden'];
                        $unidadComprometida = $_POST['unidadComprometida'];
                        
                        // Llamar al método para agregar producto
                        $this->agregarProducto($nombre, $descripcion, $precio, $unidadStock, $puntoReorden, $unidadComprometida);
                    break;
                case 'eliminar':
                        $idProducto = $_POST['idProducto'];
                        // Llamar al método para eliminar producto
                        $this->eliminarProducto($idProducto);
                    break;
                case 'actualizar':
                        $idProducto = $_POST['idProducto'];
                        $nombre = $_POST['nombre'];
                        $descripcion = $_POST['descripcion'];
                        $precio = $_POST['precio'];
                        $unidadStock = $_POST['unidadStock'];
                        $puntoReorden = $_POST['puntoReorden'];
                        $unidadComprometida = $_POST['unidadComprometida'];
                        // Llamar al método para actualizar producto
                        $this->actualizarProducto($idProducto, $nombre, $descripcion, $precio, $unidadStock, $puntoReorden, $unidadComprometida);
                    break;
                default:
                    // Manejar otros casos si es necesario
                    break;
            }
        }
    }

    // Método para agregar un producto
    public function agregarProducto($nombre, $descripcion, $precio, $unidadStock, $puntoReorden, $unidadComprometida) {
        // Conectar a la base de datos
        $con = $this->conexion->conectar();
    
        // Escapar los valores para prevenir SQL injection
        $nombre = $con->qstr($nombre);
        $descripcion = $con->qstr($descripcion);
        $precio = floatval($precio);
        $unidadStock = intval($unidadStock);
        $puntoReorden = intval($puntoReorden);
        $unidadComprometida = intval($unidadComprometida);
    
        // Construir la consulta SQL para insertar el producto
        $query = "INSERT INTO tblproductos (txtNombre, txtDescripcion, precio, unidadStock, puntoReorden, unidadComprometida) VALUES ($nombre, $descripcion, $precio, $unidadStock, $puntoReorden, $unidadComprometida)";
    
        // Ejecutar la consulta
        $con->execute($query);
    
        if(isset($_FILES['imagen'])) {
            $imagen = $_FILES['imagen'];
            $nombreArchivo = $imagen['name'];
            $ruta = '../assets/imagenes/catalogo/' . $nombreArchivo;
    
            if(move_uploaded_file($imagen['tmp_name'], $ruta)) {
                // Imagen cargada con éxito, ahora puedes guardar la ruta en la base de datos
                $ruta = $con->qstr($ruta);  // Escapa la ruta para prevenir SQL injection
            } else {
                echo "Error al cargar la imagen.";
            }
        } else {
            $ruta = null; // O establece la ruta por defecto si no se proporciona una imagen
        }

        // Construir la consulta SQL para insertar el producto con la posible imagen
    $query = "INSERT INTO tblproductos (txtNombre, txtDescripcion, precio, unidadStock, puntoReorden, unidadComprometida, imagen) 
    VALUES ($nombre, $descripcion, $precio, $unidadStock, $puntoReorden, $unidadComprometida, $ruta)";

        // Cerrar la conexión
        $con->close();

        // Esperar 2 segundos antes de redirigir
        sleep(2);
        // Redirigir a la página de catálogo (o a donde sea necesario)
        header('Location: ../../vistas/catalogo.php');
    }
    

    public function eliminarProducto($idProducto) {
        // Conectar a la base de datos
        $con = $this->conexion->conectar();
        
        // Escapar el valor del idProducto para prevenir SQL injection
        $idProducto = intval($idProducto);
        
        // Construir la consulta SQL para eliminar el producto
        $query = "DELETE FROM tblproductos WHERE idProducto = $idProducto";
        
        // Ejecutar la consulta
        $con->execute($query);
        
        // Cerrar la conexión
        $con->close();

        // Esperar 2 segundos antes de redirigir
        sleep(2);
        // Redirigir a la página de catálogo (o a donde sea necesario)
        header('Location: ../../vistas/catalogo.php');
    }

    public function actualizarProducto($idProducto, $nombre, $descripcion, $precio, $unidadStock, $puntoReorden, $unidadComprometida) {
        // Conectar a la base de datos
        $con = $this->conexion->conectar();
        
        // Escapar los valores para prevenir SQL injection
        $nombre = $con->qstr($nombre);
        $descripcion = $con->qstr($descripcion);
        $precio = floatval($precio);
        $unidadStock = intval($unidadStock);
        $puntoReorden = intval($puntoReorden);
        $unidadComprometida = intval($unidadComprometida);
        $idProducto = intval($idProducto);
    
        // Construir la consulta SQL para actualizar el producto
        $query = "UPDATE tblproductos 
                  SET txtNombre = $nombre, 
                      txtDescripcion = $descripcion, 
                      precio = $precio, 
                      unidadStock = $unidadStock, 
                      puntoReorden = $puntoReorden, 
                      unidadComprometida = $unidadComprometida 
                  WHERE idProducto = $idProducto";
        
        // Ejecutar la consulta
        $con->execute($query);
        
        // Cerrar la conexión
        $con->close();
        
        // Esperar 2 segundos antes de redirigir
        sleep(2);

        // Redirigir a la página de catálogo (o a donde sea necesario)
        header('Location: ../../vistas/catalogo.php');
    }
    

}

?>
