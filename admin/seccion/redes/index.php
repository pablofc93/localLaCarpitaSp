<?php 
include("../../templates/header.php");
include("../../conexion.php");

//eliminar un registro de comentario
if(isset($_GET["txtID"])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("DELETE FROM tbl_redes WHERE ID=:id");

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("Location:index.php");
}

//seleccionar datos
$sentencia=$conexion->prepare("SELECT * FROM tbl_redes");
$sentencia->execute();
$lista_redes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            Agregar Registros
        </a>
    </div>

    <div class="card-body">

        <div
            class="table-responsive-sm"
        >
            <table
                class="table"
            >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Facebook</th>
                        <th scope="col">Instagram</th>
                        <th scope="col">Whatsapp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_redes as $key => $value){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $value['ID']; ?></td>
                        <td><?php echo $value['linkfacebook']; ?></td>
                        <td><?php echo $value['linkinstagram']; ?></td>
                        <td><?php echo $value['whatsapp']; ?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value['ID'] ?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value['ID'] ?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php }?>
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