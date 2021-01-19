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
    <title>Edición de películas</title>
</head>

<body>
    
<?php include 'header.php'; ?>
 
<?php

require_once('bbdd/peliculas_crud.php');
$crudPeli= new CrudPelis(); 
if (isset($_GET["peli"])){
    $id=$_GET["peli"];
    $peli=$crudPeli->getPeliculaById($id);
    if (is_null($peli)){
        header("Location: ./peliculas.php");
    }
}
else{
    if (isset($_POST["id"])){
        $updPeli=new Pelicula();

        $updPeli->setId($_POST["id"]);
        $updPeli->setTitulo($_POST["titulo"]);
        $updPeli->setAnyo($_POST["anyo"]);
        $updPeli->setDuracion($_POST["duracion"]);

        if ($crudPeli->updatePelicula($updPeli)==1){
            echo '<div class="alert alert-success" role="alert">';
            echo '<h4 class="alert-heading">Ben fet!!</h4>';
            echo "<p>La pel·lícula s'ha actualitzat correctament.</p>";
            echo '<hr>';
            echo "<p class='mb-0'>Contacta amb l'administrador per restaurat alguna còpia de seguretat.</p>";
            echo '</div>';
            $peli=$updPeli;
        }
        else{
            echo '<div class="alert alert-danger" role="alert">';
            echo '<h4 class="alert-heading">Error!!</h4>';
            echo "<p>Per algun motiu desconegut, la pel·lícula no s'ha pogut actualitzar.</p>";
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
    <form class="border border-light p-5" action="peliculas_form.php" method="POST">

        <p class="h4 mb-3">Edició de Películes</p>

        <label>Id</label>
        <input type="text" id="idId" name="id" class="form-control mb-4"value="<?=$peli->getId()?>" readonly>

        
        <label>Titulo</label>
        <input type="text" id="Titulo" name="titulo" class="form-control mb-4" placeholder="Titol" value="<?=$peli->getTitulo()?>">

        
        <label>Anyo</label>
        <input type="number" id="idAny" name="anyo" class="form-control mb-4" placeholder="Anyo" value="<?=$peli->getAnyo()?>">

        
        <label>Duracion</label>
        <input type="number" id="idDurada" name="duracion" class="form-control mb-4" placeholder="Duración" value="<?=$peli->getDuracion()?>">
        <br>
        <button class="btn btn-info btn-block my-4" type="submit">Guardar</button>


</form>
<a href="javascript:history.back()"> Volver Atrás</a>
    </div>

</body>

</html>