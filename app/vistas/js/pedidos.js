/*=============================================
EDITAR PEDIDO
=============================================*/
$(".tablas").on("click", ".btnEditarPedido", function(){

    var idPedido = $(this).attr("idPedido");

    var datos = new FormData();
    datos.append("idPedido", idPedido);

    $.ajax({

      url:"ajax/pedidos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
          $("#idPedido").val(respuesta["id"]);
          $("#editarIdCliente").val(respuesta["id_cliente"]);
          $("#editarMaterial").val(respuesta["material"]);
          $("#editarDetalle").val(respuesta["detalle"]);
          $("#editarCantidad").val(respuesta["cantidad"]);
          $("#editarFechaPedido").val(respuesta["fecha_pedido"]);
          $("#editarFechaEntrega").val(respuesta["fecha_entrega"]);
          $("#editarTotalPago").val(respuesta["total_pago"]);
          $("#editarFormaPago").val(respuesta["forma_pago"]);
          $("#editarEstadoPago").val(respuesta["estado_pago"]);
          $("#editarEstadoPedido").val(respuesta["estado_pedido"]);
      }

    })

})

/*=============================================
ELIMINAR PEDIDO
=============================================*/
$(".tablas").on("click", ".btnEliminarPedido", function(){

    var idPedido = $(this).attr("idPedido");
    
    swal({
        title: '¿Está seguro de borrar el pedido?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar pedido!'
      }).then(function(result){
        if (result.value) {
            window.location = "index.php?ruta=pedidos&idPedido="+idPedido;
        }
    })

})

/*=============================================
BUSCAR / FILTRAR PEDIDOS
=============================================*/
$("#formBuscarPedidos").on("submit", function(e){
    e.preventDefault();

    var datos = new FormData(this);

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

            $(".tablas").DataTable().clear().draw();

            respuesta.forEach(function(pedido, index){
                $(".tablas").DataTable().row.add([
                    index+1,
                    pedido["nombre"], 
                    pedido["material"], 
                    pedido["detalle"], 
                    pedido["cantidad"], 
                    pedido["fecha_pedido"], 
                    pedido["fecha_entrega"], 
                    pedido["total_pago"], 
                    pedido["forma_pago"], 
                    pedido["estado_pago"], 
                    pedido["estado_pedido"],
                    '<div class="btn-group">'+
                        '<button class="btn btn-warning btnEditarPedido" idPedido="'+pedido["id"]+'" data-toggle="modal" data-target="#modalEditarPedido"><i class="fa fa-pencil"></i></button>'+
                        '<button class="btn btn-danger btnEliminarPedido" idPedido="'+pedido["id"]+'"><i class="fa fa-times"></i></button>'+
                    '</div>'
                ]).draw(false);
            });
        }
    });
});