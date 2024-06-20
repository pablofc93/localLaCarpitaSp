<?php 
include("../../templates/header.php");
include("../../conexion.php");

if($_POST){

    //recepción de datos
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $nombre=(isset($_POST["nombre"]))?$_POST["nombre"]:"";
    $ingredientes=(isset($_POST["ingredientes"]))?$_POST["ingredientes"]:"";
    $precio=(isset($_POST["precio"]))?$_POST["precio"]:"";
    
    //print_r("antes de sql: ".$nombre."    ");

    //editar y actualizar los registros seleccionados
    $sentencia=$conexion->prepare("UPDATE tbl_menu
    SET 
    nombre=:nombre, 
    ingredientes=:ingredientes,
    precio=:precio 
    WHERE ID=:id");
    
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":ingredientes",$ingredientes);
    $sentencia->bindParam(":precio",$precio);
    $sentencia->bindParam(":id",$txtID);

    $sentencia->execute();

    //recuperar los datos de la foto para poder actualizarla
    $foto=(isset($_FILES['foto']["name"]))?$_FILES['foto']["name"]:"";
    $tmp_foto=$_FILES["foto"]["tmp_name"];

    if($foto!=""){
        $fecha_foto=new Datetime(); //recuperar fecha para colocar el nuevo nombre
        $nombre_foto=$fecha_foto->getTimestamp()."_".$foto;
        move_uploaded_file($tmp_foto,"../../../img/carta/".$nombre_foto); //mover la foto

        $sentencia=$conexion->prepare("SELECT * FROM tbl_menu WHERE ID=:id"); //seleccionar la foto vieja
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY);
        //print_r($registro_foto);

        if(isset($registro_foto['foto'])){
            if(file_exists("../../../img/carta/".$registro_foto['foto'])){ //borrar la foto vieja
                unlink("../../../img/carta/".$registro_foto['foto']);
            }
        }

        //editar y actualizar la foto del registro seleccionado
        $sentencia=$conexion->prepare("UPDATE tbl_menu 
        SET 
        foto=:foto 
        WHERE ID=:id");
        
        $sentencia->bindParam(":foto",$nombre_foto);
        $sentencia->bindParam(":id",$txtID);

        $sentencia->execute();
    }
    header("Location:index.php");
}

//recuperar los datos según la id
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_menu WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $nombre=$registro["nombre"];
    $ingredientes=$registro["ingredientes"];
    $foto=$registro["foto"];
    $precio=$registro["precio"];

}

?>

<br>
<div class="card">
    <div class="card-header">
        Carta de La Carpita
    </div>
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">

            <!--ID-->
            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $txtID; ?>"
                    name="txtID"
                    id="txtID"
                />
            </div>
            

            <!--Nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $nombre; ?>"
                    name="nombre"
                    id="nombre"
                    aria-describedby="helpId"
                    placeholder="Escriba el nombre del plato/sandwich"
                />
            </div>

            <!--Ingredientes-->
            <div class="mb-3">
                <label for="ingredientes" class="form-label">Ingredientes:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $ingredientes; ?>"
                    name="ingredientes"
                    id="ingredientes"
                    aria-describedby="helpId"
                    placeholder="Escriba los ingredientes separados por comas"
                />
            </div>

            <!--subir foto de sandwich-->
            <div class="mb-3">    
                <label for="foto" class="form-label">Foto:</label>
                <br>
                <img width="50" src="../../../img/carta/<?php echo $foto; ?>">
                <input
                    type="file"
                    class="form-control"
                    name="foto"
                    id="foto"
                    placeholder=""
                    aria-describedby="fileHelpId"
                />
            </div>

            <!--Precio-->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input
                    type="text"
                    class="form-control"
                    value="<?php echo $precio; ?>"
                    name="precio"
                    id="precio"
                    aria-describedby="helpId"
                    placeholder="Escriba el precio del sandwich"
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