<?php
include("conexion/conexion.php");
session_start();
if(!isset($_SESSION['id_usuario'])){
header("Location:login.php");
    }
$nivel=$_SESSION['tipo_usuario'];
if($nivel!="1"){
header("Location:login.php");
}
//mostrar informacion de usuario logueado
$iduser=$_SESSION['id_usuario'];
$sql="SELECT usuario.idusuario,persona.nombre FROM usuario AS usuario INNER JOIN persona AS persona ON usuario.idpersona = persona.idpersona WHERE usuario.idusuario='$iduser'";
$resultado=$conexion->query($sql);
$row=$resultado->fetch_assoc();

$personas="SELECT usuario.idusuario,usuario.nombreusuario,persona.folio,persona.nombre,persona.apellido FROM usuario AS usuario INNER JOIN persona AS persona ON usuario.idpersona = persona.idpersona";
$resultadopersona = $conexion->query($personas);
    ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de usuarios</title>
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
    <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
    <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar sesión</a></li>
  </ul>
</div>
  </div>
</nav>
      <br>
      <br>
      <br>
     
      <!-- tabla personas de cintacto -->
      <section  class="cuadro2" id="personasContacto">
      <div class="row">
  <div class="col-sm-10">
      <div class="card">
  <div class="card-header">
   Usuarios registrados
  </div>
  <div class="card-body">
  <table id="example" class="table table-striped" style="width:100%">
  <thead>
    <tr>
    <th scope="col">#Folio</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Usuario</th>
      <!-- <th scope="col"></th>
      <th scope="col"></th> -->
    </tr>
  </thead>
  <tbody>
  <?php
       while ($regpersona=$resultadopersona->fetch_array(MYSQLI_BOTH)) {
        echo "<tr>
        <td>".$regpersona['folio']."</td>
        <td>".$regpersona['nombre']."</td>
        <td>".$regpersona['apellido']."</td>
        <td>".$regpersona['nombreusuario']."</td>  ";
       }
      ?> 
    <!-- <td><a class='btn btn-warning' href='#?id=".$regpersona['idusuario']."' role='button'>Editar</a></td>
        <td><a class='btn btn-danger' href='#?id=".$regpersona['idusuario']."' role='button'>Eliminar</a></td>
        </tr> -->
  </tbody>
</table>
</div>
</div>
</div>
</div>

      </section>
     
<script src="js/jquery-3.5.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
