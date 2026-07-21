<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>
    window.location = "inicio";
  </script>';

  return;
}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      Administrar pedidos
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar pedidos</li>
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPedido">
          Agregar pedido
        </button>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         <tr>
           <th style="width:10px">#</th>
           <th>Cliente</th>
           <th>Material</th>
           <th>Detalle</th>
           <th>Cantidad</th>
           <th>Fecha pedido</th>
           <th>Fecha entrega</th>
           <th>Total pago</th>
           <th>Forma pago</th>
           <th>Estado pago</th>
           <th>Estado pedido</th>
           <th>Acciones</th>
         </tr> 
        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $pedidos = ControladorPedidos::ctrMostrarPedidos($item, $valor);

          foreach ($pedidos as $key => $value) {
            
            echo '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["id_cliente"].'</td>
                    <td>'.$value["material"].'</td>
                    <td>'.$value["detalle"].'</td>
                    <td>'.$value["cantidad"].'</td>
                    <td>'.date("d/m/Y h:i A", strtotime($value["fecha_pedido"])).'</td>
                    <td>'.date("d/m/Y h:i A", strtotime($value["fecha_entrega"])).'</td>
                    <td>'.$value["total_pago"].'</td>
                    <td>'.$value["forma_pago"].'</td>
                    <td>'.$value["estado_pago"].'</td>
                    <td>'.$value["estado_pedido"].'</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarPedido" data-toggle="modal" data-target="#modalEditarPedido" idPedido="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
                      
                      if($_SESSION["perfil"] == "Administrador"){
                          echo '<button class="btn btn-danger btnEliminarPedido" idPedido="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                      }

                      echo '</div>  
                    </td>
                  </tr>';
          }

        ?>
   
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PEDIDO
======================================-->

<div id="modalAgregarPedido" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar pedido</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <!-- Cliente -->
            <div class="form-group">
                <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <select class="form-control input-lg" name="nuevoIdCliente" required>
                        <option value="">Seleccione cliente</option>
                      <?php
                        $clientes = ControladorClientes::ctrMostrarClientes(null, null);
                        foreach($clientes as $cliente){
                        echo '<option value="'.$cliente["id"].'">'.$cliente["nombre"].'</option>';
                          }
                          ?>
                        </select>
                </div>
  <!-- Botón para registrar nuevo cliente -->
  <a href="index.php?ruta=clientes" class="btn btn-primary btn-sm" style="margin-top:5px">
    Registrar nuevo cliente
  </a>
</div>

            <!-- Material -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cube"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoMaterial" placeholder="Material requerido" required>
              </div>
            </div>

            <!-- Detalle -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-info"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoDetalle" placeholder="Detalle del pedido (cortes, enteros...)" required>
              </div>
            </div>

            <!-- Cantidad -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 
                <input type="number" class="form-control input-lg" name="nuevaCantidad" placeholder="Cantidad" required>
              </div>
            </div>

            <!-- Fechas -->
            <div class="form-group">
              <label for="fecha_entrega">Fecha de entrega</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="datetime-local" class="form-control input-lg" name="fecha_entrega" required>
              </div>
            </div>

            <!-- Pago -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoTotalPago" placeholder="Total del pago" required>
              </div>
            </div>

            <!-- Forma de pago -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 
                <select class="form-control input-lg" name="nuevaFormaPago" required>
                  <option value="">Seleccionar forma de pago</option>
                  <option value="transferencia">Transferencia</option>
                  <option value="efectivo">Efectivo</option>
                </select>
              </div>
            </div>

            <!-- Estado del pago -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check-circle"></i></span> 
                <select class="form-control input-lg" name="nuevoEstadoPago" required>
                  <option value="">Seleccionar estado del pago</option>
                  <option value="completo">Completo</option>
                  <option value="parcial">Parcial</option>
                  <option value="pendiente">Pendiente</option>
                </select>
              </div>
            </div>

            <!-- Estado del pedido -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-truck"></i></span> 
                <select class="form-control input-lg" name="nuevoEstadoPedido" required>
                  <option value="">Seleccionar estado del pedido</option>
                  <option value="proceso">En proceso</option>
                  <option value="entregado">Entregado</option>
                  <option value="cancelado">Cancelado</option>
                  <option value="devolucion">Devolución</option>
                </select>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar pedido</button>
        </div>

      </form>

      <?php
        $crearPedido = new ControladorPedidos();
        $crearPedido -> ctrCrearPedido();
      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PEDIDO
======================================-->

<div id="modalEditarPedido" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar pedido</h4>
        </div>

                <div class="modal-body">

          <div class="box-body">

            <!-- Cliente -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="number" class="form-control input-lg" name="editarIdCliente" id="editarIdCliente" required>
                <input type="hidden" id="idPedido" name="idPedido">
              </div>
            </div>

            <!-- Material -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cube"></i></span> 
                <input type="text" class="form-control input-lg" name="editarMaterial" id="editarMaterial" required>
              </div>
            </div>

            <!-- Detalle -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-info"></i></span> 
                <input type="text" class="form-control input-lg" name="editarDetalle" id="editarDetalle" required>
              </div>
            </div>

            <!-- Cantidad -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span> 
                <input type="number" class="form-control input-lg" name="editarCantidad" id="editarCantidad" required>
              </div>
            </div>

            <!-- Fechas -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                <input type="text" class="form-control input-lg" name="editarFechaPedido" id="editarFechaPedido" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 
                <input type="text" class="form-control input-lg" name="editarFechaEntrega" id="editarFechaEntrega" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div>
            </div>

            <!-- Pago -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span> 
                <input type="text" class="form-control input-lg" name="editarTotalPago" id="editarTotalPago" required>
              </div>
            </div>

            <!-- Forma de pago -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 
                <select class="form-control input-lg" name="editarFormaPago" id="editarFormaPago" required>
                  <option value="">Seleccionar forma de pago</option>
                  <option value="transferencia">Transferencia</option>
                  <option value="efectivo">Efectivo</option>
                </select>
              </div>
            </div>

            <!-- Estado del pago -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check-circle"></i></span> 
                <select class="form-control input-lg" name="editarEstadoPago" id="editarEstadoPago" required>
                  <option value="">Seleccionar estado del pago</option>
                  <option value="completo">Completo</option>
                  <option value="parcial">Parcial</option>
                  <option value="pendiente">Pendiente</option>
                </select>
              </div>
            </div>

            <!-- Estado del pedido -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-truck"></i></span> 
                <select class="form-control input-lg" name="editarEstadoPedido" id="editarEstadoPedido" required>
                  <option value="">Seleccionar estado del pedido</option>
                  <option value="proceso">En proceso</option>
                  <option value="entregado">Entregado</option>
                  <option value="cancelado">Cancelado</option>
                  <option value="devolucion">Devolución</option>
                </select>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

      </form>

      <?php
        $editarPedido = new ControladorPedidos();
        $editarPedido -> ctrEditarPedido();
      ?>

    </div>

  </div>

</div>

<?php
  $eliminarPedido = new ControladorPedidos();
  $eliminarPedido -> ctrEliminarPedido();
?>
