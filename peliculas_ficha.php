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
    <title>Películas | Ficha</title>
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

        require_once('bbdd/peliculas_crud.php');

        $crudPeli= new CrudPelis(); 

        $peli=$crudPeli->getPeliculaById($_GET["id"]);

        if (!isset($peli) || is_null($peli)){
            header("Location: ./peliculas.php");
        }
    
        $actores=$crudPeli->obtenerActoresPelicula($_GET["id"]);

        $directores=$crudPeli->obtenerDirectoresPelicula($_GET["id"]);

        echo '<div class="card-body" style="background:lavender;width:60%;margin: auto;">';
        echo '<b>Título</b>:'. $peli->getTitulo() . '<br>';
        echo '<b>Anyo</b>:'. $peli->getAnyo() . '<br>';
        echo '<b>Duracion</b>:'. $peli->getDuracion() . '<br>';
        if (count($directores)>0){
            echo '<b>Director</b>:<br>';
            echo '<ul>';
            foreach ($directores as $dire){
                echo '<li><a href="./directores_ficha.php?id=' . $dire->getId() . '">' . $dire->getNombre() . '</a>';
            }
            echo '</ul>';
        }
        if (count($actores)>0){
            echo '<b>Actores</b>:<br>';
            echo '<ul>';
            foreach ($actores as $actor){
                echo '<li><a href="./actores_ficha.php?id=' . $actor->getId() . '">' . $actor->getNombre() . '</a>';
            }
            echo '</ul>';
        }
        echo '</div>';

        

        
    ?>

    <a href="javascript:history.back()"> Volver Atrás</a>

    </div>
    
</body>

</html>