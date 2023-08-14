<?php
class Conexion {
    public function conectar() {
        $ccn = mysqli_connect("localhost","id21144568_adm1","NeoAdmin#12345","id21144568_base");
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