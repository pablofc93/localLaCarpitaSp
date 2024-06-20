<?php 
include("../../templates/header.php");
include("../../conexion.php");

//eliminar registros
if(isset($_GET['txtID'])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    //eliminar la imagen, el archivo físico del chef o colaborador
    //que está en la carpeta de colaboradores 
    $sentencia=$conexion->prepare("SELECT * FROM tbl_colaboradores WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY);
    print_r($registro_foto);

    if(isset($registro_foto['foto'])){
        if(file_exists("../../../img/colaboradores/".$registro_foto['foto'])){
            unlink("../../../img/colaboradores/".$registro_foto['foto']);
        }
    }


    //eliminar los registros que están en la base de datos
    $sentencia=$conexion->prepare("DELETE FROM tbl_colaboradores WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

//seleccionar datos
$sentencia=$conexion->prepare("SELECT * FROM tbl_colaboradores");
$sentencia->execute();
$lista_colaboradores=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<br>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros</a>
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
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Redes Sociales</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($lista_colaboradores as $key => $value) { ?>
                    <tr class="">
                        <td scope="row"><?php echo $value['ID'] ?></td>
                        <td><?php echo $value['titulo'] ?></td>
                        <td>
                            <img src="../../../img/colaboradores/<?php echo $value['foto'] ?>" width="50" alt="">
                        </td>
                        <td><?php echo $value['descripcion'] ?></td>
                        <td>
                            <?php echo $value['linkfacebook'] ?><br>
                            <?php echo $value['linkinstagram'] ?><br>
                            <?php echo $value['whatsapp'] ?>
                        </td>   
                        <td>
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value['ID'] ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value['ID'] ?>" role="button">Eliminar</a>
                            </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        
    </div>
    
</div>


<?php include("../../templates/footer.php"); ?>