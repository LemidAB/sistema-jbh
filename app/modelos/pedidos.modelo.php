<?php

require_once "conexion.php";

class ModeloPedidos{

    /*=============================================
    CREAR PEDIDO
    =============================================*/
    static public function mdlIngresarPedido($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
            id_cliente, 
            material, 
            detalle, 
            cantidad, 
            fecha_pedido, 
            fecha_entrega, 
            total_pago, 
            forma_pago, 
            estado_pago, 
            estado_pedido
        ) VALUES (
            :id_cliente, 
            :material, 
            :detalle, 
            :cantidad, 
            :fecha_pedido, 
            :fecha_entrega, 
            :total_pago, 
            :forma_pago, 
            :estado_pago, 
            :estado_pedido
        )");

        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":material", $datos["material"], PDO::PARAM_STR);
        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_pedido", $datos["fecha_pedido"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_entrega", $datos["fecha_entrega"], PDO::PARAM_STR);
        $stmt->bindParam(":total_pago", $datos["total_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":forma_pago", $datos["forma_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_pago", $datos["estado_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_pedido", $datos["estado_pedido"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    MOSTRAR PEDIDOS
    =============================================*/
    static public function mdlMostrarPedidos($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt -> close();
        $stmt = null;
    }

    /*=============================================
    FILTRAR PEDIDO
    =============================================*/
    static public function mdlFiltrarPedidos($tabla, $filtros){
        $sql = "SELECT * FROM $tabla WHERE 1=1";

        if(!empty($filtros["nombre"])){
            $sql .= " AND nombre LIKE :nombre";
        }
            if(!empty($filtros["fecha_pedido"])){
                $sql .= " AND fecha_pedido = :fecha";
        }
            if(!empty($filtros["estado_pedido"])){
                $sql .= " AND estado_pedido = :estadoPedido";
        }
            if(!empty($filtros["estado_pago"])){
                $sql .= " AND estado_pago = :estadoPago";
        }

        $stmt = Conexion::conectar()->prepare($sql);

        if(!empty($filtros["nombre"])){
            $stmt->bindParam(":nombre", $filtros["nombre"], PDO::PARAM_STR);
        }
        if(!empty($filtros["fecha_pedido"])){
            $stmt->bindParam(":fecha", $filtros["fecha_pedido"], PDO::PARAM_STR);
        }
        if(!empty($filtros["estado_pedido"])){
            $stmt->bindParam(":estadoPedido", $filtros["estado_pedido"], PDO::PARAM_STR);
        }
        if(!empty($filtros["estado_pago"])){
            $stmt->bindParam(":estadoPago", $filtros["estado_pago"], PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    /*=============================================
    EDITAR PEDIDO
    =============================================*/
    static public function mdlEditarPedido($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
            id_cliente = :id_cliente, 
            material = :material, 
            detalle = :detalle, 
            cantidad = :cantidad, 
            fecha_pedido = :fecha_pedido, 
            fecha_entrega = :fecha_entrega, 
            total_pago = :total_pago, 
            forma_pago = :forma_pago, 
            estado_pago = :estado_pago, 
            estado_pedido = :estado_pedido
            WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":material", $datos["material"], PDO::PARAM_STR);
        $stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_pedido", $datos["fecha_pedido"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_entrega", $datos["fecha_entrega"], PDO::PARAM_STR);
        $stmt->bindParam(":total_pago", $datos["total_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":forma_pago", $datos["forma_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_pago", $datos["estado_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_pedido", $datos["estado_pedido"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    ELIMINAR PEDIDO
    =============================================*/
    static public function mdlEliminarPedido($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){
            return "ok";
        }else{
            return "error"; 
        }

        $stmt -> close();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR PEDIDO
    =============================================*/
    static public function mdlActualizarPedido($tabla, $item1, $valor1, $valor){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");
        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":id", $valor, PDO::PARAM_INT);

        if($stmt -> execute()){
            return "ok";
        }else{
            return "error"; 
        }

        $stmt -> close();
        $stmt = null;
    }
}
