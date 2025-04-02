<?php
require_once 'lib/fpdf/fpdf.php';

function generateCancellationPDF($fname, $carName, $startDate, $endDate, $bookingId) {
    $pdf = new FPDF();
    $pdf->AddPage();

    // Header
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Cancellation Confirmation - PEAK Car Rental', 0, 1, 'C');
    $pdf->Ln(5);

    // Content
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, "Hello $fname,\n\nYour booking has been successfully cancelled.\n\nBooking Details:\n\nBooking ID: $bookingId\nCar: $carName\nStart Date: $startDate\nEnd Date: $endDate\nStatus: Cancelled\n\nWe hope to serve you again soon.\n\n— The PEAK Car Rental Team");

    $filePath = sys_get_temp_dir() . "/cancel_" . md5($bookingId . time()) . ".pdf";
    $pdf->Output('F', $filePath);

    return $filePath;
}
