<?php
require_once 'vendor/autoload.php';

use setasign\Fpdi\Fpdi;

$pdfPath = "test.pdf";
$imagePath = "imagen.png";
$nuevoNombreDelPDF = "NuevoPDF.pdf";

if (file_exists($pdfPath) && file_exists($imagePath)) {
    $pdf = new Fpdi();
    $pdf->setSourceFile($pdfPath);

    $pageCount = $pdf->setSourceFile($pdfPath);

    $x = 10;
    $y = 10;
    $width = 100;
    $height = 50;

    for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
        $template = $pdf->importPage($pageNumber);
        $pdf->AddPage();
        $pdf->useTemplate($template);
        $pdf->Image($imagePath, $x, $y, $width, $height);
    }

    $nuevoPDFPath = dirname(__FILE__) . '/' . $nuevoNombreDelPDF;
    $pdf->Output($nuevoPDFPath, "F");

    echo "Número de páginas en el archivo PDF: " . $pageCount;

    echo "<embed src='$nuevoNombreDelPDF' type='application/pdf' width='100%' height='600px' />";
    echo "<a href='$nuevoNombreDelPDF' download>Descargar PDF</a>";
} else {
    echo "Los archivos necesarios no existen.";
}
