    
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>P-DIRA</title> <!-- Titulo de la página  -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> <!-- Estilo de Bootstrap  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> <!-- Query de javascript  -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> <!-- Estilo de Bootstrap  -->
<style> 
	

	#fondoindex{  /*Estilo fondo de index.php, se determina el margen de la pantalla asi como el fondo*/
		margin: 20;
		padding: 0;
		padding-top: 40px;
		background-size: cover;
		background-image: url(fondoindex.jpg);
	}
	#fondologin{ /*Estilo fondo de login.php, se determina el margen de la pantalla asi como el fondo*/

		margin: 20;
		padding: 0;
		padding-top: 100px;
		background-size: cover;
		background-image: url(ImagesCSS/fondoindex.jpg);
	}
	#fondorepositorio{ /*Estilo fondo de repositorio.php, se determina el margen de la pantalla asi como el fondo*/

		margin: 5;
		padding: 0;
		padding-top: 10px;
		background-size: cover;
		background-image: url(ImagesCSS/fondoindex.jpg);
	}
	#fondonuevorepositorio{ /*Estilo fondo de nuevorepositorio.php, se determina el margen de la pantalla asi como el fondo*/

		margin: 20;
		padding: 0;
		padding-top: 30px;
		background-size: cover;
		background-image: url(ImagesCSS/fondoindex.jpg);
	}

	.containerinicio{ /*Contenedor de index.php, se determina el espacio del contorno*/
		
		padding-top: :100px;
		padding-left: 620px;
		padding-right: 620px;
	}

	.containerLogininicio{/*Contenedor de login.php, se determina el espacio del contorno*/
		
		padding-top: :100px;
		padding-left: 450px;
		padding-right: 450px;
	}
	.containerLogininicio2{ /*Contenedor de login.php, se determina el espacio del contenedor de los botones de iniciar sesion y registrarse*/
		
		padding-top: :100px;
		padding-left: 120px;
		padding-right: 120px;
	}
	.containerRepositorio1{ /*Contenedor de repositorio.php, se determina el espacio del contenedor*/
		
		padding-top: 20px;
		padding-left: 40px;

		
	}

	.containerRepositorioNuevo{ /*Contenedor de nuevorepositorio.php, se determina el espacio del formulario*/
		
		padding-top: 20px;
		padding-left: 250px;
		padding-right: 250px;

		
	}
	.containerRepositorioNuevo2{/*Contenedor de nuevorepositorio.php, se determina el espacio de los botones*/
		
		padding-top: :100px;
		padding-left: 250px;
		padding-right: 250px;
	}
	.usuarioLogin{/*Se establece el color del texto de login, el cual va a estar sombreados y en negrita*/
		
		color: black; text-shadow: black 0.05em 0.1em 0.1em

	}
	.alert-error{  /*Se establece que el mensaje de error para la pantalla de login, se establece el fondo, estilo de letra y tamaño*/
		
		background-color:rgba(202, 29, 20, 0.4);
		font-weight: bold;
		font-style: italic;
		width:240px; 
		
	}
	.alert-error2{   /*Se establece que el mensaje de error para la pantalla de nuevo repositorio, registrarse, se establece el fondo, estilo de letra y tamaño*/
		
		background-color:rgba(202, 29, 20, 0.4);
		font-weight: bold;
		font-style: italic;
		width:350px; 
	}
	.texto{ /*Se establece que el texto de logincon su color, posición y estilo de letra*/

		padding-left: 170px;
		padding-right: 170px;

		color: #000;
		position:relative;
		font-family:"Comic Sans MS";


	}
	.opacity{ /*Se establece que un fondo transpaente para el texto informativo de login*/
		
		background-color:rgb(2,0,0);
		opacity: 0.1;  
		width:1220px;
		height:500px;
		position: absolute;
		top:1px;
		left: 70px
	}


	.col-sm-1{ 		/*Tamaño de la primera columna del repositorio*/

		background-color:rgba(155, 152, 152, 0.5);
		height:180px;
		width:190px;
		left: 50px;


	}
	.col-sm-9{/*Tamaño de las siguientes 9 columnas del repositorio, que se muestra como tabla*/

		
		left: 60px;
		
		
	}
	.form-group{/*Color del texto del formulario registrar, nuevo oa*/

		
		color: black; text-shadow: black 0.05em 0.1em 0.1em
	}
	table, tr, td {/*Bordes de la tabla de repositorio*/
		
		border: solid black 2px;
	}
	body{/*Color del cuerpo de una pestaña web*/
		
		background-color: #B1B4B6; 
	}
	#imagen{/*Alineación de la imagen con el logo de la EPN*/
		
		text-align: center;
	}
	#estirada{/*Tamaño de la imagen del logo de la EPN*/
		
		width: 280px;
	}

	.text-center{/*Texto de alineación centrado*/
		
		color:#000040 ;
		text-shadow: 0.05em 0.05em 0.2em black
	}
	td{/*Texto de la tabla centrado*/

		text-align: center;
	}
</style>

