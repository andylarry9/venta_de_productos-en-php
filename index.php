<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Venta de productos</title>
    <style>
        body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Establece la altura del cuerpo al 100% del viewport */
    margin: 0; /* Elimina el margen predeterminado del cuerpo */
}

.container {
    border: 2px solid #ccc; /* Borde sólido de color gris claro */
    padding: 20px; /* Espaciado interno del contenedor */
    border-radius: 10px; /* Bordes redondeados */
}
h2 {
    margin-top: 0; /* Elimina el margen superior predeterminado del título */
}

    </style>
</head>
<body>
    <div class="container">
<header>
    <img src="https://selectra.es/sites/selectra.es/files/styles/article_hero/public/2020-01/electrodomesticos-hogar.jpg?itok=W8zPH4KA"  width="500" height="300" alt="banner">
    <h2 id="centrado">VENTA DE PRODUCTOS</h2>
</header>
<?php
error_reporting(0);
$producto = $_POST['selProducto'];
$precio = 0;
switch ($producto) {
    case 'Lavadora':
        $precio = 1500;
        break;
    case 'Refrigeradora':
        $precio = 3500;
        break;
    case 'Radiograbadora':
        $precio = 500;
        break;
    case 'Tostadora':
        $precio = 150;
        break;
}

$selL = ($producto == 'Lavadora') ? 'selected' : '';
$selR = ($producto == 'Refrigeradora') ? 'selected' : '';
$selRa = ($producto == 'Radiograbadora') ? 'selected' : '';
$selT = ($producto == 'Tostadora') ? 'selected' : '';

$cantidad = isset($_POST['txtCantidad']) ? $_POST['txtCantidad'] : 1;
$subtotal = $cantidad * $precio;
?>
<form method="POST" name="frmVenta">
    <table border="0" width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td>Producto</td>
            <td>
                <select name="selProducto" onchange="this.form.submit()">
                    <option value="Lavadora" <?php echo $selL; ?>>Lavadora</option>
                    <option value="Refrigeradora" <?php echo $selR; ?>>Refrigeradora</option>
                    <option value="Radiograbadora" <?php echo $selRa; ?>>Radiograbadora</option>
                    <option value="Tostadora" <?php echo $selT; ?>>Tostadora</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Precio</td>
            <td>
                <input type="text" name="txtPrecio" readonly="readonly"
                       value="<?php echo number_format($precio, 2, '.', ''); ?>"/>
            </td>
        </tr>
        <tr>
            <td>Cantidad</td>
            <td>
                <input type="text" name="txtCantidad"
                       value="<?php echo $cantidad; ?>"/>
            </td>
            <td>
                <input type="submit" value="Calcular" name="btnCalcular"/>
            </td>
        </tr>
        <tr>
            <td>Subtotal</td>
            <td>
                <input type="text" name="txtSubtotal"
                       value="<?php echo '$' . number_format($subtotal, 2, '.', ''); ?>"/>
            </td>
        </tr>
        <tr>
            <td>Cuotas</td>
            <td>
                <select name="selCuotas" onchange="this.form.submit()">
                    <option value="3">3</option>
                    <option value="6">6</option>
                    <option value="9">9</option>
                    <option value="12">12</option>
                </select>
            </td>
        </tr>
        <?php
        if (isset($_POST['selCuotas'])) {
            ?>
            <tr id="fila">
                <td>No.Letras</td>
                <td>Monto</td>
            </tr>
            <?php
            $cuotas = $_POST['selCuotas'];
            $i = 1;
            $montoMensual = $subtotal / $cuotas;
            while ($i <= $cuotas) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo '$' . number_format($montoMensual, 2, '.', ''); ?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
    </table>
</form>
        </div>
</body>
</html>
