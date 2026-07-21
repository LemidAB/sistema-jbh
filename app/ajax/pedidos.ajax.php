<?php

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

class AjaxPedidos{

    /*=============================================
    EDITAR PEDIDO
    =============================================*/ 
    public $idPedido;

    public function ajaxEditarPedido(){

        $item = "id";
        $valor = $this->idPedido;

        $respuesta = ControladorPedidos::ctrMostrarPedidos($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
    FILTRAR PEDIDOS
    =============================================*/ 
    public $buscarNombre;
    public $buscarFecha;
    public $buscarEstadoPedido;
    public $buscarEstadoPago;

    public function ajaxFiltrarPedidos(){

        $item = null;
        $valor = null;

        // Construimos condiciones dinámicas
        $filtros = array();

        if($this->buscarNombre != null){
            $filtros["nombre"] = $this->buscarNombre;
        }

        if($this->buscarFecha != null){
            $filtros["fecha_pedido"] = $this->buscarFecha;
        }

        if($this->buscarEstadoPedido != null){
            $filtros["estado_pedido"] = $this->buscarEstadoPedido;
        }

        if($this->buscarEstadoPago != null){
            $filtros["estado_pago"] = $this->buscarEstadoPago;
        }

        $respuesta = ControladorPedidos::ctrFiltrarPedidos($filtros);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR PEDIDO
=============================================*/ 
if(isset($_POST["idPedido"])){

    $pedido = new AjaxPedidos();
    $pedido -> idPedido = $_POST["idPedido"];
    $pedido -> ajaxEditarPedido();
}

/*=============================================
FILTRAR PEDIDOS
=============================================*/ 
if(isset($_POST["buscarNombre"]) || isset($_POST["buscarFecha"]) || isset($_POST["buscarEstadoPedido"]) || isset($_POST["buscarEstadoPago"])){

    $filtro = new AjaxPedidos();

    $filtro -> buscarNombre = $_POST["buscarNombre"] ?? null;
    $filtro -> buscarFecha = $_POST["buscarFecha"] ?? null;
    $filtro -> buscarEstadoPedido = $_POST["buscarEstadoPedido"] ?? null;
    $filtro -> buscarEstadoPago = $_POST["buscarEstadoPago"] ?? null;

    $filtro -> ajaxFiltrarPedidos();
}
