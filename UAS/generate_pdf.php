<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

include 'config.php';
require('fpdf/fpdf.php');

class PDF extends FPDF {
    // Page header
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Laporan Klasemen UEFA 2024', 0, 1, 'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Table
    function FancyTable($header, $data) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->Cell(50, 7, $header[0], 1, 0, 'C', true);
        $this->Cell(30, 7, $header[1], 1, 0, 'C', true);
        $this->Cell(30, 7, $header[2], 1, 0, 'C', true);
        $this->Cell(30, 7, $header[3], 1, 0, 'C', true);
        $this->Cell(30, 7, $header[4], 1, 0, 'C', true);
        $this->Ln();

        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $fill = false;

        foreach ($data as $row) {
            $this->Cell(50, 7, $row['name'], 'LR', 0, 'L', $fill);
            $this->Cell(30, 7, $row['wins'], 'LR', 0, 'C', $fill);
            $this->Cell(30, 7, $row['draws'], 'LR', 0, 'C', $fill);
            $this->Cell(30, 7, $row['losses'], 'LR', 0, 'C', $fill);
            $this->Cell(30, 7, $row['points'], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }

        $this->Cell(170, 0, '', 'T');
    }
}

// Fetch data from database
$sql = "SELECT countries.name, results.wins, results.draws, results.losses, results.points 
        FROM results 
        JOIN countries ON results.country_id = countries.id";
$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$pdf = new PDF();
$pdf->AddPage();
$header = ['Negara', 'Menang', 'Seri', 'Kalah', 'Poin'];
$pdf->FancyTable($header, $data);
$pdf->Output();
?>
