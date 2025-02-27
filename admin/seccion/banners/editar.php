<?php 
include("../../templates/header.php");
include("../../conexion.php");

//recuperar los datos según la id
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_banners WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $titulo=$registro["titulo"];
    $descripcion=$registro["descripcion"];
    $link=$registro["link"];
}

//luego de recuperar los datos se los modifica
if($_POST){
    $titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:"";
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:"";
    $link=(isset($_POST["link"]))?$_POST["link"]:"";
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";

    $sentencia=$conexion->prepare("UPDATE tbl_banners 
    SET titulo=:titulo, descripcion=:descripcion, link=:link WHERE ID=:id");
    
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":link",$link);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();
    header("Location:index.php");
}
?>

<br>
<div class="card">
    <div class="card-header">Banners</div>
    <div class="card-body">
        <form action="" method="POST">

            <div class="mb-3">
                <!--id-->
                <label for="titulo" class="form-label">ID:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $txtID; ?>"
                    name="txtID"
                    id="txtID"
                    aria-describedby="helpId"
                    placeholder="Escriba el título del banner"
                />
            </div>

            <!--titulo del banner-->
            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $titulo; ?>"
                    name="titulo"
                    id="titulo"
                    aria-describedby="helpId"
                    placeholder="Escriba el título del banner"
                />
            </div>
            
            <!--Descripción-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $descripcion; ?>"
                    name="descripcion"
                    id="descripcion"
                    aria-describedby="helpId"
                    placeholder="Escriba la descripción del banner"
                />
            </div>

            <!--Enlace-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Enlace:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $link; ?>"
                    name="link"
                    id="link"
                    aria-describedby="helpId"
                    placeholder="Escriba Escriba el enlace para"
                />
            </div>

            <!--Botones-->
            <button type="submit" class="btn btn-success">Modificar Banner</button>
            <a
                name=""
                id=""
                class="btn btn-primary"
                href="index.php"
                role="button"
                >Cancelar</a
            >
            
            
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>