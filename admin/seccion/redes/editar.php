<?php 
include("../../templates/header.php");
include("../../conexion.php");

//recuperar los datos según la id
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_redes WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $linkfacebook=$registro["linkfacebook"];
    $linkinstagram=$registro["linkinstagram"];
    $whatsapp=$registro["whatsapp"];
}

//actualizar los datos
if($_POST){
    $linkfacebook=(isset($_POST["linkfacebook"]))?$_POST["linkfacebook"]:"";
    $linkinstagram=(isset($_POST["linkinstagram"]))?$_POST["linkinstagram"]:"";
    $whatsapp=(isset($_POST["whatsapp"]))?$_POST["whatsapp"]:"";

    $sentencia=$conexion->prepare("UPDATE tbl_redes SET
    linkfacebook=:linkfacebook, linkinstagram=:linkinstagram, whatsapp=:whatsapp WHERE ID=:id");

    $sentencia->bindParam(":linkfacebook", $linkfacebook);
    $sentencia->bindParam(":linkinstagram", $linkinstagram);
    $sentencia->bindParam(":whatsapp", $whatsapp);
    $sentencia->bindParam(":id", $txtID);
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

            <!--id-->
            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $txtID; ?>"
                    name="txtID"
                    id="txtID"
                    aria-describedby="helpId"
                    placeholder=""
                />
            </div>
            
            <!--facebook-->
            <div class="mb-3">
                <label for="linkfacebook" class="form-label">Facebook:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $linkfacebook; ?>"
                    name="linkfacebook"
                    id="linkfacebook"
                    aria-describedby="helpId"
                    placeholder="Enlace de Facebook"
                />
            </div>

            <!--instagram-->
            <div class="mb-3">
                <label for="linkinstagram" class="form-label">Instagram:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $linkinstagram; ?>"
                    name="linkinstagram"
                    id="linkinstagram"
                    aria-describedby="helpId"
                    placeholder="Enlace de Instagram"
                />
            </div>

            <!--whatsapp-->
            <div class="mb-3">
                <label for="whatsapp" class="form-label">Whatsapp:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $whatsapp; ?>"
                    name="whatsapp"
                    id="whatsapp"
                    aria-describedby="helpId"
                    placeholder="Whatsapp"
                />
            </div>

            <!--botones-->
            <button type="submit" class="btn btn-success">Modificar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            
        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php
include("../../templates/footer.php");
?>