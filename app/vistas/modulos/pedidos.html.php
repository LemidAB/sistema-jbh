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
        <form method="post" id="formBuscarPedidos">
             <!-- aquí van los inputs y selects de filtros -->
        </form>
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
          <!-- Ejemplo estático, luego se reemplaza con datos dinámicos en pedidos.php -->
          <tr>
            <td>1</td>
            <td>Juan Villegas</td>
            <td>Madera</td>
            <td>Cortes especiales</td>
            <td>50</td>
            <td>2026-06-24</td>
            <td>2026-06-30</td>
            <td>1500</td>
            <td>Transferencia</td>
            <td>Parcial</td>
            <td>En proceso</td>
            <td>
              <div class="btn-group">
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
              </div>  
            </td>
          </tr>
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
                <input type="number" class="form-control input-lg" name="nuevoIdCliente" placeholder="ID del cliente" required>
              </div>
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
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaFechaPedido" placeholder="Fecha del pedido" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevaFechaEntrega" placeholder="Fecha de entrega" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
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

    </div>

  </div>

</div>
