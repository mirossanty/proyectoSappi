<?php
include('conexion/conexion.php');
session_start();
if(!isset($_SESSION['id_usuario'])){
header("Location:login.php");
    }
//mostrar informacion de usuario logueado
$iduser=$_SESSION['id_usuario'];
$sql="SELECT usuario.idusuario,persona.nombre FROM usuario AS usuario INNER JOIN persona AS persona ON usuario.idpersona = persona.idpersona WHERE usuario.idusuario='$iduser'";
$resultado=$conexion->query($sql);
$row=$resultado->fetch_assoc();

$sql="SELECT idtipousuario,tipousuario FROM tipo_usuario";
$resultado=$conexion->query($sql);
if(!empty($_POST)){
    $folio = mysqli_real_escape_string($conexion,$_POST['folio']);
    $nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
    $apellido = mysqli_real_escape_string($conexion,$_POST['apellido']);
    $fechanac = mysqli_real_escape_string($conexion,$_POST['fechanac']);
    $telcasa = mysqli_real_escape_string($conexion,$_POST['telcasa']);
    $celular = mysqli_real_escape_string($conexion,$_POST['celular']);
    $foto = mysqli_real_escape_string($conexion,$_POST['foto']);
    $direccion = mysqli_real_escape_string($conexion,$_POST['direccion']);
    $cvivienda = mysqli_real_escape_string($conexion,$_POST['cvivienda']);

    $usuario = mysqli_real_escape_string($conexion,$_POST['usuario']);
    $tipousuario =$_POST['tipo_usuario'];
    $contrasena = mysqli_real_escape_string($conexion,$_POST['contrasena']);
    $contrasena_encriptada=sha1($contrasena);

    $sqlusuario= "SELECT idusuario FROM usuario WHERE nombreusuario='$usuario'";
    $resultadousuario = $conexion->query($sqlusuario);
    $filas = $resultadousuario->num_rows;
    if ($filas>0) {
echo "<script>
alert('El usuario ya existe');
window.location='registro.php';</script>";
    }else{
        $sqlpersona = "INSERT INTO persona(folio,nombre,apellido,fechanac,telcasa,celular,foto,direccion,cvivienda)VALUES('$folio','$nombre','$apellido','$fechanac','$telcasa','$celular','$foto','$direccion','$cvivienda')";
        $resultadopersona = $conexion->query($sqlpersona);
        $idpersona=$conexion->insert_id;

        $sqlusuario = "INSERT INTO usuario(nombreusuario,contrasena,idpersona,idtipousuario) VALUES ('$usuario','$contrasena_encriptada','$idpersona','$tipousuario')";
         $resultadouser=$conexion->query($sqlusuario);
        if ($resultadouser>0) {
            echo "<script>
alert('Registro exitoso');
window.location='crearAdmin.php';</script>";
        }else{
            echo "<script>
alert('Error al registrarse');
window.location='crearAdmin.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Santiago Luis Miroslava">
  <title>SAPPI</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <!-- hoja personalizada -->
   <link rel="stylesheet" href="css/admin.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #63acc7;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SAPPI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <?php
        require_once("templates/navbar.php"); ?>
        <?php
if ($_SESSION['tipo_usuario']==1) {
        ?>
    <li class="nav-item dropdown">
       <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Más opciones
       </a>
       <ul class="dropdown-menu dropdown-menu-dark">
         <li><a class="dropdown-item" href="verUsuarios.php">Lista de usuarios registrados</a></li>
         <!-- <li><a class="dropdown-item" href="#">Agregar administrador</a></li> -->
       </ul>
    </li>
    <?php
    }
    ?>
      </ul>
    </div>
    <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    <?php
    echo utf8_decode($row['nombre']);
    ?>
  </a>

  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
    <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar sesión</a></li>
  </ul>
</div>
  </div>
</nav>
<br>
<br>


<div class="card ">
  <div class="card-body col-sm-10">
   

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <!-- <div class="card-header">
          <h3 class="card-title">Title</h3>
        </div> -->
        <div class="card-body">
        <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de usuario</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
        <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST"class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="inputEmail4"required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Apellidos</label>
    <input type="text" name="apellido" class="form-control" id="inputPassword4"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">Fecha de nacimiento</label>
    <input type="date" name="fechanac" class="form-control" id="inputPassword4"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">Telefono de casa</label>
    <input type="text" name="telcasa" class="form-control" id="inputPassword4"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">celular</label>
    <input type="text" name="celular" class="form-control" id="inputPassword4"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">Crear folio de 6 numeros</label>
    <input type="text" name="folio" class="form-control" id="inputPassword4" required>
</div>
  
  <div class="col-6">
    <label for="inputAddress" class="form-label">Direccion</label>
    <input type="text" name="direccion" class="form-control" id="inputAddress" placeholder="1234 Main St"required>
  </div>
  <div class="col-6">
    <label for="inputAddress2" class="form-label">Caracteristicas de la vivienda</label>
    <input type="text" name="cvivienda" class="form-control" id="inputAddress2" placeholder=""required>
  </div>
  <div class="mb-3">
  <label for="formFile" class="form-label">Seleccionar fotografia</label>
  <input class="form-control" name= "foto"type="file" id="formFile"required>
</div>
<div class="col-md-2">
    <label class="form-label">Crear usuario</label>
    <input type="text" name="usuario" class="form-control" id="inputPassword4"required>
</div>
<div class="col-md-2">
    <label class="form-label">Crear contraseña </label>
    <input type="password" name="contrasena" class="form-control" id="inputPassword4"required>
</div>

<div class="col-md-2">

         <label for="TipoUser">Tipo de Usuario</label>
               <select class="form-control"id="TipoUser"name="tipo_usuario">
              
              <?php
              while ($fila=$resultado->fetch_assoc()) {?> 
  <option value="<?php echo $fila['idtipousuario'] ?>"><?php echo $fila['tipousuario']  ?></option>
                <?php
                }
             
              ?>
               </select>
               </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Registrar</button>
  </div>
</form>
  </div>
</div>    
     

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    
    </body>
  </html>