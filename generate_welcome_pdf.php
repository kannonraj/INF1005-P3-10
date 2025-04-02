<?php
require_once 'lib/fpdf/fpdf.php';

function generateWelcomePDF($fname, $email) {
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Welcome to PEAK Car Rental!', 0, 1, 'C');

    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(10);
    $pdf->MultiCell(0, 10, "Dear $fname,\n\nThank you for registering with PEAK Car Rental.\n\nYou can now book cars, view your booking history, and manage your account easily.\n\nWe’re excited to have you with us!\n\n— The PEAK Car Rental Team");

    $filePath = sys_get_temp_dir() . "/welcome_" . md5($email . time()) . ".pdf";
    $pdf->Output('F', $filePath);

    return $filePath;
}
