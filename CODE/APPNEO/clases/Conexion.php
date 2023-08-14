<?php
class Conexion {
    public function conectar() {
        $ccn = mysqli_connect("localhost", "root", "", "bd_venta");
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

<?php
class Conexion {
    public function conectar() {
        $ccn = mysqli_connect("localhost", "id21144704_fast123", "Fast#2023", "id21144704_fast");

        // Verificar si la conexión tuvo éxito
        if (!$ccn) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        return $ccn;
    }

    public function test_input($data) {
        $cnn = $this->conectar();

        $data = mysqli_real_escape_string($cnn, $data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        // Cerrar la conexión después de su uso
        mysqli_close($cnn);

        return $data;
    }
}
?>

