<?php
include("../../templates/header.php");
include("../../conexion.php");

if($_POST){
    //recepción de datos
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $linkfacebook=(isset($_POST['linkfacebook']))?$_POST['linkfacebook']:"";
    $linkinstagram=(isset($_POST['linkinstagram']))?$_POST['linkinstagram']:"";
    $whatsapp=(isset($_POST['whatsapp']))?$_POST['whatsapp']:"";

    //insertar datos en la base de datos, tabla colaboradores    
    //consulta sql para insertar
    $sentencia=$conexion->prepare("
    INSERT INTO tbl_colaboradores (ID, titulo, descripcion, linkfacebook, linkinstagram, whatsapp, foto) 
    VALUES (NULL, :titulo, :descripcion, :linkfacebook, :linkinstagram, :whatsapp, :foto);");

    //insertar foto
    $foto=(isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:"";
    $fecha_foto=new Datetime();
    $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
    $tmp_foto=$_FILES["foto"]["tmp_name"];

    if($tmp_foto!=""){
        move_uploaded_file($tmp_foto,"../../../img/colaboradores/".$nombre_foto);
    }

    //preparar los parámetros para la consulta
    $sentencia->bindParam(":foto",$nombre_foto);
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":linkfacebook",$linkfacebook);
    $sentencia->bindParam(":linkinstagram",$linkinstagram);
    $sentencia->bindParam(":whatsapp",$whatsapp);

    $sentencia->execute();
    header("Location:index.php");

}

?>

<br>
<div class="card">
    <div class="card-header">Colaboradores</div>
    <div class="card-body">

    <form action="" method="POST" enctype="multipart/form-data">

        <!--seleccionar foto-->
        <div class="mb-3">    
            <label for="foto" class="form-label">Foto:</label>
            <input
                type="file"
                class="form-control"
                name="foto"
                id="foto"
                placeholder=""
                aria-describedby="fileHelpId"
            />
            <div id="fileHelpId" class="form-text">Help text</div>
        </div>

        <!--nombre-->
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input
                type="text"
                class="form-control"
                name="titulo"
                id="titulo"
                aria-describedby="helpId"
                placeholder="titulo"
            />
        </div>

        <!--descripción-->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input
                type="text"
                class="form-control"
                name="descripcion"
                id="descripcion"
                aria-describedby="helpId"
                placeholder="descripción"
            />
        </div>

        <!--redes sociales-->
        <div class="mb-3">
            <label for="linkfacebook" class="form-label">Facebook:</label>
            <input
                type="text"
                class="form-control"
                name="linkfacebook"
                id="linkfacebook"
                aria-describedby="helpId"
                placeholder="linkfacebook"
            />
        </div>

        <div class="mb-3">
            <label for="linkinstagram" class="form-label">Instagram:</label>
            <input
                type="text"
                class="form-control"
                name="linkinstagram"
                id="linkinstagram"
                aria-describedby="helpId"
                placeholder="instagram"
            />
        </div>

        <div class="mb-3">
            <label for="whatsapp" class="form-label">Whatsapp:</label>
            <input
                type="text"
                class="form-control"
                name="whatsapp"
                id="whatsapp"
                aria-describedby="helpId"
                placeholder="whatsapp"
            />
        </div>

        <!--Botones-->
        <button type="submit" class="btn btn-success">
            Agregar colaborador
        </button>
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="index.php"
            role="button"
            >Cancelar
        </a>

        
    </form>
        
    </div>
    <div class="card-footer text-muted">

    </div>
</div>


<?php
include("../../templates/footer.php");
?>