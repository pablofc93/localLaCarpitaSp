<?php 
include("../../templates/header.php");
include("../../conexion.php");

if($_POST){

    $linkfacebook=(isset($_POST["linkfacebook"]))?$_POST["linkfacebook"]:"";
    $linkinstagram=(isset($_POST["linkinstagram"]))?$_POST["linkinstagram"]:"";
    $whatsapp=(isset($_POST["whatsapp"]))?$_POST["whatsapp"]:"";

    //insertar datos
    $sentencia=$conexion->prepare("INSERT INTO 
    tbl_redes (ID, linkfacebook, linkinstagram, whatsapp) 
    VALUES (NULL, :linkfacebook, :linkinstagram, :whatsapp);");

    $sentencia->bindParam(":linkfacebook", $linkfacebook);
    $sentencia->bindParam(":linkinstagram", $linkinstagram);
    $sentencia->bindParam(":whatsapp", $whatsapp);

    $sentencia->execute();
    header("Location:index.php");
}
?>

<br>
<div class="card">
    <div class="card-header">
        Redes Sociales
    </div>
    <div class="card-body">

        <form action="" method="POST">
            <!--facebook-->
            <div class="mb-3">
                <label for="linkfacebook" class="form-label">Facebook:</label>
                <input
                    type="text"
                    class="form-control"
                    name="linkfacebook"
                    id="linkfacebook"
                    aria-describedby="helpId"
                    placeholder="Dirección de Facebook"
                />
            </div>

            <!--intagram-->
            <div class="mb-3">
                <label for="linkinstagram" class="form-label">Instagram:</label>
                <input
                    type="text"
                    class="form-control"
                    name="linkinstagram"
                    id="linkinstagram"
                    aria-describedby="helpId"
                    placeholder="Dirección de Instagram"
                />
            </div>

            <!--whatsapp-->
            <div class="mb-3">
                <label for="whatsapp" class="form-label">Whatsapp:</label>
                <input
                    type="text"
                    class="form-control"
                    name="whatsapp"
                    id="whatsapp"
                    aria-describedby="helpId"
                    placeholder="Whatsapp"
                />
            </div>

            <!--botones-->
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>


<?php
include("../../templates/footer.php");
?>