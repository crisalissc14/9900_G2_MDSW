<?php
require 'header.php';

if(isset($_SESSION['usuario']))
{

?>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmproductoe">
          <div class="row">
            <label>Stock (*)</label>
            <input type="number" class="form-control" id="txtstock" name="txtstock" onkeydown="return event.keyCode !== 69 && event.keyCode !== 190" step="1">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btneditar" class="btn btn-primary">Guardar</button>
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
            <h1 class="main-title float-left">Productos con stock bajo</h1>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <!-- end row -->
      <div class="row">
        <!-- Button trigger modal -->
        <div class="col-lg-12">
          <table id="myTable" class="table">
            <thead>
              <tr>
                <td>#</td>
                <td>Nombre</td>
                <td>Precio Compra</td>
                <td>Precio Venta</td>
                <td>Stock</td>
                <td>Proveedor</td>
                <td>Categoria</td>
                <td></td>
              </tr>
            </thead>
            <tbody></tbody>
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
$(document).ready(function(){
  $('#js-example-basic-single').select2();

  var table = $('#myTable').DataTable({
    "ajax":{
      "url":"../procesos/productos/mostrar_stock.php",
      "type":"GET"
    },
    "columns":[
      {"data":"id_producto"},
      {"data":"nombre"},
      {"data":"precio_compra"},
      {"data":"precio_venta"},
      {"data":"stock"},
      {"data":"id_proveedor"},
      {"data":"id_categoria"},
      {
        sTitle: "Añadir",
        mDataProp: "id_producto",
        sWidth: '7%',
        orderable: false,
        render: function(data) {
          acciones = `<button id="` + data + `" value="Traer" class="fa fa-plus-circle btn btn-primary accionesTabla" data-toggle="modal" data-target="#exampleModal2" type="button"></button>`;
          return acciones;
        }
      }
    ],
    responsive:true,
    "ordering": false
  });

  $(document).on('click', '.accionesTabla', function() {
    var id = this.id;
    var val = this.value;

    switch (val) {
      case "Traer":
        $('#btneditar').unbind().click(function(){
          var vacios = validarFormVacio('frmproductoe');

          if(vacios <= 0) {
            var noma = $("#txtstock").val();
            if (Number.isInteger(parseFloat(noma))) {
              var oka = {
                "txtstock" : noma , "id_producto" : id
              };

              $.ajax({
                method : "POST",
                url : "../procesos/productos/stock.php",
                data : oka
              }).done(function(msg) {
                if (msg == 1) {
                  alertify.success("Stock Agregado Correctamente!");
                  table.ajax.reload();
                } else if (msg == "n") {
                  alertify.error("Ingrese un número válido");
                } else {
                  alertify.error("No se pudo añadir");
                }
              });
            } else {
              alertify.error("Ingrese un número entero válido");
            }
          } else {
            alertify.error("Complete los datos");
          }
        });
        break;
    }
  });
});
</script>



