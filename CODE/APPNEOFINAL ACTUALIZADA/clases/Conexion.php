<?php
class Conexion {
    public function conectar() {
        $ccn = mysqli_connect("localhost","root","","bd_venta1");
        return $ccn;
    }

    public function test_input($data) {
        $cnn = $this->conectar();

        $data = mysqli_real_escape_string($cnn, $data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>