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
    <title>Edición de directores</title>
</head>

<body>

<?php include 'header.php'; ?>
 
<?php

require_once('bbdd/directores_crud.php');
$crudDire= new CrudDires(); 
if (isset($_GET["dire"])){
    $id=$_GET["dire"];
    $dire=$crudDire->getDirectorById($id);
    if (is_null($dire)){
        header("Location: ./peliculas.php");
    }
}
else{
    if (isset($_POST["id"])){
        $updDire=new Director();

        $updDire->setId($_POST["id"]);
        $updDire->setNombre($_POST["nombre"]);
        $updDire->setAnyoNacimiento($_POST["anyoNacimiento"]);
        $updDire->setPais($_POST["pais"]);

        if ($crudDire->updateDirector($updDire)){
            echo '<div class="alert alert-success" role="alert">';
            echo '<h4 class="alert-heading">Ben fet!!</h4>';
            echo "<p>El director s'ha actualitzat correctament.</p>";
            echo '<hr>';
            echo "<p class='mb-0'>Contacta amb l'administrador per restaurat alguna còpia de seguretat.</p>";
            echo '</div>';
            $dire=$updDire;
        }
        else{
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h4 class="alert-heading">Error!!</h4>';
            echo "<p>Per algun motiu desconegut, el director no s'ha pogut actualitzar.</p>";
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
    <form class="border border-light p-5" action="directores_form.php" method="POST">

<p class="h4 mb-3">Edició de Directores</p>

<label>Id</label>
<input type="text" id="Id" name="id" class="form-control mb-4"value="<?=$dire->getId()?>" readonly>


<label>Titulo</label>
<input type="text" id="Nombre" name="nombre" class="form-control mb-4" placeholder="Nombre" value="<?=$dire->getNombre()?>">


<label>Anyo</label>
<input type="number" id="Any" name="anyoNacimiento" class="form-control mb-4" placeholder="Anyo" value="<?=$dire->getAnyoNacimiento()?>">


<label>Duracion</label>
<input type="text" id="Pais" name="pais" class="form-control mb-4" placeholder="Pais" value="<?=$dire->getPais()?>">
<br>
<button class="btn btn-info btn-block my-4" type="submit">Guardar</button>


</form>
<a href="javascript:history.back()"> Volver Atrás</a>
    </div>

</body>

</html>