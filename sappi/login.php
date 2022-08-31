<?php
include("conexion/conexion.php");
session_start();
if(isset($_SESSION['id_usuario'])){
header("Location:crearContacto.php");
}
if(!empty($_POST)){
$usuario = mysqli_real_escape_string($conexion,$_POST['usuario']);
$contrasena = mysqli_real_escape_string($conexion,$_POST['contrasena']);
$contrasena_encriptada=sha1($contrasena);
$sql= "SELECT idusuario,idtipousuario FROM usuario WHERE nombreusuario='$usuario' AND contrasena='$contrasena_encriptada'";
$resultado=$conexion->query($sql);
$fila=$resultado->num_rows;
if($fila>0){
$fila=$resultado->fetch_assoc();
$_SESSION['id_usuario']=$fila['idusuario'];
$_SESSION['tipo_usuario']=$fila['idtipousuario'];
header('Location:crearContacto.php');
}else{
echo "<script>
alert('Usuario o contraseña incorrectos');
window.location='login.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="es">
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
 
 <body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.html" class="h1"><b>SA</b>PPI</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Iniciar sesión</p>

      <form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="usuario" placeholder="Usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="contrasena" placeholder="Contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="ingresar" class="btn btn-primary btn-block" value="ingresar">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-0">
        <a href="registro.php" class="text-center">Registrarse</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php
include_once 'templates/footer.php';
?>