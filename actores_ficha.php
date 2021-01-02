<?php

session_start();
$user="";

// Si l'usuari ja està loguejat
if (isset($_SESSION["user"])){
    $user=$_SESSION["user"];
}
else{   // 
    header("Location: ./index.php");
}

if (!isset($_GET["id"])){
    header("Location: ./peliculas.php");
}

?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Directores | Ficha</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>
    <div class="alert alert-secondary d-flex">
        <a href="./peliculas.php" class="btn btn-dark">Películas</a>&nbsp;&nbsp;
    </div>
    <div class="container">
    <?php
    require_once('bbdd/actores_crud.php');

    $crudActor= new CrudActores(); 

    $actor=$crudActor->getActorById($_GET["id"]);

    if (!isset($actor) || is_null($actor)){
        header("Location: ./peliculas.php");
    }

    echo '<div class="card-body" style="margin: auto;background:LIGHTSKYBLUE;width:50%;">';
    echo '<b>Nombre</b>:'. $actor->getNombre() . '<br>';
    echo '<b>Anyo</b>:'. $actor->getAnyoNacimiento() . '<br>';
    echo '<b>Pais</b>:'. $actor->getPais() . '<br>';
    echo '</div>';

    ?>
    <a href="javascript:history.back()"> Volver Atrás</a>

    </div>
</body>

</html>