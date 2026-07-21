<?php

class ControladorPedidos{

    /*=============================================
    MOSTRAR PEDIDOS
    =============================================*/
    static public function ctrMostrarPedidos($item, $valor){

        $tabla = "pedidos";
        $respuesta = ModeloPedidos::mdlMostrarPedidos($tabla, $item, $valor);

        return $respuesta;
    }
    
    /*=============================================
    CREAR PEDIDO
    =============================================*/
    static public function ctrCrearPedido(){

        if(isset($_POST["nuevoIdCliente"])){

            // Validaciones básicas
            if(preg_match('/^[0-9]+$/', $_POST["nuevoIdCliente"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\.\,\- ]+$/', $_POST["nuevoMaterial"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\.\,\- ]+$/', $_POST["nuevoDetalle"]) &&
               preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $_POST["nuevaCantidad"]) &&
               preg_match('/^[0-9\-: ]+$/', $_POST["nuevaFechaEntrega"]) &&
               preg_match('/^[0-9.]+$/', $_POST["nuevoTotalPago"]) &&
               preg_match('/^(transferencia|efectivo)$/', $_POST["nuevaFormaPago"]) &&
               preg_match('/^(completo|parcial|pendiente)$/', $_POST["nuevoEstadoPago"]) &&
               preg_match('/^(proceso|entregado|cancelado|devolucion)$/', $_POST["nuevoEstadoPedido"])){

                $tabla = "pedidos";

                $datos = array(
                    "id_cliente"   => $_POST["nuevoIdCliente"],
                    "material"     => $_POST["nuevoMaterial"],
                    "detalle"      => $_POST["nuevoDetalle"],
                    "cantidad"     => $_POST["nuevaCantidad"],
                    "fecha_pedido" => $_POST["nuevaFechaPedido"],
                    "fecha_entrega"=> $_POST["nuevaFechaEntrega"],
                    "total_pago"   => $_POST["nuevoTotalPago"],
                    "forma_pago"   => $_POST["nuevaFormaPago"],
                    "estado_pago"  => $_POST["nuevoEstadoPago"],
                    "estado_pedido"=> $_POST["nuevoEstadoPedido"]
                );

                $respuesta = ModeloPedidos::mdlIngresarPedido($tabla, $datos);

                if($respuesta == "ok"){

                    echo'<script>
                    swal({
                          type: "success",
                          title: "El pedido ha sido guardado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {
                                        window.location = "pedidos";
                                    }
                                })
                    </script>';
                }

            }else{
                echo'<script>
                    swal({
                          type: "error",
                          title: "¡El pedido no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {
                                window.location = "pedidos";
                            }
                        })
                </script>';
            }
        }
    }

    

    /*=============================================
    FILTRAR PEDIDOS
    =============================================*/
    static public function ctrFiltrarPedidos($filtros){

        $tabla = "pedidos";

        $respuesta = ModeloPedidos::mdlFiltrarPedidos($tabla, $filtros);

        return $respuesta;
    }

    /*=============================================
    EDITAR PEDIDO
    =============================================*/
    static public function ctrEditarPedido(){

        if(isset($_POST["editarIdCliente"])){

            if(preg_match('/^[0-9]+$/', $_POST["editarIdCliente"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMaterial"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDetalle"]) &&
               preg_match('/^[0-9]+$/', $_POST["editarCantidad"]) &&
               preg_match('/^[0-9\-: ]+$/', $_POST["editarFechaPedido"]) &&
               preg_match('/^[0-9\-: ]+$/', $_POST["editarFechaEntrega"]) &&
               preg_match('/^[0-9.]+$/', $_POST["editarTotalPago"]) &&
               preg_match('/^(transferencia|efectivo)$/', $_POST["editarFormaPago"]) &&
               preg_match('/^(completo|parcial|pendiente)$/', $_POST["editarEstadoPago"]) &&
               preg_match('/^(proceso|entregado|cancelado|devolucion)$/', $_POST["editarEstadoPedido"])){

                $tabla = "pedidos";

                $datos = array(
                    "id"           => $_POST["idPedido"],
                    "id_cliente"   => $_POST["editarIdCliente"],
                    "material"     => $_POST["editarMaterial"],
                    "detalle"      => $_POST["editarDetalle"],
                    "cantidad"     => $_POST["editarCantidad"],
                    "fecha_pedido" => $_POST["editarFechaPedido"],
                    "fecha_entrega"=> $_POST["editarFechaEntrega"],
                    "total_pago"   => $_POST["editarTotalPago"],
                    "forma_pago"   => $_POST["editarFormaPago"],
                    "estado_pago"  => $_POST["editarEstadoPago"],
                    "estado_pedido"=> $_POST["editarEstadoPedido"]
                );

                $respuesta = ModeloPedidos::mdlEditarPedido($tabla, $datos);

                if($respuesta == "ok"){

                    echo'<script>
                    swal({
                          type: "success",
                          title: "El pedido ha sido cambiado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {
                                        window.location = "pedidos";
                                    }
                                })
                    </script>';
                }

            }else{
                echo'<script>
                    swal({
                          type: "error",
                          title: "¡El pedido no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                            if (result.value) {
                                window.location = "pedidos";
                            }
                        })
                </script>';
            }
        }
    }

    /*=============================================
    ELIMINAR PEDIDO
    =============================================*/
    static public function ctrEliminarPedido(){

        if(isset($_GET["idPedido"])){

            $tabla ="pedidos";
            $datos = $_GET["idPedido"];

            $respuesta = ModeloPedidos::mdlEliminarPedido($tabla, $datos);

            if($respuesta == "ok"){

                echo'<script>
                swal({
                      type: "success",
                      title: "El pedido ha sido borrado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                      }).then(function(result){
                                if (result.value) {
                                    window.location = "pedidos";
                                }
                            })
                </script>';
            }       
        }
    }
}

