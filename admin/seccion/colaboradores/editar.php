<?php 
include("../../templates/header.php");
include("../../conexion.php");


if($_POST){

    //recepción de datos
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $linkfacebook=(isset($_POST['linkfacebook']))?$_POST['linkfacebook']:"";
    $linkinstagram=(isset($_POST['linkinstagram']))?$_POST['linkinstagram']:"";
    $whatsapp=(isset($_POST['whatsapp']))?$_POST['whatsapp']:"";

    //editar y actualizar los registros seleccionados
    $sentencia=$conexion->prepare("UPDATE tbl_colaboradores 
    SET 
    titulo=:titulo, 
    descripcion=:descripcion,
    linkfacebook=:linkfacebook,
    linkinstagram=:linkinstagram,
    whatsapp=:whatsapp 
    WHERE ID=:id");
    
    $sentencia->bindParam(":titulo",$titulo);
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":linkfacebook",$linkfacebook);
    $sentencia->bindParam(":linkinstagram",$linkinstagram);
    $sentencia->bindParam(":whatsapp",$whatsapp);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();
    //header("Location:index.php");

    //recuperar los datos de la foto para poder actualizarla
    $foto=(isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:"";
    $tmp_foto=$_FILES["foto"]["tmp_name"];

    if($foto!=""){
        $fecha_foto=new Datetime(); //recuperar fecha para colocar el nuevo nombre
        $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
        move_uploaded_file($tmp_foto,"../../../img/colaboradores/".$nombre_foto); //mover la foto

        $sentencia=$conexion->prepare("SELECT * FROM tbl_colaboradores WHERE ID=:id"); //seleccionar la foto vieja
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY);
        //print_r($registro_foto);

        if(isset($registro_foto['foto'])){
            if(file_exists("../../../img/colaboradores/".$registro_foto['foto'])){ //pregunta si existe la foto
                unlink("../../../img/colaboradores/".$registro_foto['foto']); //si existe se la elimina
            }
        }

        //editar y actualizar la foto del registro seleccionado
        $sentencia=$conexion->prepare("UPDATE tbl_colaboradores 
        SET 
        foto=:foto 
        WHERE ID=:id");
        
        $sentencia->bindParam(":foto",$nombre_foto);
        $sentencia->bindParam(":id",$txtID);

        $sentencia->execute();
    }
}

//recuperar los datos según la id
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_colaboradores WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $titulo=$registro["titulo"];
    $descripcion=$registro["descripcion"];
    $foto=$registro["foto"];
    $linkfacebook=$registro["linkfacebook"];
    $linkinstagram=$registro["linkinstagram"];
    $whatsapp=$registro["whatsapp"];


}
?>

<br>
<div class="card">
    <div class="card-header">Colaboradores</div>
    <div class="card-body">

    <form action="" method="POST" enctype="multipart/form-data">

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

        <!--seleccionar foto-->
        <div class="mb-3">    
            <label for="foto" class="form-label">Foto:</label><br>
            <img width="50" src="../../../img/colaboradores/<?php echo $foto; ?>">
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
                value="<?php echo $titulo; ?>"
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
                value="<?php echo $descripcion; ?>"
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
                value="<?php echo $linkfacebook; ?>"
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
                value="<?php echo $linkinstagram; ?>"
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
                value="<?php echo $whatsapp; ?>"
                class="form-control"
                name="whatsapp"
                id="whatsapp"
                aria-describedby="helpId"
                placeholder="whatsapp"
            />
        </div>

        <!--Botones-->
        <button type="submit" class="btn btn-success">Modificar datos</button>
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
    <div class="card-footer text-muted">

    </div>
</div>

<?php
include("../../templates/footer.php");
?>