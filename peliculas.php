<?php

session_start();
$user="";

// Si l'usuari ja està loguejat i s'ha guardat en una cookie
if (isset($_COOKIE["user"])||isset($_SESSION["user"])){
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!--        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
--> 
<link rel="stylesheet" href="./css/estilos.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>

<!--
    <div class="alert alert-secondary d-flex">
        <a href="./peliculas.php" class="btn btn-dark">Películas</a>&nbsp;&nbsp;
    </div>
-->
<!--
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Sitio Web</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Inicio</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">P&aacute;gina 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">P&aacute;gina 1-1</a></li>
          <li><a href="#">P&aacute;gina 1-2</a></li>
          <li><a href="#">P&aacute;gina 1-3</a></li>
        </ul>
      </li>
      <li><a href="#">P&aacute;gina 2</a></li>
      <li><a href="#">P&aacute;gina 3</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Registrase</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Acceder</a></li>
    </ul>
  </div>
</nav>
-->
    <div class="container">
        <!-- ESCRIBE AQUÍ TU CÓDIGO -->
        <div class="row mx-auto">
        <?php
        
       
        require_once('bbdd/peliculas_crud.php');
        $crudPeli= new CrudPelis(); 
 
        $lesPelis=$crudPeli->getAllPeliculas();
        
        
        foreach($lesPelis as $peli){

           
            echo '<div class="card-body" style="width: 20%;">';
            
            echo '<a href="peliculas_ficha.php?id=' . $peli->getId() . '">';
            
            $nomCaratula="./imgs/peliculas/" . $peli->getId() . ".jpg";
            //echo $nomCaratula;
            
            // sino existeix li posem imatge per defecte
            
            if (!file_exists($nomCaratula)){
                $nomCaratula="./imgs/peliculas/0.jpg";
            }

            // comprovem existencia del fixer
            echo '<img class="card-img-top" width="200px" height="480px" src="' . $nomCaratula . '" />';
            echo '</a>';
          
            echo '<h6 class="card-title text-center">' . $peli->getTitulo() . '</h6>';
            
            //echo '<input type="submit" name="Editar">';
            //echo '<input type="submit" name="Eliminar">';
            
            echo '<div class="btn-group">';
            echo "<button class='btn btn-primary ml-3'><a href='peliculas_form.php?peli=" . $peli->getId() . "' style='color:white;'>Editar</a></button>";
            
           // echo "<a href='vectorSerializado1.php?miArray=" . serialize($peli) . "'>ir</a>";
            
            echo "<button class='btn btn-danger ml-3'><a href='peliculas_borrado.php?id=" . $peli->getId() . "' style='color:white;'>Eliminar</a></button>";
            echo '</div>';
            
            echo '</div>';
            
        }

        ?>

    
    
    
</div>

    </div>


</body>

</html>