<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{



?>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel" style="color:white"><span class="fa fa-file"></span> Detalle de Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="fgenerarecibo">
                <div class="card mb-3">
                                <div class="card-header">
                                    <div class="row">
                                    <div class="col-lg-6"><h5>Detalle de Venta <label id="txtidcontr"></label></h5></div>
                                    
                                    </div>
                                </div>

                                <div class="card-body">

                                    <form>
                                        <div class="form-group">
                                        <div class="row">
                                         <div class="col-lg-6">
                                          <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">Categoria</span>
                                            </div>
                                            <input id="txtcliente" name="txtcliente" type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                                          </div>
                                        </div>
                                            <div class="col-lg-6">
                                              <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon1">Fecha</span>
                                                </div>
                                                <input id="txtfecha" name="txtfecha" type="text" class="form-control"  aria-describedby="basic-addon1">
                                              </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                         <div class="col-lg-6">
                                          <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="basic-addon1">Tipo</span>
                                            </div>
                                            <input id="txttipo" name="txttipo" type="text" class="form-control"  aria-label="Username" aria-describedby="basic-addon1">
                                          </div>
                                        </div>
                                            <div class="col-lg-6">
                                              <div class="input-group input-group-sm mb-3">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text" id="basic-addon1">Numero</span>
                                                </div>
                                                <input id="txtnumero" name="txtnumero" type="text" class="form-control"  aria-describedby="basic-addon1">
                                              </div>                                          
                                            </div>

                                          </div>
                                          
                                          
                                        </div>
                                        <div class="bordde">
                                        <div id="tablaaa"></div>
                                        <div class="col-lg-12"><h4 style="text-align:right">TOTAL S/.
                                        <label  id="txttotal" name="txttotal"></label></h4></div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
</div>
    
    


    <div class="content-page">
	
    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
                
                    <div class="row">
                                <div class="col-xl-12">
                                        <div class="breadcrumb-holder">
                                                <h1 class="main-title float-left">Ventas</h1>
                                                <div class="clearfix">
                                                
                                                </div>
                                        </div>
                                </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                       <!-- Button trigger modal -->

                       
            <?php
        require_once '../clases/Conexion.php';
        require_once '../clases/Venta.php';
        $obj = new Venta();
        $result = $obj->mostrar();
        
        ?>
                                                                                            
                        <div class="col-lg-12">
<table id="dtventas" class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Categoria</td>
                            <td>Fecha</td>
                            <td>Tipo</td>
                            <td>Numero</td>
                            <td>Total</td>

                            <!--<td>Fecha Sepelio</td>-->
                            <td style="width:15px"></td>
                            <td style="width:15px"></td>
                        </tr>
                    </thead>
                    <tbody>

<?php

	while($fila=mysqli_fetch_row($result))
	{
 ?>
    <tr>
		<td><?php echo $fila[0] ?></td>
		<td><?php echo $fila[2] ?></td>
		<td><?php echo $fila[1] ?></td>
		<td><?php echo $fila[5] ?></td>
		<td><?php echo $fila[6] ?></td>
		<td><?php echo $fila[4] ?></td>

        <td>

                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="functions('<?php echo $fila[0] ?>')">
                        <span class="fa fa-credit-card" role="button" data-toggle="tooltip" data-placement="top" title="Generar Recibo"></span> Ver Detalles
                    </a>
              
            
        </td>
        <td>

                    <a href="#" class="btn btn-success"  onclick="marcar('<?php echo $fila[0] ?>')">
                        <span class="fa fa-check-circle" role="button" data-toggle="tooltip" data-placement="top" title="Marcar Venta"></span> 
                        Marcar como leida
                    </a>
              
            
        </td>
	</tr>
	<?php
} ?>

                    </tbody>
</table>
                        </div>
                        
                    </div>



        </div>
        <!-- END container-fluid -->

    </div>
    <!-- END content -->

</div>
<!-- END content-page -->



<?php
require 'footer.php';
}
else {
	header("location:../index.php");  
}

?>


<script>
    

    
    
    function functions(id){
      agregadatosventa(id);
      mostrardetalle(id)
    }
    
    function mostrardetalle(id){
        $.ajax({
        type:"POST",
        data:"id_venta=" + id,
        url:"../procesos/ventas/mostrar_porid.php",
        success:function(r){
            var dato=JSON.parse(r);
            $('#txtcliente').val(dato['cliente']);
            $('#txttotal').html(dato['total']);
            $('#txttipo').val(dato['tipo']);
            $('#txtnumero').val(dato['numero']);
            $('#txtfecha').val(dato['fecha']);
        }
      });
    }    

    function agregadatosventa(id){
        $.ajax({
        type:"POST",
        data:"id_venta=" + id,
        url:"../procesos/ventas/traer_detalles.php",
        success:function(r){
            $('#tablaaa').html(r);
        }
      });
    
    }
    function marcar(id)
    {
                    alertify.confirm('Venta', '¿Esta seguro que desea marcar esta venta?', function()
                {
                        $.ajax({
                                type:"POST",
                                url : "../procesos/ventas/marcar.php",
                                data : "id_venta="+id
                            }).done(function(msg) {
                                alertify.success("Venta Marcada Correctamente");
                                location.reload();
                            });
                }
                , function(){
                
                });
    }


  
</script>

<div class="text-right mb-2">
    <a href="fpdf/PruebaV.php" target="_blank" class="btn btn-succes"><i class="fas fa-file-pdf"></i>Generar reporte</a> 
</div>

