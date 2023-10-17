<?php
    
    require_once './../modelos/conexion.php';
    include_once '../assets/adodb5/adodb.inc.php';
    include_once '../assets/controladores/ctrCatalogo.php';

    $conexion = new Conexion();
    $con = $conexion->conectar();
    $result = $con->execute("SELECT * FROM tblproductos");

    $controller = new CatalogoController();
   // $result = $controller->obtenerProductos();
    $controller->procesarFormulario();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Agregar Nuevo Producto</title>
    <link rel="stylesheet" href="../assets/css/estilo_producto.css">
    <link rel="stylesheet" href="../assets/css/estilo.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="../inicio.html">TechDefender Institute</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../inicio.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./aboutus.html">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./auditores.html">Auditores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./capacitaciones.html">Capacitaciones</a>
                </li>
                <li>
                    <a class="nav-link" href="./catalogo.php">Catalogo</a>
                </li>
                
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
            <form action="../assets/controladores/ctrCatalogo.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="idProducto">ID del Producto</label>
                        <input type="text" class="form-control" id="idProducto" name="idProducto" placeholder="ID del Producto">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción">
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio">
                    </div>
                    <div class="form-group">
                        <label for="unidadStock">Unidad Stock</label>
                        <input type="text" class="form-control" id="unidadStock" name="unidadStock" placeholder="Unidad Stock">
                    </div>
                    <div class="form-group">
                        <label for="puntoReorden">Punto de Reorden</label>
                        <input type="text" class="form-control" id="puntoReorden" name="puntoReorden" placeholder="Punto de Reorden">
                    </div>
                    <div class="form-group">
                        <label for="unidadComprometida">Unidad Comprometida</label>
                        <input type="text" class="form-control" id="unidadComprometida" name="unidadComprometida" placeholder="Unidad Comprometida">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen" accept="image/*">
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary btn-new-product" name="accion" value="nuevo">Nuevo Producto</button>
                        <button type="submit" class="btn btn-danger btn-delete-product" name="accion" value="eliminar">Eliminar Producto</button>
                        <button type="submit" class="btn btn-warning btn-update-product" name="accion" value="actualizar">Actualizar Producto</button>
                    </div>

                    
                </form>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
