<?php
//print_r($_POST);
// Array ( [email] => joangerard@gmail.com [password] => qwe [vpassword] => wqe )

require_once('bbdd/usuarios_crud.php');

$email="";
$pass1="";
$pass2="";

$error=false;

if (isset($_POST["email"]))
    $email=$_POST["email"];
else{
    $error=true;
}
if (isset($_POST["password"]))
    $pass1=$_POST["password"];
else{
    $error=true;
}

if (isset($_POST["vpassword"]))
    $pass2=$_POST["vpassword"];
else{
    $error=true;
}

if ($pass1!=$pass2){
    echo "<script type='text/javascript'>alert('Els passwords no coincideixen');</script>";
    $error=true;
}

if (!$error){  // si no hi ha error, inserim
    $crudUser= new CrudUsuario(); 

    $user=new Usuario();
    $user->setEmail($email);
    $user->setPassword($pass1);

    if ($crudUser->existeEmail($user)){
        echo "<script type='text/javascript'>alert('El email està en ús. Triar-ne altre');</script>";
    }
    else{
        $crudUser->insertUsuario($user);
        header("Location: ./index.php");
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">  
            
        <link rel="stylesheet" href="./css/estilos.css">  
    </head>
    <body>
    
        <div class="alert alert-secondary d-flex">
            <a href="./peliculas.php" class="btn btn-dark">Listar películas</a>
        </div>  

    <main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Alta de nou usuari</div>
                    <div class="card-body">
                        <form action="usuario_alta.php" method="POST">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                <div class="col-md-6">
                                    <input type="email" id="email" class="form-control" name="email" required autofocus value="<?=$email?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" required value="<?=$pass1?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="vpassword" class="col-md-4 col-form-label text-md-right">Verificar Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="vpassword" class="form-control" name="vpassword" required value="<?=$pass2?>">
                                </div>
                            </div>

                            
                            <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary"> Guardar </button>
                                
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