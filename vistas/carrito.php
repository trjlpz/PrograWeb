<?php

    require_once './../modelos/conexion.php';
    include_once './../assets/adodb5/adodb.inc.php';
   
session_start();

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];

    switch($action) {
        case 'add':
            if(isset($_POST['product_id']) && !empty($_POST['product_id'])) {
                $product_id = $_POST['product_id'];

                if(!isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id] = 1;
                } else {
                    $_SESSION['cart'][$product_id]++;
                }
            }
            break;

        case 'remove':
            if(isset($_POST['product_id']) && !empty($_POST['product_id'])) {
                $product_id = $_POST['product_id'];

                if(isset($_SESSION['cart'][$product_id])) {
                    unset($_SESSION['cart'][$product_id]);
                }
            }
            break;

        case 'update':  // Agregamos este caso para actualizar la cantidad
            if(isset($_POST['product_id']) && !empty($_POST['product_id']) && isset($_POST['quantity'])) {
                $product_id = $_POST['product_id'];
                $quantity = $_POST['quantity'];

                if(isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id] = $quantity;
                }
            }
            break;
    }
}

$conexion = new Conexion();
$con = $conexion->conectar();
$products = array();

if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $product_id => $quantity) {
        $result = $con->execute("SELECT * FROM tblproductos WHERE idProducto = '$product_id'");
        $row = $result->FetchRow();
        $row['quantity'] = $quantity;
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TechDefender Institute</title>
    <link rel="stylesheet" href="../assets/css/estilo_compra.css">
    <script src="../assets/controladores/ctrCompras.js"></script>

    <link rel="stylesheet" href="../assets/controladores/ctrCompras.js">

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
       
    
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".qtyminus").on("click", function() {
                var input = $(this).closest('.count-inlineflex').find('.qty');
                var now = input.val();
                if ($.isNumeric(now)) {
                    if (parseInt(now) - 1 > 0) {
                        now--;
                        input.val(now);
                        input.closest('form').submit(); // Envía el formulario al actualizar la cantidad
                    }
                }
            });

            $(".qtyplus").on("click", function() {
                var input = $(this).closest('.count-inlineflex').find('.qty');
                var now = input.val();
                if ($.isNumeric(now)) {
                    input.val(parseInt(now) + 1);
                    input.closest('form').submit(); // Envía el formulario al actualizar la cantidad
                }
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
                <li class="nav-item">
                  <a class="nav-link" href="./catalogo.php">Catalogo</a>
              </li>
            </ul>
        </div>
    </nav>

    
</main>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="cart-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="main-heading">Carrito de compras</div>
                <div class="table-cart">
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total = 0;

                                foreach ($products as $product) {
                                    $subtotal = $product['precio'] * $product['quantity'];
                                    $total += $subtotal;
                            ?>

                            <tr>
                            <td>
                                <div class="display-flex align-center">
                                    <div class="img-product">
                                            <!-- Agregar imagen del producto aquí si es necesario -->
                                    </div>
                                    <div class="name-product">
                                        <strong><?php echo $product['txtNombre']; ?></strong>
                                        <br>
                                        <?php echo $product['txtDescripcion']; ?>
                                    </div>
                                    <div class="price">
                                            $<?php echo number_format($product['precio'], 2); ?>
                                    </div>
                                </div>
                            </td>
                            <td class="product-count">
                                <form action="carrito.php" method="post" class="count-inlineflex">
                                    <div class="qtyminus btn-minus" type="button">-</div>
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="product_id" value="<?php echo $product['idProducto']; ?>">
                                    <input type="text" name="quantity" value="<?php echo $product['quantity']; ?>" class="qty">
                                    <div class="qtyplus btn-plus" type="button">+</div>
                                </form>
                            </td>
                                <td>
                                    <div class="total">
                                        $<?php echo number_format($subtotal, 2); ?>
                                    </div>
                                </td>
                                <td>
                                    <form action="carrito.php" method="post">
                                        <input type="hidden" name="action" value="remove">
                                        <input type="hidden" name="product_id" value="<?php echo $product['idProducto']; ?>">
                                        <input type="submit" class="btn btn-danger btn-delete-product" value="Eliminar">
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                </div>
                <!-- /.table-cart -->
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <div class="cart-totals">
                    <h3>Cart Totals</h3>
                    <form action="#" method="get" accept-charset="utf-8">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="subtotal">$<?php echo number_format($total, 2); ?></td>
                                </tr>
                                <tr class="total-row">
                                    <td>Total</td>
                                    <td class="price-total">$<?php echo number_format($total, 2); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-cart-totals">
                            <a href="#" class="update round-black-btn" title="">Update Cart</a>
                            <a href="#" class="checkout round-black-btn" title="">Proceed to Checkout</a>
                        </div>
                        <!-- /.btn-cart-totals -->
                    </form>
                    <!-- /form -->
                </div>
                <!-- /.cart-totals -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="	sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>