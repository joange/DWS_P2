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

print_r($_GET["id"]);
if (!isset($_GET["id"]) && !isset($_GET["idDel"])){
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
        <link rel="stylesheet" href="./css/estilos.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
<?php include 'header.php'; ?>

    <div class="container">
    <?php
    require_once('bbdd/directores_crud.php');

    $crudDirector= new CrudDires(); 

    if (isset($_GET["id"])){    // estem en la consulta. Mostrem les dades
        $dire=$crudDirector->getDirectorById($_GET["id"]);

        if (!isset($dire) || is_null($dire)){
            header("Location: ./peliculas.php");
        }
        echo '<div class="container text-center">';
        echo '<div class="row">';
        echo '<div class="card">';
        echo '<img src="./imgs/claqueta.jpeg" class="card-img-top">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><b>Nombre</b>:'. $dire->getNombre() . '</h5>';
        echo '<b>Anyo</b>:'. $dire->getAnyoNacimiento() . '<br>';
        echo '<b>Pais</b>:'. $dire->getPais() . '<br>';
        echo '<a href="directores_form.php?dire=' . $dire->getId() . '" class="btn btn-primary">Editar Director </a>';
        echo ' ';
        echo '<a href="directores_ficha.php?idDel=' . $dire->getId() . '" class="btn btn-danger">Eliminar Director </a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    if(isset($_GET["idDel"])){  // estem esborrant
        if ($crudDirector->deleteDirector($_GET["idDel"])==1){
            echo '<div class="alert alert-success" role="alert">';
            echo '<h4 class="alert-heading">Ben fet!!</h4>';
            echo "<p>El director s'ha esborrat correctament.</p>";
            echo '<hr>';
            echo "<p class='mb-0'>Contacta amb l'administrador per restaurat alguna còpia de seguretat.</p>";
            echo '</div>';
        }
        else{
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h4 class="alert-heading">Error!!</h4>';
            echo "<p>Per algun motiu desconegut, el director no s'ha pogut esborrar.</p>";
            echo '<hr>';
            echo "<p class='mb-0'>Contacta amb l'administrador amb aquest error.</p>";
            echo '</div>';
        }
    }   

    ?>
    <a href="javascript:history.back()"> Volver Atrás</a>
    </div>
</body>

</html>