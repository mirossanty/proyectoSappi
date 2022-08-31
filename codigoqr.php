<!doctype html>
<html lang="en">

<head>
	<title>Generar código QR</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">

	<script type="javascript" src="js/jspdf.es.min.js"></script>

</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Formulario</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrapper">

						<div class="row">
							<div class="col-md-3">
		<div id="qrcode" class="mt-5 text-center">

		</div>
	</div>
	<div class="col-md-9">
		<div class="row no-gutters">
			<div class="col-lg-12 col-md-12 order-md-last d-flex align-items-stretch">
				<div class="contact-wrap w-100 p-md-5 p-4">
					<h3 class="mb-4">Generador de código QR</h3>
					<div id="form-message-warning" class="mb-4"></div>
					<div id="form-message-success" class="mb-4">
Your message was sent, thank you!
											</div>
<form method="POST" id="contactForm" name="contactForm" class="contactForm">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="label" for="name">Nombre</label>
				<input type="text" class="form-control" name="nombre"
					id="nombre" placeholder="Nombre" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="label" for="email">Apellidos</label>
				<input type="text" class="form-control" name="apellidos"
					id="apellidos" placeholder="Apellidos" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="label">Fecha de nacimiento</label>
				<input type="date" class="form-control" name="fechaNac"
					id="fechaNac" placeholder="fecha de nacimiento" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="label" for="email">Teléfono de casa</label>
				<input type="text" class="form-control" name="telCasa"
					id="telCasa" placeholder="Teléfono de casa" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="label" for="email">Celular</label>
				<input type="text" class="form-control" name="celular"
					id="celular" placeholder="Celular" required>
			</div>
		</div>
		<!-- <div class="col-md-6">
			<div class="form-group">
				<label class="label" for="email">Usuario</label>
				<input type="text" class="form-control" name="usuario"
					id="usuario" placeholder="usuario" required>
			</div>
		</div> -->
		<!-- <div class="col-md-6">
			<div class="form-group">
				<label class="label" for="email">Contraseña</label>
				<input type="password" class="form-control" name="contrasena"
					id="contrasena" placeholder="contraseña" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="label" for="email">Fotografía</label>
				<input type="file" class="form-control" name="foto"
					id="foto" placeholder="Fotografía" required>
			</div>
		</div> -->
		<div class="col-md-12">
			<div class="form-group">
				<label class="label" for="subject">Dirección o domicilio</label>
				<input type="text" class="form-control" name="direccion"
					id="direccion" placeholder="Dirección o domicilio" required>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="label" for="#">Características de la vivienda</label>
				<textarea name="cVivienda" class="form-control" id="cVivienda"
					cols="30" rows="4" placeholder="Características de la vivienda" required></textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<input type="submit" value="Generar código"
					class="btn btn-primary" onclick="generateqr()">
				<div class="submitting"></div>
			</div>
		</div>
		<a href="javascript:genPDF()">Imprimir</a>
	</div>
				</form>
			</div>
		</div>
		
	</div>
	<div class="text pl-3">
		<p><span</span> <a href="">Formulario</a><br><a href="index.html">VOLVER A INICIO</a></p>
	</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		</div>

		</div>
		</div>
		</div>
	</section>

	<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/main.js"></script>

	<script>
function genPDF(){
	var doc = new jsPDF();
	doc.text(20,20,generateqr(),'Mensaje de prueba 1');
	doc.save('prueba.pdf');
}
		function generateqr() {
			var nombre = document.getElementById('nombre').value;
			var apellidos = document.getElementById('apellidos').value;
			var fechaNac = document.getElementById('fechaNac').value;
			var telCasa = document.getElementById('telCasa').value;
			var celular = document.getElementById('celular').value;
			// var foto = document.getElementById('foto').value;
			var direccion = document.getElementById('direccion').value;
			var cVivienda = document.getElementById('cVivienda').value;

			console.log('Name: ' + nombre + " " + apellidos + " " + fechaNac + " " + telCasa+ " " + celular+ " " + direccion+ " " + cVivienda);

			var url = "https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=Nombre:" +
			nombre + "%0aApellidos: " + apellidos + "%0aFecha de Nacimiento: " + fechaNac + "%0aTel.Casa: " + telCasa + "%0aCelular: " + celular+ "%0aDirección: " + direccion+ "%0aCaract.Vivienda: " + cVivienda;
			// + "%0aFoto: " + foto
			var ifr = `<iframe src="${url}" height="200" width="200"></iframe>`;

			document.getElementById('qrcode').innerHTML = ifr;
		}
		
	</script>

</body>

</html>