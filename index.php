<?php

include("admin/conexion.php");

$sentencia=$conexion->prepare("SELECT * FROM tbl_banners ORDER BY id DESC limit 1");
$sentencia->execute();
$listaBanners=$sentencia->fetchall(PDO::FETCH_ASSOC);

//consultar datos de los colaboradores
$sentencia=$conexion->prepare("SELECT * FROM tbl_colaboradores ORDER BY id DESC");
$sentencia->execute();
$lista_colaboradores=$sentencia->fetchall(PDO::FETCH_ASSOC);

//consultar datos de los testimonios
$sentencia=$conexion->prepare("SELECT * FROM tbl_testimonios ORDER BY id DESC limit 4");
$sentencia->execute();
$lista_testimonios=$sentencia->fetchall(PDO::FETCH_ASSOC);

//consultar datos de las opciones del menú(carta)
$sentencia=$conexion->prepare("SELECT * FROM tbl_menu ORDER BY id DESC limit 4");
$sentencia->execute();
$lista_menu=$sentencia->fetchall(PDO::FETCH_ASSOC);

//consultar datos de las redes sociales
$sentencia=$conexion->prepare("SELECT * FROM tbl_redes ORDER BY id DESC limit 1");
$sentencia->execute();
$lista_redes=$sentencia->fetch(PDO::FETCH_ASSOC);

$linkfacebook = $lista_redes["linkfacebook"];
$linkinstagram = $lista_redes["linkinstagram"];
$whatsapp = $lista_redes["whatsapp"];

//generar enlace de whatsapp
// Mensaje predeterminado
$mensaje = "Hola, dejanos tu duda y con gusto te responderemos.";
$enlace_whatsapp = "https://wa.me/$whatsapp/?text=" . urlencode($mensaje);



//recibir los mensajes del formulario de contacto(se aplica seguridad)
if($_POST){

    $nombre=filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    $correo=filter_var($_POST["correo"], FILTER_SANITIZE_STRING);
    $mensaje=filter_var($_POST["mensaje"], FILTER_SANITIZE_STRING);

    if($nombre && $correo && $mensaje){
        $sql="INSERT INTO tbl_comentarios (nombre, correo, mensaje) 
        VALUES (:nombre, :correo, :mensaje)";

        $resultado=$conexion->prepare($sql);
        $resultado->bindParam(':nombre',$nombre, PDO::PARAM_STR);
        $resultado->bindParam(':correo',$correo, PDO::PARAM_STR);
        $resultado->bindParam(':mensaje',$mensaje, PDO::PARAM_STR);
        $resultado->execute();
    }
    header("Location:index.php");
}

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
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

        <!--font awesome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" 
        crossorigin="anonymous">
    </head>

    <body>


        <!--menu de navegación-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">La carpita SP</a>

                <!--botón que permite colapsar o expandir los elementos del menú de navegación-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    
                    <!--este navbar contiene los elementos del menú-->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="nav navbar-nav me-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="#inicio">Inicio</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#menu">Menú del día</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#chefs">Chefs</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#testimonios">Reseñas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#contacto">Contacto</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#horarios">Horarios</a>
                            </li>
                        </ul>
                        
                        <!--redes sociales-->
                        <ul class="navbar-nav ml-auto"><!--login-->
                            <li class="nav-item"><!--facebook-->
                                <a 
                                    name="" 
                                    id="" 
                                    class="btn btn-dark" 
                                    href="<?php echo $lista_redes["linkfacebook"]; ?>" 
                                    role="button"
                                    target="_blank"
                                >
                                <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li class="nav-item"><!--instagram-->
                                <a 
                                    name="" 
                                    id="" 
                                    class="btn btn-dark" 
                                    href="<?php echo $lista_redes["linkinstagram"]; ?>" 
                                    role="button"
                                    target="_blank"
                                >
                                <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="nav-item"><!--whatsapp-->
                                <a 
                                    name="" 
                                    id="" 
                                    class="btn btn-dark" 
                                    href="<?php echo $enlace_whatsapp; ?>" 
                                    role="button"
                                    target="_blank"
                                >
                                <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                        </ul>

                    </div>
            </div>
        </nav>
    
        <!--sección de slide o imagen de banner del restaurante-->
        <section id="banner" class="container-fluid p-0">
            <div class="banner-img" style="position:relative; background:url('img/slider-image1.webp') center/cover no-repeat; height:400px;"> <!--div relacionado a la imagen del banner-->
                <div class="banner-text" style="position:absolute; top:50%; left:50%; transform: translate(-50%, -50%); text-align:center; color:#fff;"><!--div relacionado al texto del banner-->

                    <?php foreach($listaBanners as $banner){ ?>
                    <h1><?php echo $banner["titulo"]; ?></h1>
                    <p><?php echo $banner["descripcion"]; ?></p>
                    <a href="<?php echo $banner["link"]; ?>" class="btn btn-primary">Ver menú</a>
                    <?php }?>

                </div>
            </div>
        </section>

        <!--sección de presentación-->
        <section id="id" class="container mt-4 text-center">
                <div class="jumbotron bg-dark text-white">
                    <br>
                    <h2>¡Bienvenido a La Carpita!</h2>
                    <p>
                        Descubrí una experiencia única para tu paladar.
                    </p>
                    <br>
                </div>
        </section>

        <!--sección de chefs-->
        <section id="chefs" class="container mt-4 text-center">
            <h2>Nuestros Cocineros</h2>

            <!--fila cocineros-->
            <div class="row">

                <!--tarjeta cocineros dinámica-->
                <?php foreach($lista_colaboradores as $colaborador){ ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="img/colaboradores/<?php echo $colaborador["foto"]; ?>" 
                        class="card-img-top" alt="Cocinero 1">          

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $colaborador["titulo"]?></h5>
                            <p clas="card-text"><?php echo $colaborador["descripcion"]?></p>
                            <div class="social-icons mt-3">
                                <a href="<?php echo $colaborador["linkfacebook"]?>" class="text-dark me-2"><i class="fab fa-facebook"></i></a>
                                <a href="<?php echo $colaborador["linkinstagram"]?>" class="text-dark me-2"><i class="fab fa-instagram"></i></a>
                                <a href="<?php echo $colaborador["whatsapp"]?>" class="text-dark me-2"><i class="fab fa-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                

            </div>      
        </section>

        <!--sección de testimonios-->
        <section id="testimonios" class="bg-light py-5">
            <div class="container">
                <h2 class="text-center mb-4">
                    Reseñas
                </h2>

                <div class="row">
                    
                    <!--testimonios con foreach-->
                    <?php foreach($lista_testimonios as $testimonio){ ?>
                    <div class="col-md-6 d-flex">
                        <div class="card mb-4 w-100">
                            <div class="card-body">
                                <p class="card-text">
                                    <?php echo $testimonio["opinion"]; ?>
                                </p>
                            </div>
                            <div class="card-footer text-muted">
                                <?php echo $testimonio["nombre"]; ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>

            </div>
        </section>

        <!--sección de la carta-->
        <section id="menu" class="container mt-4">
            <h2 class="text-center">
                Carta (nuestra recomendación)
            </h2>
            <br>
            <div class="row row-cols-1 row-cols-md-4 g-4">

                <!--carta menu 1-->
                <?php foreach($lista_menu as $registro){ ?>
                <div class="col d-flex">
                    <div class="card">
                        <img src="img/carta/<?php echo $registro["foto"]; ?>" alt="Papas fritas con queso chedar" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $registro["nombre"]; ?>
                            </h5>
                            <p class="card-text">
                                <p class="text-card small">
                                    <strong>Contiene:</strong>
                                    <?php echo $registro["ingredientes"]; ?>
                                </p>
                                <strong>$<?php echo $registro["precio"]; ?></strong>
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </section>
        <br>
        <br>

        <!--sección de contacto-->
        <section id="contacto" class="container mt-4">
            <h2>Contacto</h2>
            <p>Estamos aquí para servirte.</p>
            <form action="?" method="post">

                <div class="mb-3">
                    <label for="name">Nombre:</label><br>
                    <input type="text" class="form-control" id="name" name="nombre" placeholder="Escribe tu nombre..." require>
                </div>
                
                <div class="mb-3">
                    <label for="email">Correo electrónico:</label><br>
                    <input type="email" class="form-control" name="correo" placeholder="Escribe tu correo" require>
                </div>

                <div class="mb-3">
                    <label for="messaje">Tu mensaje:</label><br>
                    <textarea name="mensaje" class="form-control" id="mensaje" cols="50" rows="6"></textarea><br>
                </div>


                <input type="submit" class="btn btn-primary" value="Enviar mensaje">
            </form>
        </section>
        <br>
        <br>

        <!--sección de horarios esta parte no es dinámica, pero se puede modificar a futuro-->
        <div id="horarios" class="text-center bg-light p-4">
            <h3 class="mb-4 ">Horario de atención</h3>
            <div>
                <p><strong>Lunes a Viernes</strong></p> 
                <p><strong>09:00 p.m. - 02:00 a.m.</strong></p>
            </div>
        </div>
        <div class="text-center bg-light p-4">
            <div>
                <p><strong>Sábados y Domingos</strong></p> 
                <p><strong>09:00 p.m. - 04:00 a.m.</strong></p>
            </div>
        </div>

        <!--footer-->
        <footer class="bg-dark text-light text-center py-3">
            <p>&copy; 2024 La carpita SP, todos los derechos reservados.
        </footer>

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
