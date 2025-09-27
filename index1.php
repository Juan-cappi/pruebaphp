<?php

$nombre =$_POST ['nombre'];
$email = $_POST ['correo'];
$clave = $_POST ['clave'];

$colores = array ("verde","negro","rojo");

echo $colores[0]; // salida: verde

// instanciar una clase y objeto

class coche {
    public $marca;
    public $modelo;

    function arrancar(){
        echo "El coche esta arrancando";
    }

}

    $miCoche = new coche();
    $miCoche-> marca = "Toyota";
    $miCoche->modelo = "corolla";

    echo $miCoche->marca;// salida: toyota
    $miCoche->arrancar(); // salida: El coche esta arrancando.

    // variable global

    $numero = 10;

    function multipicarPorDos(){

        global $numero;

        $numero *=2;
    }
    multipicarPorDos();
    echo $numero;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Formulaio PHP</title>
</head>
<body>
    <h1>Formulario de registro</h1>
    <form action="Registro.php" method="post">
    <label for="nombre"> nombre: </label>
    <input type="text" name="nombre" id="nombre" require>
    <br>
    <label for="email">Email:</label>
    <input type="email" nombre="correo" id="correo" require>
    <br>
    <label for="clave">contraseña</label>
    <input type="password" name="clave" id="clave" require>
    <br>
    <input type="submit" value="registrar">
    </form>
</body>
</html>