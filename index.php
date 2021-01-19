<?php

session_start();
// print_r($_POST);
    /*Array ( 
    [email] => jgcamarena@ieseljust.com 
    [password] => Cine1234 
    [remember] => on )
    */
$email="";
$password="";

if (isset($_GET["salir"])){
    session_destroy();
}

// Si l'usuari te la sessió oberta passem a pelicules
if (isset($_SESSION["user"])){
    header("Location: ./peliculas.php");
}
else{   // 

    require_once('bbdd/usuarios_crud.php');

    if (isset($_POST["email"]) && isset($_POST["password"])){
        
        $crudUser= new CrudUsuario(); 

        $email=$_POST["email"];
        $password=$_POST["password"];

        $user=new Usuario();
        $user->setEmail($email);
        $user->setPassword($password);

        if ($crudUser->validaUsuario($user)){
            
            // l'usuari és vàlid. Mirem si està remember. Guardem la cookies
            if (isset($_POST["remember"])){
                setcookie("user",$email,time()+3600*24*365);  
            }
            else{   //cas contrari eliminem la cookie
                setcookie("user",$email,time()-1000); 
            }

            //obrim sessió
            $_SESSION["user"]=$email;
            header("Location: ./peliculas.php");
            
        }
        else{
            echo "<script type='text/javascript'>alert('Les dades són incorrectes. Triar-ne altre');</script>";
        }
        
        
    }

    // Si tinc la galeta, la recupere per al nom d'usuari del formulari
    if (isset($_COOKIE["user"])){
        $email=$_COOKIE["user"];
    }
    
  
}

?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Gestión de películas</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- Bootstrap CSS -->
       
        <link rel="stylesheet" href="./css/estilos.css">  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
    </head>
    <body>

<!--
        <div class="alert alert-secondary d-flex">
        <a href="./peliculas.php" class="btn btn-dark">Listar películas</a>
        <a href="./peliculas.php" class="btn btn-dark btn-right">Cerrar session</a>
        </div> 
-->
  <main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
        <img src="./imgs/portada.png"> 
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registre d'usuari</div>
                    <div class="card-body">
                        <form action="index.php" method="POST">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                <div class="col-md-6">
                                    <input type="email" id="email" class="form-control" name="email" required autofocus value="<?=$email?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required value="<?=$password?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Recordar-me
                                        </label>
                                        
                                    </div>
                                    
                                </div>
                               
                            </div>
                            
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                    Entrar
                                </button>
                                <a href="usuario_alta.php" class="btn btn-link">
                                    Nou usuari
                                </a>
                                <a href="#" class="btn btn-link">
                                    No recorde el meu password
                                </a>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

</main>
    </body>
</html>