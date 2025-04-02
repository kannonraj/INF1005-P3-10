<?php
require_once 'lib/fpdf/fpdf.php';

function generateBookingPDF($fname, $carName, $startDate, $endDate, $bookingId) {
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Booking Confirmation - PEAK Car Rental', 0, 1, 'C');

    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(10);

    $pdf->MultiCell(0, 10, "Hello $fname,\n\nThank you for your booking.\n\nHere are your booking details:\n\nBooking ID: $bookingId\nCar: $carName\nStart Date: $startDate\nEnd Date: $endDate\n\nPlease present this confirmation at the pickup location.\n\nWe look forward to serving you!\n\n— PEAK Car Rental Team");

    $filePath = sys_get_temp_dir() . "/booking_" . md5($bookingId . time()) . ".pdf";
    $pdf->Output('F', $filePath);

    return $filePath;
}
