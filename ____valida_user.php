



<?php
/*Array ( 
    [email-address] => jgcamarena@ieseljust.com 
    [password] => Cine1234 
    [remember] => on )
    */
session_start();
print_r($_POST);


if (isset($_POST["email-address"]) && isset($_POST["password"])){ if($_POST["usuario"] == "admin"){
setcookie("usuario", $_POST["usuario"]); setcookie("password", $_POST["password"]);
$_SESSION["nombre"] = "Pepe Martinez";
echo "<p>Hola, ". $_SESSION["nombre"].", bienvenido al panel de administración
";
}else{
header("Location: ./ejercicio11a.php"); }
}else{
//Están ya en la sesión
if(isset($_SESSION["usuario"]) && $_SESSION["usuario"] == "admin" ) {
echo "<p>Hola, ". $_SESSION["nombre"].", bienvenido al panel de administración
";
}else{
header("Location: ./ejercicio6a.php"); }
}
*/
?>