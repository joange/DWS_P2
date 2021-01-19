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

<head>
    <meta charset="utf-8">
    <title>Películas</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/estilos.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        

     
</head>

<body>

<?php include 'header.php'; ?>

<?php

require_once('bbdd/peliculas_crud.php');
$crudPeli= new CrudPelis(); 

if (isset($_GET["pelidel"])){
    $result=$crudPeli->deletePelicula($_GET["pelidel"]);
    if(!$result){
        echo '<div class="alert alert-danger" role="alert">';
        echo '<h4 class="alert-heading">Error!!</h4>';
        echo "<p>Per algun motiu desconegut, la pel·lícula no s'ha pogut esborrar.</p>";
        echo '<hr>';
        echo "<p class='mb-0'>Contacta amb l'administrador amb aquest error.</p>";
        echo '</div>';
    }
    else{
        echo '<div class="alert alert-success" role="alert">';
        echo '<h4 class="alert-heading">Ben fet!!</h4>';
        echo "<p>La pel·lícula s'ha esborrat correctament.</p>";
        echo '<hr>';
        echo "<p class='mb-0'>Contacta amb l'administrador per restaurat alguna còpia de seguretat.</p>";
        echo '</div>';
        
    }
}
?>


<div class="container">
    <div class="row">

        <?php
        
        $lesPelis=$crudPeli->getAllPeliculas();
        

        foreach($lesPelis as $peli){

           echo '<div class="col-md-4 col-lg-3">';
           echo '<div class="card text-center">';

           $nomCaratula="./imgs/peliculas/" . $peli->getId() . ".jpg";
           // sino existeix li posem imatge per defecte
            
           if (!file_exists($nomCaratula)){
                $nomCaratula="./imgs/peliculas/0.jpg";
            }

            echo '<a href="peliculas_ficha.php?id=' . $peli->getId() . '">';
            echo '<img class="card-img-top" width="100%"  src="' . $nomCaratula . '" alt="' . $peli->getTitulo() . '" >';
            echo '</a>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $peli->getTitulo() . '</h5>';
            echo '</div>';
            echo '<div class="card-footer text-center">';
            echo '<a href="peliculas_form.php?peli=' . $peli->getId() . '" class="btn btn-primary">Editar Pelicula </a>';
            echo ' ';
            echo '<a href="peliculas.php?pelidel=' . $peli->getId() . '" class="btn btn-danger">Eliminar Pelicula </a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        
        }

        ?>

</div>  <!--row-->
</div>  <!--container-->


</body>

</html>