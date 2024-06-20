<?php 
include("../../templates/header.php");
include("../../conexion.php");

if($_POST){

    $opinion=(isset($_POST["opinion"]))?$_POST["opinion"]:"";
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";

    //insertar datos
    $sentencia=$conexion->prepare("INSERT INTO 
    tbl_testimonios (ID, opinion, nombre) 
    VALUES (NULL, :opinion, :nombre);");

    $sentencia->bindParam(":opinion", $opinion);
    $sentencia->bindParam(":nombre", $nombre);

    $sentencia->execute();
    header("Location:index.php");
}
?>

<br>
<div class="card">
    <div class="card-header">
        Reseñas
    </div>
    <div class="card-body">

        <form action="" method="POST">
            <!--opinion-->
            <div class="mb-3">
                <label for="opinion" class="form-label">Opinión:</label>
                <input
                    type="text"
                    class="form-control"
                    name="opinion"
                    id="opinion"
                    aria-describedby="helpId"
                    placeholder="Deje su opinión"
                />
            </div>

            <!--nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombre"
                    id="nombre"
                    aria-describedby="helpId"
                    placeholder="Deje su nombre"
                />
            </div>

            <!--botones-->
            <button type="submit" class="btn btn-success">Agregar nuevo comentario</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>


<?php
include("../../templates/footer.php");
?>