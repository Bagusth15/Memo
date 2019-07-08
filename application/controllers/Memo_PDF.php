<?php
Class Memo_PDF extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('M_pdf');
        is_logged_in();
    }
    
    function index($id){
        $memo = $this->M_pdf->getMemoById($id);
        $memo_pengirim = $this->M_pdf->getMemoPengirim($id);
        $memo_penerima = $this->M_pdf->getMemoPenerima($id);
        $user_role_m = $this->M_pdf->userRole();
        $user_role_d = $this->M_pdf->userRoled();
        $image = "assets/img/checked.png";

        $pdf = new FPDF('p','mm','A4');
        $pdf->SetMargins(15,20,15);
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image('assets/img/hiroto.png',15,18,50);
        $pdf->SetTitle("Cetak Memo");
        $pdf->SetFont('Arial','',8);
        $pdf->Ln(3);
        $pdf->Cell(0,20,'Kantor Pusat : Ruko Grand Ciomas No.6 Jl. Raya Ciomas 1, RT.002/011 Desa Ciomas, Kec Ciomas, Bogor, Jawabarat 16610','0','1','L',false);
        $pdf->Ln(-5);
        $pdf->Cell(185,0.6,'','0','1','C',true);
        $pdf->Ln(5);

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(185,6,'Memo Internal',0,0,'C');

        $pdf->SetFont('Arial','B',8);
        $pdf->Ln(10);
        $pdf->Cell(30,6,'No',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(150,6,$memo['mm_id']. ' / MI / PTHG',0,0,'L');

        $pdf->Ln(6);
        $pdf->Cell(30,6,'Tanggal',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(150,6,date('d F Y', $memo['mm_tgl_buat']),0,0,'L');

        $pdf->Ln(6);
        $pdf->Cell(30,6,'Kepada',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(150,6,$memo_penerima['user_name'],0,0,'L');

        $pdf->Ln(6);
        $pdf->Cell(30,6,'Hal',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->Cell(150,6,$memo['mm_perihal'],0,0,'L');

        $pdf->Ln(6);
        $pdf->Cell(30,6,'Rincian',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->MultiCell(150,6,$memo['mm_isi']);

        $pdf->Ln(6);
        $pdf->Cell(30,6,'Note',0,0,'L');
        $pdf->Cell(5,6,':',0,0,'C');
        $pdf->MultiCell(150,6,$memo['mm_note']);

        $pdf->Ln(12);
        $pdf->SetTextColor(255,0,0);
        $pdf->Cell(185,0.3,'','0','1','C',true);
        $memo_a = $this->M_pdf->getMemoActivityJoin();
        foreach ($memo_a as $ma) {
            if ($memo_pengirim['mm_id'] == $ma['ma_mm_id']) {
                $pdf->Cell(185,6,'Approved By '.$ma['user_email'],0,0,'L');
                $pdf->Ln(6);
            }
        }
        $pdf->Cell(185,0.3,'','0','1','C',true);
        
        


        $pdf->Output();
    }
}