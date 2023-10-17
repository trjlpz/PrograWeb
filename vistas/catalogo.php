<?php
    //require_once './carrito.php';
    require_once './../modelos/conexion.php';
    include_once '../assets/adodb5/adodb.inc.php';
    include_once '../assets/controladores/ctrCatalogo.php';

    $conexion = new Conexion();
    $con = $conexion->conectar();
    $result = $con->execute("SELECT * FROM tblproductos");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechDefender Institute</title>
    <link rel="stylesheet" href="../assets/css/estilo_catalogo.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.btn-add-to-cart').click(function() {
                var product_id = $(this).data('product-id');
                $.post('carrito.php', { action: 'add', product_id: product_id }, function(data) {
                    // Actualiza el carrito o muestra un mensaje de confirmación si es necesario
                });
            });
        });
    </script>
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
                
            </ul>
        </div>
    </nav>

    <div class="container">
        <h3 class="h3">Antivirus </h3>
            <div class="row">
                <?php while ($row = $result->FetchRow()): ?> 
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="#">
                                <img class="pic-1" src="../assets/imagenes/catalogo/<?php echo $row['idProducto']; ?>.jpeg">
                            </a>
                            <ul class="social">
                            <li><a href="carrito.php"><img src="../assets/imagenes/iconos/icons8-shopping.png" alt="Carrito"></a></li>
                            </ul>
                            <span class="product-new-label">New</span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">
                                <?php echo $row['txtNombre']; ?></a></h3>
                            <div class="price">
                                <?php echo "$" . $row['precio']; ?>
                            </div>
                            <!-- Añadir los nuevos campos aquí -->
                            <div class="product-details">
                                Unidad Stock: <?php echo $row['unidadStock']; ?><br>
                                Punto de Reorden: <?php echo $row['puntoReorden']; ?><br>
                                Unidad Comprometida: <?php echo $row['unidadComprometida']; ?>
                            </div>
                            <button class="btn btn-success btn-add-to-cart" data-product-id="<?php echo $row['idProducto']; ?>">Agregar al Carrito</button>
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                            </ul>
                        </div>
                    </div>
                <?php endwhile; ?>
                </div>
            </div>
                
    </div>
        <div class="container mt-4">
            <div class="row justify-content-end">
                <div class="col-md-12 text-right">
                    <a href="producto.php" class="btn btn-primary">Detalles Productos</a>
                </div>
            </div>
        </div>            
    
    
</body>
</html>