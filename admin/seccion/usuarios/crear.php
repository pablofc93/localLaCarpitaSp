<?php 
include("../../templates/header.php");
include("../../conexion.php");

if($_POST){
    //además de recibir los datos se encripta la contraseña con md5
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $password=(isset($_POST["password"]))?$_POST["password"]:"";
    $password=md5($password);
    $correo=(isset($_POST["correo"]))?$_POST["correo"]:"";

    //insertar datos
    $sentencia=$conexion->prepare("INSERT INTO 
    tbl_usuarios (ID, nombre, password, correo) 
    VALUES (NULL, :nombre, :password, :correo);");

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);


    $sentencia->execute();
    header("Location:index.php");
}
?>

<br>
<div class="card">
    <div class="card-header">Usuarios</div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="mb-3">

                <label for="nombre" class="form-label">Nombre de usuario:</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    aria-describedby="helpId"
                    placeholder="ingrese el nombre de usuario"
                />

                <label for="" class="form-label">Contraseña:</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    id="password
                    placeholder="ingrese la contraseña"
                />

                <label for="correo" class="form-label">Correo:</label>
                <input
                    type="text"
                    class="form-control"
                    name="correo"
                    id="correo"
                    aria-describedby="helpId"
                    placeholder="ingrese el correo"
                />

            </div>
            
            <!--botones-->
            <button type="submit" class="btn btn-success">Agregar nuevo usuario</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted">

    </div>
</div>


<?php
include("../../templates/footer.php");
?>