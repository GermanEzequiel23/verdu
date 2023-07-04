<?php
    include('conex.php');
    if(isset ($_POST['enviar'])) {
        $conn=conectar();
        $cant=$_POST['cant'];
        $id=$_POST['opcion'];
        $consulta="INSERT INTO `ventas` (`cantidad`, `id_producto`) VALUES ('$cant', '$id')";
        mysqli_query($conn, $consulta);
        $consulta="SELECT `precio` FROM `productos` WHERE `id_producto` = '$id'";
        $resultado=mysqli_query($conn, $consulta); 
        $precio=$resultado->fetch_array();
        $total=$precio['precio']*$cant;
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $fecha=date('d-m-Y H:i:s');
        $consulta="INSERT INTO `carrito` (`total`, `fecha_hora`) VALUES ('$total', '$fecha')";
        mysqli_query($conn, $consulta);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Documents</title>    
</head>
<body background="fondo.webp">
    <header>
        <h1>LOS VERDUS</h1>
    </header>
    <form method="post" action="index.php">
        <div class="pedido">
            <div class="select">
                <select name="opcion">
                    <option selected disabled>Seleccione su compra</option>
                    <option value="1">Bananas $300</option>
                    <option value="2">Manzanas $500</option>
                    <option value="3">Naranjas $350</option>
                    <option value="4">Tomates $600</option>
                    <option value="5">Cebollas $450</option>
                    <option value="6">Papas $250</option>
                </select>
                <p>Cantidad de Kilos:
                <input type="text" name="cant">
                </p>
                <input type="submit" name="enviar" value="Enviar">
            </div>
        </div>
    </form>
</body>
</html>