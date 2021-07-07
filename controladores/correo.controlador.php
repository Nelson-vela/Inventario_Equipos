<?php 


	class ControladorCorreo{


	public static function ctrEnviarMensaje(){

		if(isset($_POST['enviarEmail'])){

			$email = $_POST['enviarEmail'];
			$nombre = $_POST['enviarNombre'];
			$titulo = $_POST['enviarTitulo'];
			$mensaje =$_POST['enviarMensaje'];

			$para = $email . ', ';
			$para .= 'nelsonvelalopez@gmail.com';

			$titulos = $titulo;

			$mensaje ='<html>
							<head>
								<title>Respuesta a su Mensaje</title>
							</head>

							<body>
								<h1>Hola '.$nombre.'</h1>
								<p>'.$mensaje.'</p>
								<hr>
								<p><b>Alexander Manuel Seijas.<br>
								Manitas Cerca de Ti<br> 
								Madrid - España<br> 
								WhatsApp: +34 611 157 306<br> 
								manitas@manitascercadeti.com</p>

								<h3><a href="http://www.manitascercadeti.com" target="blank">www.manitascercadeti.com</a></h3>

								 
								<br>

								
							</body>

					   </html>';

		   $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		   $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		   $cabeceras .= 'From: <manitas@manitascercadeti.com>' . "\r\n";

		   $envio = mail($para, $titulos, $mensaje, $cabeceras);

		   if($envio){

		   		echo'<script>

						swal({
							  title: "¡OK!",
							  text: "¡El mensaje ha sido enviado correctamente!",
							  type: "success",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
						}).then((result)=>{

									if(result.value){

										window.location = "clientes";

									}
						});


				</script>';

		   }

		}

	}



        public static function ctrEnviarCorreo(){


			if(isset($_POST['enviarEmail'])) { //solo ingreso a este bloque de código si el método con el que solicita la página es POST
			
			$nombre = $_POST['enviarNombre'];
			$mensaje2 = $_POST['enviarMensaje'];

    if (!isset($_FILES['archivo']) || !isset($_FILES['archivo']['tmp_name']) || strlen($_FILES['archivo']['tmp_name']) < 3) { //validación básica del campo "archivo adjunto"
    
    exit();
}


    
    $origenNombre = ManitasCercaDeTi; //nombre que visualiza el receptor del email como "origen" del email (es quien envía el email)
    $origenEmail = 'info@manitascercadeti.com';//email que visualiza el receptor del email como "origen" del email (es quien envía el email)
    $destinatarioEmail = $_POST['enviarEmail']; //destinatario del email, o sea, a quien le estamos enviando el email
    $archivoNombre = $_FILES['archivo']['name']; //nombre del archivo a ser enviado (sin la ruta, solo el nombre con la extensión, por ejemplo: imagen.jpg)
    $archivo = $_FILES['archivo']['tmp_name']; //ruta temporal del archivo a ser adjuntado (ubicación fisica del archivo subido en el servidor)
    $archivo = file_get_contents($archivo); //leeo del origen temporal el archivo y lo guardo como un string en la misma variable (piso la variable $archivo que antes contenía la ruta con el string del archivo)
    $archivo = chunk_split(base64_encode($archivo)); //codifico el string leido del archivo en base64 y la fragmento segun RFC 2045
    $uid = md5(uniqid(time())); //frabrico un ID único que usaré para el "boundary"
    
    $asuntoEmail = $_POST['enviarTitulo']; //asunto del email
    
    //cuerpo del email:
    	$cuerpoMensaje ='Hola '.$nombre.'
						'.$mensaje2.'
						Alexander Manuel Seijas
						Manitas Cerca de Ti 
						Madrid - España 
						WhatsApp: +34 611 157 306 
						info@manitascercadeti.com
						https://www.manitascercadeti.com';
						
    //fin cuerpo del email.
    
    //cabecera del email (forma correcta de codificarla)
    $header = "From: " . $origenNombre . " <" . $origenEmail . ">\r\n";
    $header .= "Reply-To: " . $origenEmail . "\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
    //armado del mensaje y attachment
    $mensaje = "--" . $uid . "\r\n";
    $mensaje .= "Content-type:text/plain; charset=utf-8\r\n";
    $mensaje .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $mensaje .= $cuerpoMensaje . "\r\n\r\n";
    $mensaje .= "--" . $uid . "\r\n";
    $mensaje .= "Content-Type: application/octet-stream; name=\"" . $archivoNombre . "\"\r\n";
    $mensaje .= "Content-Transfer-Encoding: base64\r\n";
    $mensaje .= "Content-Disposition: attachment; filename=\"" . $archivoNombre . "\"\r\n\r\n";
    $mensaje .= $archivo . "\r\n\r\n";
    $mensaje .= "--" . $uid . "--";
    //envio el email y verifico la respuesta de la función "email" (true o false)
    if (mail($destinatarioEmail, $asuntoEmail, $mensaje, $header)) {

    	echo'<script>

				swal({
					title: "¡OK!",
					text: "¡El correo ha sido enviado correctamente!",
					type: "success",
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then((result)=>{

									if(result.value){

										window.location = "clientes";

									}
						});


						</script>';

    } else {

    	echo'<script>

				swal({
					title: "ERROR!",
					text: "¡Hubo un problema al enviar el correo!",
					type: "error",
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
					}).then((result)=>{

									if(result.value){

										window.location = "clientes";

									}
						});


						</script>';
    }

    exit();
}



}



	}



 ?>