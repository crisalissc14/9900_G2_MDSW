<?php
class Producto {
    public function save($datos)
    {
        require_once 'Conexion.php';
        $c = new Conexion();
        $conexion = $c->conectar();
        $nombre = $c->test_input($datos[0]);
        $pc = $c->test_input($datos[1]);
        $pv = $c->test_input($datos[2]);
        $stock = $c->test_input($datos[3]);
        $proveedor = $c->test_input($datos[4]);
        $categoria = $c->test_input($datos[5]);

        // Verificar si el stock es negativo, si es así, devolver mensaje de error.
        if ($stock < 0) {
            $mensaje_error = "No es posible guardar un producto con stock negativo.";
            return $mensaje_error;
        }

        $sql = "INSERT INTO productos(nombre,precio_compra,precio_venta,stock,id_proveedor,id_categoria,estado) 
                VALUES ('$nombre','$pc','$pv','$stock','$proveedor','$categoria','activo')";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }
    
    public function edit($datos)
    {
        require_once 'Conexion.php';
        $c = new Conexion();
        $conexion = $c->conectar();
        $id = $datos[0];
        $nombre = $c->test_input($datos[1]);
        $pc = $c->test_input($datos[2]);
        $pv = $c->test_input($datos[3]);
        $stock = $c->test_input($datos[4]);
        $proveedor = $c->test_input($datos[5]);
        $categoria = $c->test_input($datos[6]);

        // Verificar si el stock es negativo, si es así, devolver mensaje de error.
        if ($stock < 0) {
            $mensaje_error = "No es posible editar el stock con números negativos.";
            return $mensaje_error;
        }

        $sql = "update productos set nombre = '$nombre', precio_compra = '$pc',precio_venta = '$pv',
            stock = '$stock', id_proveedor = '$proveedor', id_categoria = '$categoria' where id_producto=$id";
        $result = mysqli_query($conexion, $sql);
        
        // Si la actualización se realizó con éxito, devolver true
        if ($result) {
            return true;
        } else {
            // En caso de error, devolver mensaje de error de la base de datos
            $mensaje_error = "Error al editar el producto: " . mysqli_error($conexion);
            return $mensaje_error;
        }
    }
    
    public function delete($id)
    {
        require_once 'Conexion.php';
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "update productos set estado = 'inactivo' where id_producto=$id";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }
    
    public function mostrar()
    {
        require_once 'Conexion.php';
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "SELECT pro.id_producto,pro.nombre,pro.precio_compra,pro.precio_venta,pro.stock,pr.nombre as id_proveedor,ca.nombre
            as id_categoria FROM categorias AS ca
            INNER JOIN productos AS pro ON pro.id_categoria=ca.id_categoria INNER JOIN proveedores AS pr ON pr.id_proveedor=pro.id_proveedor
            WHERE pro.estado = 'activo' ORDER BY pro.stock DESC"; // Ordenar por stock de mayor a menor
        $result = mysqli_query($conexion, $sql);
        return $result; 
    }
    
    public function traer($id)
    {
        require_once 'Conexion.php';
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "select * from productos where id_producto=$id";
        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_row($result);
        $datos = array(
            "id_producto" =>html_entity_decode($ver[0]),
            "nombre" =>html_entity_decode($ver[1]),
            "precio_compra" =>html_entity_decode($ver[2]),
            "precio_venta" =>html_entity_decode($ver[3]),
            "stock" =>html_entity_decode($ver[4]),
            "id_proveedor" =>html_entity_decode($ver[5]),
            "id_categoria" =>html_entity_decode($ver[7])
         );
         return $datos;
    }
    
    public function traer_datos_cb($id)
    {
        require_once 'Conexion.php';
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "select precio_venta,stock from productos where id_producto=$id";
        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_row($result);
        $datos = array(
            "precio_venta" =>html_entity_decode($ver[0]),
            "stock" =>html_entity_decode($ver[1])
         );
         return $datos;
    }

    public function stock($id, $stock)
    {
        require_once 'Conexion.php';
        $c = new Conexion();
        $conexion = $c->conectar();
        $sql = "update productos set stock = stock + '$stock' where id_producto=$id";
        $result = mysqli_query($conexion, $sql);
        return $result;
    }   
}
?>