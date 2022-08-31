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
$ID = $_GET['idcontacto'];
$personacontacto="SELECT idcontacto,folio,nombre,apellidos,celular,lazofamiliar,direccion,cvivienda FROM personacontacto WHERE idcontacto = '$ID'";
$resultadopersonac = $conexion->query($personacontacto);
$fila= $resultadopersonac->fetch_assoc();
    ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <style>
.cuadro{
    margin-left: 10px;
}
.cuadro2{
    margin-left: 150px;
}
  </style>
  <body>
      <!-- barra de navegacion -->
      <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #63acc7;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SAPPI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <?php
        require_once("templates/navbar.php");
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
      <br>
      <section  class="cuadro" id="crearContacto">
      <div class="row">
  <div class="col-sm-10">
      <div class="card">
  <div class="card-header">
    Modificar persona de contacto
  </div>
  <div class="card-body">
  <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST"class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" value="<?php echo $fila['nombre']; ?>"required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Apellidos</label>
    <input type="text" name="apellidos" class="form-control" value="<?php echo $fila['apellidos']; ?>"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">celular</label>
    <input type="text" name="celular" class="form-control" value="<?php echo $fila['celular']; ?>"required>
  </div>
  <div class="col-md-2">
    <label class="form-label">Folio de 6 numeros</label>
    <input type="text" name="folio" class="form-control" value="<?php echo $fila['folio']; ?>"required>
</div>
  
  <div class="col-12">
    <label for="inputAddress" class="form-label">Direccion</label>
    <input type="text" name="direccion" class="form-control" value="<?php echo $fila['direccion']; ?>" required>
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Caracteristicas de la vivienda</label>
    <input type="text" name="cvivienda" class="form-control" value="<?php echo $fila['cvivienda']; ?>" required>
  </div>
  <div class="mb-3">
  <label for="formFile" class="form-label">Lazo familiar</label>
  <input class="form-control" name= "lazofamiliar" type="text" value="<?php echo $fila['lazofamiliar']; ?>" required>
</div>

  <div class="col-12">
  <input class="form-control" type="hidden" name="ID" value="<?php echo $ID; ?>">
    <button type="submit" class="btn btn-primary" name="editar">Modificar</button>
  </div>
</form>
<?php
if (isset($_POST["editar"])) {
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $celular = $_POST['celular'];
  $lazofamiliar = $_POST['lazofamiliar'];
  $direccion = $_POST['direccion'];
  $cvivienda = $_POST['cvivienda'];
  $folio = $_POST['folio'];
  $id= $_POST['ID'];

  $sqlmodificar = "UPDATE personacontacto SET nombre='$nombre',
  apellidos= '$apellidos',
  celular= '$celular',
  lazofamiliar= '$lazofamiliar',
  direccion='$direccion',
  cvivienda= '$cvivienda',
  folio= '$folio' WHERE idcontacto= '$id'";
  $modificado = $conexion->query($sqlmodificar);
  if ($modificado>0) {
    echo "<script>
  alert('Registro editado exitosamente');
  window.location='crearContacto.php';</script>";
  }else{
    echo "<script>
    alert('Error al modificar');
    window.location='crearContacto.php';</script>";
  }
}

?>
  </div>
</div>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>