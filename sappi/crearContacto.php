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
if(!empty($_POST)){
    $folio = mysqli_real_escape_string($conexion,$_POST['folio']);
    $nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conexion,$_POST['apellidos']);
    $celular = mysqli_real_escape_string($conexion,$_POST['celular']);
    $lazofamiliar = mysqli_real_escape_string($conexion,$_POST['lazofamiliar']);
    $direccion = mysqli_real_escape_string($conexion,$_POST['direccion']);
    $cvivienda = mysqli_real_escape_string($conexion,$_POST['cvivienda']);
    $verpersona= "SELECT idcontacto,folio,nombre,apellidos,celular,lazofamiliar,direccion,cvivienda FROM personacontacto WHERE folio = '$folio' AND idpersona='$iduser'";
    $existepersona = $conexion->query($verpersona);
    $filas = $existepersona->num_rows;
    if($filas>0){
      echo "<script>
      alert('La persona de contacto ya existe');
      window.location='crearContacto.php';</script>";
    }else{
      $sqlpersona = "INSERT INTO personacontacto(folio,nombre,apellidos,celular,lazofamiliar,direccion,cvivienda,idpersona) VALUES('$folio','$nombre','$apellidos','$celular','$lazofamiliar','$direccion','$cvivienda','$iduser')";
      
      $resultadopersona = $conexion->query($sqlpersona);
      if($resultadopersona>0){
        echo "<script>
        alert('Registro exitoso');
        window.location='crearContacto.php';</script>";
      }else{
        echo "<script>
        alert('Error al registrar');
        window.location='crearContacto.php';</script>";
      }
    }
    }
    $personacontacto="SELECT usuario.idusuario, personacontacto.idcontacto,personacontacto.folio,personacontacto.nombre,personacontacto.apellidos,personacontacto.celular,personacontacto.lazofamiliar,personacontacto.direccion,personacontacto.cvivienda FROM usuario AS usuario INNER JOIN personacontacto AS personacontacto ON usuario.idusuario = personacontacto.idpersona WHERE usuario.idusuario= '$iduser'";
$resultadopersonac = $conexion->query($personacontacto);
    ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet"href="css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet"href="css/bootstrap.min.css">
    <script src="js/jquery-3.5.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
  </script>
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
   Bienvenido al sistema de registro de SAPPI, por favor rellene el siguiente formulario para registrar a la personas(as) de contacto asignada.
  </div>
  <div class="card-body">
  <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST"class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label class="form-label">Apellidos</label>
                <input type="text" name="apellidos" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-2">
                <label class="form-label">celular</label>
                <input type="text" name="celular" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-2">
                <label class="form-label">lazo familiar</label>
                <input type="text" name="lazofamiliar" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-2">
                <label class="form-label">Folio de 6 numeros</label>
                <input type="text" name="folio" class="form-control" id="inputPassword4">
        </div>
        
            <div class="col-12">
                <label for="inputAddress" class="form-label">Direccion</label>
                <input type="text" name="direccion" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Caracteristicas de la vivienda</label>
                <input type="text" name="cvivienda" class="form-control" id="inputAddress2" placeholder="">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
    </form>
  </div>
</div>
</div>
</div>
<br>
      <br>
      <br>

      </section>
      <!-- tabla personas de cintacto -->
      <section  class="cuadro2" id="personasContacto">
      <div class="row">
  <div class="col-sm-10">
      <div class="card">
  <div class="card-header">
    En esta tabla podrá filtrar las personas de contacto registradas.
  </div>
  <div class="card-body">
  <table id="example" class="table table-striped" style="width:100%">
  <thead>
    <tr>
    <th scope="col">#Folio</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Celular</th>
      <th scope="col">Lazo familiar</th>
      <th scope="col">Direccion</th>
      <th scope="col">Caract.Vivienda</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php
      while ($regpersonacontacto=$resultadopersonac->fetch_array(MYSQLI_BOTH)) {
       echo "<tr>
       <td>".$regpersonacontacto['folio']."</td>
       <td>".$regpersonacontacto['nombre']."</td>
       <td>".$regpersonacontacto['apellidos']."</td>
       <td>".$regpersonacontacto['celular']."</td>
       <td>".$regpersonacontacto['lazofamiliar']."</td>
       <td>".$regpersonacontacto['direccion']."</td>
       <td>".$regpersonacontacto['cvivienda']."</td>
       <td><a class='btn btn-warning' href='editarContacto.php?idcontacto=".$regpersonacontacto['idcontacto']."' role='button'>Editar</a></td>
      <td><a class='btn btn-danger' href='eliminarContacto.php?idcontacto=".$regpersonacontacto['idcontacto']."' role='button'>Eliminar</a></td>
       </tr>";
      }
      ?> 
   
  </tbody>
</table>
</div>
</div>
</div>
</div>

      </section>
      <?php
    include_once("templates/footer.php");
    ?>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    
  </body>
</html>