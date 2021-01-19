<head>
        <meta charset="utf-8">
        <title>Proves CRUD</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">   
        
    </head>
<body> 


<?php

require_once('bbdd/peliculas_crud.php');
require_once('bbdd/directores_crud.php');
require_once('bbdd/actores_crud.php');
require_once('bbdd/usuarios_crud.php');
/* En principi s'importen als propis CRUDS
require_once('./classes/ususarios.php');
require_once('./classes/peliculas.php');
require_once('./classes/directores.php');
require_once('./classes/actores.php');
*/


echo "INICI<hr>";
//$crudPeli= new CrudPelis(); 
//$crudDire= new CrudDires(); 
//$crudActor= new CrudActores(); 

$crudUser= new CrudUsuario(); 

echo "CRUD<hr>";

//$crudPeli->deletePelicula(17);

/*
$peli= new Pelicula();

$peli->setId("99");
$peli->setTitulo("Pulp Fiction");
$peli->setAnyo(1993);
$peli->setDuracion(174);


$crudPeli->insertPelicula($peli);


$peli= new Pelicula();

$peli->setId(19);
$peli->setTitulo("Kill Bill 2");
$peli->setAnyo(1998);
$peli->setDuracion(210);


$crudPeli->updatePelicula($peli);

echo "Inici<hr>";

$pelis=$crudPeli->getAllPeliculas();
print_r($pelis);
echo "<hr>Sols una peli";
$peli=$crudPeli->getPeliculaById(2);
print_r($peli);


$actores=$crudPeli->obtenerActoresPelicula(1);
print_r($actores);
echo "<hr>";
$directores=$crudPeli->obtenerDirectoresPelicula(3);
print_r($directores);
*/

/*
echo "TOTS ELS DIRECTORS<hr>";
$dires=$crudDire->getAllDirectores();
print_r($dires);

echo "<hr>UN SOL DIRECTOR<hr>";
$dire=$crudDire->getDirectorById(2);
print_r($dire);

echo "<hr>INSERIM DIRECTOR<hr>";
$dir=new Director();
$dir->setNombre("Alex de la Iglesia");
$dir->setAnyoNacimiento(1967);
$dir->setPais("España");
$crudDire->insertDirector($dir);
$dires=$crudDire->getAllDirectores();
print_r($dires);

echo "<hr>ELIMINEM DIRECTOR<hr>";
$crudDire->deleteDirector(4);
$dires=$crudDire->getAllDirectores();
print_r($dires);

echo "<hr>ACTUALITZEM DIRECTOR<hr>";
$dir=new Director();
$dir->setId(5);
$dir->setNombre("Chiquito de la Calzada");
$dir->setAnyoNacimiento(1953);
$dir->setPais("España");
$crudDire->updateDirector($dir);
$dires=$crudDire->getAllDirectores();
print_r($dires);
*/

/*
echo "<h1> Actores </h1>";


echo "TOTS ELS ACTORS<hr>";
$actores=$crudActor->getAllActores();
print_r($actores);

echo "<hr>UN SOL ACTOR<hr>";
$actor=$crudActor->getActorById(2);
print_r($actor);

echo "<hr>INSERIM ACTOR<hr>";
$act=new Actor();
$act->setNombre("Alex de la Iglesia");
$act->setAnyoNacimiento(1967);
$act->setPais("España");
$crudActor->insertActor($act);
$actores=$crudActor->getAllActores();
print_r($actores);

echo "<hr>ELIMINEM ACTOR<hr>";
$crudActor->deleteActor(12);
$actores=$crudActor->getAllActores();
print_r($actores);


echo "<hr>ACTUALITZEM ACTOR<hr>";
$act=new Actor();
$act->setId(15);
$act->setNombre("Chiquito de la Calzada");
$act->setAnyoNacimiento(1953);
$act->setPais("España");
$crudActor->updateActor($act);
$actores=$crudActor->getAllActores();
print_r($actores);

*/

/*

$users=$crudUser->listarUsuarios();
print_r($users);


$user=new Usuario();
$user->setEmail('jgcamarena@gmail.com');
$user->setPassword("123456");

//$crudUser->insertUsuario($user);

$users=$crudUser->listarUsuarios();
print_r($users);

if ($crudUser->validaUsuario($user))
    echo "L'usuari " . $user->getEmail() . " és correcte.";
else
    echo "L'usuari " . $user->getEmail() . " és incorrecte.";

*/
$user=new Usuario();
$user->setEmail('jgcamarena@gmail.com');
$user->setPassword("123456");

if ($crudUser->existeEmail($user))
    echo "L'usuari " . $user->getEmail() . " existeix a la BBDD.";
else
    echo "L'usuari " . $user->getEmail() . " no Existeix.";
?>


<h3>FINAL</h3>

</body>

