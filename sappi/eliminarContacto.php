<?php
include('conexion/conexion.php');
$ID = $_GET['idcontacto'];
$eliminarpersonac= "DELETE FROM personacontacto WHERE idcontacto = '$ID'";
$resultado = $conexion->query($eliminarpersonac);
echo "<script>
  alert('Registro eliminado exitosamente');
  window.location='crearContacto.php';</script>";
  $conexion->close();
?>