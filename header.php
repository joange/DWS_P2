
<?php
if (isset($_SESSION["user"])){
  $user=$_SESSION["user"];
  $txtLog="Salir";
  $btnLog="in";
}
else{
  $user="Registarse";
  $txtLog="Entrar";
  $btnLog="out";
}
?>

<nav class="navbar navbar-default bg-light">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Gestió de Películes</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="peliculas.php">Peliculas</a></li>
      <li><a href="#">Actores</a></li>
      <li><a href="#">Directores</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Mantenimineto<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="peliculas.php">Películas</a></li>
          <li><a href="#">Actores</a></li>
          <li><a href="#">Directores</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?=$user?></a></li>
      <li><a href="index.php?salir=true"><span class="glyphicon glyphicon-log-<?=$btnLog?>"></span> <?=$txtLog?> </a></li>      
    </ul>
  </div>
</nav>
<!--

      -->