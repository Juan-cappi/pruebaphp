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


    // casteo o conversion explicita 

    $num1 ="100";
    $num2 = 200;
    $num3 = "hello";



    $int1 = (int)$num1;
    $int2 = (int)$num2;
    $int3 = (int)$num3;



    echo "int1: " . $int1; // salida: int1 : 100
    echo "<br>int2: " . $int2; // salida: int2: 200
    echo "<br>int3: " . $int3; //salida int3: 0



    // casteo a String

    $num1 =100;
    $num2 =200.5;
    $num3 = true;



    $string1 = (string)$num1;
    $string2 = (string)$num2;
    $string3 = (string)$num3;

    echo "string1: " . $string1; // salida: string1:100
    echo "string2: " . $string2; // salida : string2: 200.5
    echo "string3: " . $string3; // salida : string3: 1 , por que es true y vale 1 en false vale 0

    // declaramos las variables constantes como define 


    define ('BD_SERVIDOR', 'localhost');
    define ('BD_USUARIO', 'elon');
    define ('BD_CLAVE', 'argentinacampeon2022');
    define ('BD_NOMBRE', 'cursos');


    $conn = mysqli_connect (BD_SERVUDIR, BD_USUARIO, BD_CLAVE, BD_NOMBRE);
    
    if (!$conn){
        die ("error de conexion: " . mysqli_connect_error());

    }
    echo "conexion exitosa";
    mysqli_close($conn);
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