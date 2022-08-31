<?php
include("conexion/conexion.php");
session_start();
if(!isset($_SESSION['id_usuario'])){
header("Location:login.php");
}
//mostrar informacion de usuario logueado
$iduser=$_SESSION['id_usuario'];
$sql="SELECT usuario.idusuario,persona.nombre FROM usuario AS usuario INNER JOIN persona AS persona ON usuario.idpersona = persona.idpersona WHERE usuario.idusuario='$iduser'";
$resultado=$conexion->query($sql);
$row=$resultado->fetch_assoc();

$sql2="SELECT usuario.idusuario,usuario.contrasena,usuario.nombreusuario,persona.folio,persona.nombre,persona.apellido,persona.fechanac,persona.telcasa,persona.celular,persona.foto,persona.direccion,persona.cvivienda FROM usuario AS usuario INNER JOIN persona AS persona ON usuario.idpersona =persona.idpersona WHERE usuario.idusuario='$iduser'";
$resultado=$conexion->query($sql2);
$row=$resultado->fetch_assoc();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <style>
.cuadro2{
    margin-left: 200px;
}
  </style>
  <body>
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
       <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         Más opciones
       </a>
       <ul class="dropdown-menu dropdown-menu-dark">
         <li><a class="dropdown-item" href="verUsuarios.php">Lista de usuarios registrados</a></li>
         <li><a class="dropdown-item" href="crearAdmin.php">Agregar administrador</a></li>
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
    <li><a class="dropdown-item" href="#">Perfil</a></li>
    <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar sesión</a></li>
  </ul>
</div>
  </div>
</nav>
      <br>
      <br>
      <br>
      <section  class="cuadro2" id="crearContacto">
      <div class="row">
  <div class="col-sm-10">
      <div class="card">
  <div class="card-header">
    Perfil de usuario
  </div>
  <div class="card-body">
  <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST"class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="inputEmail4" value="<?php 
    echo $row ['nombre'];
    ?>"required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Apellidos</label>
    <input type="text" name="apellido" class="form-control" id="inputPassword4" value="<?php 
    echo $row ['apellido'];
    ?>"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">Fecha de nacimiento</label>
    <input type="date" name="fechanac" class="form-control" id="inputPassword4" value="<?php 
    echo $row ['fechanac'];
    ?>"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">Teléfono de casa</label>
    <input type="text" name="telcasa" class="form-control" id="inputPassword4" value="<?php 
    echo $row ['telcasa'];
    ?>"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">Celular</label>
    <input type="text" name="celular" class="form-control" id="inputPassword4" value="<?php 
    echo $row ['celular'];
    ?>"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">Folio de 6 números</label>
    <input type="text" name="folio" class="form-control" id="inputPassword4"  value="<?php 
    echo $row ['folio'];
    ?>" required>
</div>
  
  <div class="col-6">
    <label for="inputAddress" class="form-label">Dirección</label>
    <input type="text" name="direccion" class="form-control" id="inputAddress" placeholder="" value="<?php 
    echo $row ['direccion'];
    ?>"required>
  </div>
  <div class="col-6">
    <label for="inputAddress2" class="form-label">Características de la vivienda</label>
    <input type="text" name="cvivienda" class="form-control" id="inputAddress2" placeholder=""required value="<?php 
    echo $row ['cvivienda'];
    ?>">
  </div>
  <div class="mb-3">
  <label for="formFile" class="form-label">Fotografía</label>
  <input class="form-control" name= "foto"type="file" id="formFile"required value="<?php 
    echo $row ['foto'];
    ?>">
</div>
<div class="col-md-2">
    <label class="form-label">Usuario</label>
    <input type="text" name="nombreusuario" class="form-control" id="inputPassword4"required value="<?php 
    echo $row ['nombreusuario'];
    ?>">
</div>
<div class="col-md-6">
    <label class="form-label"> Repetir contraseña para validar</label>
    <input type="password" name="pass" class="form-control" id="inputPassword4">
</div>
  <div class="col-12">
  <input class="form-control" type="hidden" name="ID" value="<?php echo $iduser; ?>">
    <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>
  </div>
</form>
<?php
if (isset($_POST["editar"])) {
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $fechanac = $_POST['fechanac'];
  $telcasa = $_POST['telcasa'];
  $celular = $_POST['celular'];
  $foto = $_POST['foto'];
  $direccion = $_POST['direccion'];
  $cvivienda = $_POST['cvivienda'];
  $folio = $_POST['folio'];
  $nombreusuario = $_POST['nombreusuario'];
  $id= $_POST['ID'];
  if($_POST["pass"==""]) {
  $contrasena= $row['contrasena'];
  } else {
    $contrasena= sha1($_POST["pass"]);
  }
  $sqlmodificar = "UPDATE usuario as usuario INNER JOIN persona as persona ON(usuario.idpersona = persona.idpersona) SET usuario.nombreusuario = '$nombreusuario',usuario.contrasena='$contrasena',
  persona.nombre='$nombre',
  persona.apellido='$apellido',
  persona.fechanac='$fechanac',
  persona.telcasa='$telcasa',
  persona.celular='$celular',
  persona.foto='$foto',
  persona.direccion='$direccion',
  persona.cvivienda='$cvivienda',
  persona.folio='$folio'
   WHERE usuario.idusuario= '$id'";

  $modificado = $conexion->query($sqlmodificar);
  if ($modificado>0) {
    echo "<script>
  alert('Registro modificado exitosamente');
  window.location='perfil.php';</script>";
  }else{
    echo "<script>
    alert('Error al modificar');
    window.location='perfil.php';</script>";
  }
}
$conexion->close();
?>
</div>
</div>
</div>
</div>
</section>
 
      
<?php
    include_once("templates/footer.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>