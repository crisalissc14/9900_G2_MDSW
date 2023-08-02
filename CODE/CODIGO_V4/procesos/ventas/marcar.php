<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Venta.php';
$obj = new Venta();
$id = $_POST['id_venta'];
echo $obj->marcar_venta($id);
?>
<div class="text-right mb-2">
    <a href="fpdf/PruebaV.php" target="_blank" class="btn btn-succes"><i class="fas fa-file-pdf"></i>Generar reporte</a> 
</div>
