<?php

####
## Eliminar una imagen
####
if(isset($_GET['eliminar'])){
    $archivo = $_GET['eliminar'];
    $directorio = dirname(__FILE__);
    if(unlink($directorio.'/'.$archivo)){
        header("Location: cargarImagen.php?accion=eliminado");
        exit;
    }
    
}

##
## RECIBIR FORMULARIO
## Aqui pueden ir los campos que uno quiera
##


if(isset($_POST['submit'])){ // comprobamos que se ha enviado el formulario
    
    // comprobar que han seleccionado una foto
    if($_FILES['foto']['name'] != ""){ // El campo foto contiene una imagen...
        
        // Primero, hay que validar que se trata de un JPG/GIF/PNG
        $allowedExts = array("jpg", "jpeg", "gif", "png", "JPG", "GIF", "PNG");
        $extension = end(explode(".", $_FILES["foto"]["name"]));
        if ((($_FILES["foto"]["type"] == "image/gif")
                || ($_FILES["foto"]["type"] == "image/jpeg")
                || ($_FILES["foto"]["type"] == "image/png")
                || ($_FILES["foto"]["type"] == "image/pjpeg"))
                && in_array($extension, $allowedExts)) {
            // el archivo es un JPG/GIF/PNG, entonces...
            
            $extension = end(explode('.', $_FILES['foto']['name']));
            $foto = substr(md5(uniqid(rand())),0,10).".".$extension;
            $directorio = dirname(__FILE__); // directorio de tu elección
            
            // almacenar imagen en el servidor
            move_uploaded_file($_FILES['foto']['tmp_name'], $directorio.'/'.$foto);
            $minFoto = 'min_'.$foto;
            $resFoto = 'res_'.$foto;
            resizeImagen($directorio.'/', $foto, 400, 600,$minFoto,$extension);
            //resizeImagen($directorio.'/', $foto, 500, 500,$resFoto,$extension);
            unlink($directorio.'/'.$foto);
            
        } else { // El archivo no es JPG/GIF/PNG
            $malformato = $_FILES["foto"]["type"];
            header("Location: cargarImagen.php?error=noFormato&formato=$malformato");
            exit;
          }
        
    } else { // El campo foto NO contiene una imagen
        header("Location: cargarImagen.php?error=noImagen");
        exit;
    }
        
} // fin del submit

####
## Función para redimencionar las imágenes
## utilizando las liberías de GD de PHP
####

function resizeImagen($ruta, $nombre, $alto, $ancho,$nombreN,$extension){
    $rutaImagenOriginal = $ruta.$nombre;
    if($extension == 'GIF' || $extension == 'gif'){
    $img_original = imagecreatefromgif($rutaImagenOriginal);
    }
    if($extension == 'jpg' || $extension == 'JPG'){
    $img_original = imagecreatefromjpeg($rutaImagenOriginal);
    }
    if($extension == 'png' || $extension == 'PNG'){
    $img_original = imagecreatefrompng($rutaImagenOriginal);
    }
    $max_ancho = $ancho;
    $max_alto = $alto;
    list($ancho,$alto)=getimagesize($rutaImagenOriginal);
    $x_ratio = $max_ancho / $ancho;
    $y_ratio = $max_alto / $alto;
    if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho 
  	$ancho_final = $ancho;
		$alto_final = $alto;
	} elseif (($x_ratio * $alto) < $max_alto){
		$alto_final = ceil($x_ratio * $alto);
		$ancho_final = $max_ancho;
	} else{
		$ancho_final = ceil($y_ratio * $ancho);
		$alto_final = $max_alto;
	}
    $tmp=imagecreatetruecolor($ancho_final,$alto_final);
    imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
    imagedestroy($img_original);
    $calidad=70;
    imagejpeg($tmp,$ruta.$nombreN,$calidad);
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Cargar imagen</title>
        <meta name="author" content="Fernando Magrosoto V." />
        <meta name="history" content="01 noviembre 2012" />
        <meta name="email" content="fmagrosoto@gmail.com" />
        
        <style>
            body {
                background-color: rgb(250,250,250);
                color: rgb(50,50,50);
                font-family: sans-serif;
                font-size: 100%;
                width: 600px;
                margin: auto;
            }
            :focus {
                outline: none;
            }
            a {
                text-decoration: none;
                color: red;
            }
            a:hover {
                text-decoration: underline;
            }
            header {
                border-bottom: 1px gray dotted;
                padding-bottom: 25px;
                margin-bottom: 25px;
            }
            header h1 {
                font-size: xx-large;
                text-shadow: 1px 1px 5px gray;
            }
            header em {
                color: gray;
            }
            section form {
                font-size: small;
            }
            section form fieldset {
                padding: 10px 25px;
                background-color: white;
                border: 1px gray solid;
                border-radius: .5em;
            }
            section form fieldset legend {
                padding: 5px 10px;
                border: 1px gray solid;
                border-radius: .5em;
            }
            footer {
                border-top: 1px gray dotted;
                padding-top: 25px;
                margin-top: 25px;
                position: relative;
            }
            .msg {
                margin-bottom: 20px;
                padding: 10px;
                background-color: rgb(255,250,250);
                border: 1px red dotted;
            }
            .elimina {
                color: blue;
            }
        </style>
        
    </head>
    
    <!-- Página demostrativa que permite reducir las imágenes cargadas -->
    <!-- desde un formulario y almacenarlas en el servidor -->
    <!-- utilizando las librerías GD de PHP.  -->
    <!-- CREADO POR: Fernando Magrosoto V. -->
    <!-- HISTORIA: Noviembre 2012 -->
    <!-- CONTACTO: fmagrosoto@gmail.com -->
    <!-- DESCARGAR CÓDIGO: https://gist.github.com/4687238 -->

    <body>
        <!-- HEADER -->
        <header>
            <h1>Script para cargar y reducir imágenes para entradas a un blog</h1>
            <em>Script para subir imágenes, reducirlas, hacer versiones miniatura y
            eliminar la versión original. Validando que sean únicamente GIF, PNG y JPG.</em>
        </header>
        
        <!-- SECCION -->
        <section>
            
            <?php if(isset($_POST['submit'])) { ?>
            <div class="msg">El archivo ha sido cargado satisfactoriamente.</div>
            <?php } ?>
            
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>"
                  method="POST"
                  enctype="multipart/form-data">
                <fieldset>
                    <legend>Seleccionar una imagen</legend>
                    <div><input type="file" name="foto" /></div>
                    <div style="margin-top: 10px;"><input type="submit" name="submit" />
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Reiniciar</a></div>
                </fieldset>
            </form>
            
            <div style="margin-top: 25px; font-size: small;">
                <?php
                $path = dirname(__FILE__);
                $directorio=dir($path);
                echo "Directorio de fotos: <em>".$path.":</em><br />
                    <span style='color: rgb(150,150,150);'>// Únicamente muestra GIF, JPG y PNG.</span><br /><br />";
                
                while ($archivo = $directorio->read()) {
                    $extension = end(explode('.', $archivo));
                    if($extension == 'png'
                            || $extension == 'gif'
                            || $extension == 'jpg'){
                        echo "<a href='".$archivo."' target='_blank'>".$archivo."</a> [ <a class='elimina' href='".$_SERVER['PHP_SELF']."?eliminar=".$archivo."'>eliminar</a> ]<br>";
                    }
                }
                $directorio->close();
                ?>
            </div>
            
        </section>
        <!-- FOOTER -->
        <footer>
            <p>&copy; 2012 - Fernando Magrosoto Vásquez</p>
            <div style="position: absolute; top: 25px; right: 0;"><a href="http://www.w3.org/html/logo/">
                    <img src="http://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png"
                         width="165" height="64" alt="HTML5 Powered with CSS3 / Styling, and Semantics"
                         title="HTML5 Powered with CSS3 / Styling, and Semantics">
                </a>
            </div>
        </footer>
        
        <!-- FIN DE LA PÁGINA -->
        <!-- EOF -->
    </body>
</html>
