<?php

session_start();
$user="";

// Si l'usuari ja està loguejat i s'ha guardat en una cookie
if (isset($_SESSION["user"])){
    $user=$_SESSION["user"];
}
else{   // 
    header("Location: ./index.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    
    <link rel="stylesheet" href="./css/estilos.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Edición de actores</title>
</head>

<body>

<?php include 'header.php'; ?>
 
<?php
print_r($_GET);
print_r($_POST);
require_once('bbdd/actores_crud.php');
$crudActor= new CrudActores(); 
if (isset($_GET["actor"])){
    $id=$_GET["actor"];
    $actor=$crudActor->getActorById($id);
    if (is_null($actor)){
        header("Location: ./peliculas.php");
    }
}
else{
    if (isset($_POST["id"])){
        $updActor=new Actor();

        $updActor->setId($_POST["id"]);
        $updActor->setNombre($_POST["nombre"]);
        $updActor->setAnyoNacimiento($_POST["anyoNacimiento"]);
        $updActor->setPais($_POST["pais"]);

        if ($crudActor->updateActor($updActor)==1){
            echo '<div class="alert alert-success" role="alert">';
            echo '<h4 class="alert-heading">Ben fet!!</h4>';
            echo "<p>El actor s'ha actualitzat correctament.</p>";
            echo '<hr>';
            echo "<p class='mb-0'>Contacta amb l'administrador per restaurat alguna còpia de seguretat.</p>";
            echo '</div>';
            $actor=$updActor;
        }
        else{
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h4 class="alert-heading">Error!!</h4>';
            echo "<p>Per algun motiu desconegut, el actor no s'ha pogut actualitzar.</p>";
            echo '<hr>';
            echo "<p class='mb-0'>Contacta amb l'administrador amb aquest error.</p>";
            echo '</div>';
        }
    }
    else{
        header("Location: ./peliculas.php");
    }
    
}
?>
<div class="container">
<form class="border border-light p-5" action="actores_form.php" method="POST">

<p class="h4 mb-3">Edició de Actores</p>

<label>Id</label>
<input type="text" id="Id" name="id" class="form-control mb-4"value="<?=$actor->getId()?>" readonly>


<label>Titulo</label>
<input type="text" id="Nombre" name="nombre" class="form-control mb-4" placeholder="Nombre" value="<?=$actor->getNombre()?>">


<label>Anyo</label>
<input type="number" id="Any" name="anyoNacimiento" class="form-control mb-4" placeholder="Anyo" value="<?=$actor->getAnyoNacimiento()?>">


<label>Duracion</label>
<input type="text" id="Pais" name="pais" class="form-control mb-4" placeholder="Pais" value="<?=$actor->getPais()?>">
<br>
<button class="btn btn-info btn-block my-4" type="submit">Guardar</button>


</form>
<a href="javascript:history.back()"> Volver Atrás</a>
    </div>

</body>

</html>