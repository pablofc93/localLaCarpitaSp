<?php
session_start();
//print_r($_SESSION);
$url_base="http://localhost/restaurant/admin/";
if(!isset($_SESSION["nombre"])){
    header("Location:".$url_base."login.php");
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Área del administrador</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />


        <!--Estas líneas sirven para incluir el buscador y la paginación en los resgistros que se
        muestran en el panel de administración-->
        
        <!-- Incluye jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Incluye DataTables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    </head>

    <body>
        <header>

            <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link active" href="<?php echo $url_base; ?>/index.php" aria-current="page"
                        >Panel de control <span class="visually-hidden">(current)</span></a
                    >

                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/banners/">Banners</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/colaboradores/">Cocineros</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/testimonios/">Reseñas</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/menu/">Carta</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/comentarios/">Comentarios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/usuarios/">Usuarios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>seccion/redes/">Redes sociales</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base; ?>/cerrar.php">Cerrar Sesión</a>

                </div>
            </nav>
            
        </header>
        <main>
<section class="container">