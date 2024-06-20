<?php
include("conexion.php");

if($_POST){
    //print_r($_POST);
    session_start(); //variable de sesion en inicio

    //se reciben los datos de usuario y contra del formulario de login
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $password=(isset($_POST["password"]))?$_POST["password"]:"";
    $password=md5($password);

    //búsqueda de esos datos en la bd y se los asigna a una variable n_usuario
    $sentencia=$conexion->prepare("SELECT *, COUNT(*) AS n_usuario
    FROM tbl_usuarios
    WHERE nombre=:nombre
    AND password=:password
    ");

    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":password",$password);
    $sentencia->execute(); //se ejecuta la consulta sql

    //obtener la lista del usuario que se encontró en la bd
    $lista_usuarios=$sentencia->fetch(PDO::FETCH_LAZY);
    $n_usuario=$lista_usuarios["n_usuario"]; //se captura el usuario y se lo envía a la variable $n_usuario
    //print_r($n_usuario);
    if($n_usuario==1){
        echo "Redireccionar...";
        $_SESSION["nombre"]=$lista_usuarios["nombre"];
        $_SESSION["logueado"]=true;

        header("Location:index.php");
    }else{
        $mensaje="El usuario y/o contraseña no son correctos...";
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        
        <main>
            <divclass="container">
                <div class="row">
                    <div class="col"></div>
                    
                    <div class="col">
                        <br><br>
                        <?php if(isset($mensaje)){?>
                            <div
                                class="alert alert-danger"
                                role="alert"
                            >
                                <strong>Error:</strong> <?php echo $mensaje; ?>
                            </div>
                        <?php }?>

                        <div class="card text-center">
                            <div class="card-header">Login</div>
                            <div class="card-body">
                                <form action="login.php" method="post">

                                    <!--usuario-->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Usuario:</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nombre"
                                            id="nombre"
                                            aria-describedby="helpId"
                                            placeholder=""
                                        />
                                    </div>

                                    <!--contraseña-->
                                    <div class="mb-3">
                                        <label for="" class="form-label">Contraseña:</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            id="password"
                                            placeholder=""
                                        />
                                    </div>

                                    <!--boton ingresar-->
                                    <button type="submit" class="btn btn-primary">
                                        Ingresar
                                    </button>
                                    
                                </form>
                            </div>

                        </div>
                        
                    </div>

                    <div class="col"></div>
                </div>
                
            </div>
            
        </main>
       
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

<?php

?>
