<?php
// Incluir la librería FPDF
require('./fpdf.php');

// Crear la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "bd_venta1";

$conn = new mysqli("localhost","root","","bd_venta1");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear una instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10, 'Reporte de ventas NEO FAST AND GRILL', 0, 1, 'C');

// Consultar los datos de la base de datos
$sql = "SELECT id_venta, fecha, cliente, estado, total, numero FROM ventas";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Generar una tabla en el PDF
    $pdf->Ln(10); // Salto de línea
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(30, 10, 'Fecha', 1);
    $pdf->Cell(50, 10, 'Categoria', 1);
    $pdf->Cell(20, 10, 'Estado', 1);
    $pdf->Cell(30, 10, 'Total', 1);
    $pdf->Cell(30, 10, 'Numero', 1);
    $pdf->Ln();

    // Rellenar la tabla con los datos de la base de datos
    while($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row["fecha"], 1);
        $pdf->Cell(50, 10, $row["cliente"], 1);
        $pdf->Cell(20, 10, $row["estado"], 1);
        $pdf->Cell(30, 10, $row["total"], 1);
        $pdf->Cell(30, 10, $row["numero"], 1);
        $pdf->Ln(); // Salto de línea
    }
} else {
    $pdf->Ln(10); // Salto de línea
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0, 10, 'No hay datos disponibles', 0, 1, 'C');
}

// Cerrar la conexión a la base de datos
$conn->close();

// Generar el PDF
$pdf->Output();
?>
