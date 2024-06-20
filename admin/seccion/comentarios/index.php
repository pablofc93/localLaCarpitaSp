<?php 
include("../../templates/header.php");
include("../../conexion.php");

//recibir el id para eliminar un registro con esa id
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    $sentencia=$conexion->prepare("DELETE FROM tbl_comentarios WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

//seleccionar datos
$sentencia=$conexion->prepare("SELECT * FROM tbl_comentarios");
$sentencia->execute();
$lista_comentarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<br>
<div class="card">
    <div class="card-header">Bandeja de comentarios</div>
    <div class="card-body">
        <div
            class="table-responsive"
        >
            <table
                class="table table-responsive-sm"
            >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_comentarios as $registro) { ?>
                    <tr class="">
                        <td><?php echo $registro["ID"]; ?></td>
                        <td><?php echo $registro["nombre"]; ?></td>
                        <td><?php echo $registro["correo"]; ?></td>
                        <td><?php echo $registro["mensaje"]; ?></td>
                        <td>
                        <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registro["ID"]; ?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        

    </div>
    <div class="card-footer text-muted">

    </div>
</div>


<?php 
include("../../templates/footer.php"); 
?>