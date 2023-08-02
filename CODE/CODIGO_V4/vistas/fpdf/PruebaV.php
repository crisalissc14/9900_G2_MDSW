<?php

require './fpdf.php';
require "../../clases/Conexion.php";

class PDF extends FPDF
{
    private $conexion; // Agregamos una propiedad para almacenar la conexión a la base de datos


    // Cabecera de página
    function Header()
    {
        $this->SetFont('Arial', 'B', 19);
        $this->Cell(45);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(110, 15, utf8_decode('NEO FAST AND GRILL'), 1, 1, 'C', 0);
        $this->Ln(3);
        $this->SetTextColor(103);

        /* TITULO DE LA TABLA */
        $this->SetTextColor(228, 100, 0);
        $this->Cell(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("REPORTE DE VENTAS"), 0, 1, 'C', 0);
        $this->Ln(7);

        /* CAMPOS DE LA TABLA */
        $this->SetFillColor(228, 100, 0);
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(163, 163, 163);
        $this->SetFont('Arial', 'B', 11);

        $anchoIdventa = 18;
        $anchoProducto = 80;
        $anchoCantidad = 25;
        $anchoPrecio = 25;
        $anchoImporte = 35;

        $this->Cell($anchoIdventa, 10, utf8_decode('idventa'), 1, 0, 'C', 1);
        $this->Cell($anchoProducto, 10, utf8_decode('producto'), 1, 0, 'C', 1);
        $this->Cell($anchoCantidad, 10, utf8_decode('cantidad'), 1, 0, 'C', 1);
        $this->Cell($anchoPrecio, 10, utf8_decode('precio'), 1, 0, 'C', 1);
        $this->Cell($anchoImporte, 10, utf8_decode('importe'), 1, 1, 'C', 1);
    }

    // Agregar filas de la tabla
    function AgregarFila($idventa, $producto, $cantidad, $precio, $importe)
    {
        $this->SetFont('Arial', '', 11);
        $this->SetFillColor(255);
        $this->SetTextColor(0);
        $this->SetDrawColor(163, 163, 163);

        $anchoIdventa = 18;
        $anchoProducto = 80;
        $anchoCantidad = 25;
        $anchoPrecio = 25;
        $anchoImporte = 35;

        $this->Cell($anchoIdventa, 10, utf8_decode($idventa), 1, 0, 'C', 1);
        $this->Cell($anchoProducto, 10, utf8_decode($producto), 1, 0, 'C', 1);
        $this->Cell($anchoCantidad, 10, utf8_decode($cantidad), 1, 0, 'C', 1);
        $this->Cell($anchoPrecio, 10, utf8_decode($precio), 1, 0, 'C', 1);
        $this->Cell($anchoImporte, 10, utf8_decode($importe), 1, 1, 'C', 1);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $hoy = date('d/m/Y');
        $this->Cell(0, 10, utf8_decode($hoy), 0, 0, 'C');
    }


}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

// Ejemplo de datos para rellenar la tabla (debes obtener los datos desde la base de datos)
$datos = array(
    array('24', 'hamburguesa', '2', '10', '20'),
    array('25', 'hamburguesa con queso', '1', '10', '10'),
    array('26', 'Coca-cola', '3', '1.50', '4.50'),
    // Agrega más filas si es necesario
);

foreach ($datos as $fila) {
    $pdf->AgregarFila($fila[0], $fila[1], $fila[2], $fila[3], $fila[4]);
}

$pdf->Output('Prueba.pdf', 'I');

