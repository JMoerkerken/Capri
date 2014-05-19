<?php

    require('/library/fpdf/fpdf.php');
    
    class ReceiptProductHelper {
        
        private $pdf;
        private $totalAdded = false;
        private $vatAdded = false;
            
        function __construct() {
            $this->pdf = new FPDF();
            $this->pdf->AddPage();
            $this->pdf->SetFont('Arial','B',16);
            $this->pdf->Cell(0,10,'Capri Ijs & Delicatesse');
            $this->pdf->Ln();
            $this->pdf->Ln();
        }

        public function addProduct($title = '', $price = '', $amount = '', $totalPrice = ''){
            $this->pdf->SetFont('Arial','',12);
            $this->pdf->Cell(40,10,$title);
            $this->pdf->Cell(30,10,$price);
            $this->pdf->Cell(20,10,$amount);
            $this->pdf->Cell(30,10,$totalPrice);
            $this->pdf->Ln();
        }
        
        public function addTotal($totalPrice){
            $this->pdf->SetFont('Arial','',12);
            $this->pdf->Ln();
            $this->pdf->Cell(40,10,'Totaal');
            $this->pdf->Cell(30,10,'');
            $this->pdf->Cell(20,10,'');
            $this->pdf->Cell(30,10,$totalPrice);
            $this->pdf->Ln();
            $this->totalAdded = true;
        }
        
        public function addVAT($percentage = 6, $totalPriceEXVAT = 0.0, $remainingVAT = 0.0){
            $this->pdf->SetFont('Arial','',12);
            $this->pdf->Cell(40,10,'');
            $this->pdf->Cell(30,10,'BTW');
            $this->pdf->Ln();
            $this->pdf->Cell(40,10,'');
            $this->pdf->Cell(30,10,'Schaal');
            $this->pdf->Cell(20,10,'Over');
            $this->pdf->Cell(30,10,'EUR');
            $this->pdf->Ln();
            $this->pdf->Cell(40,10,'');
            $this->pdf->Cell(30,10,$percentage . '%');
            $this->pdf->Cell(20,10,$totalPriceEXVAT);
            $this->pdf->Cell(30,10,$remainingVAT);
            $this->pdf->Ln();
            $this->vatAdded = true;
        }

        public function output(){
            if($this->totalAdded && $this->vatAdded){
                return $this->pdf->Output();
            }
            return 'Er is een fout voorgekomen. Mogelijk zijn niet alle velden van het bonnetje gevuld.';
        }
    }