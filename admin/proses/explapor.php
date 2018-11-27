<?php
require 'fpdf.php';
require_once ("../../control/connect.php");
$data="";
$data=$_GET['data'];
            if ($data === "Jan"){
                $bulan="Januari";
            }elseif($data === "Feb"){
                $bulan="Februari";
            }elseif($data === "Mar"){
                $bulan="Maret";
            }elseif($data === "Apr"){
                $bulan="April";
            }elseif($data === "Mei"){
                $bulan="Mei";  
            }elseif($data === "Jun"){
                 $bulan="Juni";
            }elseif($data === "Jul"){
                $bulan="Juli";
            }elseif($data === "Agt"){
                $bulan="Agustus";
            }elseif($data === "Sep"){
                $bulan="Maret";
            }elseif($data === "Oct"){
                $bulan="Oktober";
            }elseif($data === "Nov"){
                $bulan="November";
            }else{
                $bulan="Desember";
            }
$no=1;
class myPDF extends FPDF{

    public function getBulan(){
        $data = $_GET['data'];

        if ($data === "Jan"){
            $bulan="Januari";
        }elseif($data === "Feb"){
            $bulan="Februari";
        }elseif($data === "Mar"){
            $bulan="Maret";
        }elseif($data === "Apr"){
            $bulan="April";
        }elseif($data === "Mei"){
            $bulan="Mei";  
        }elseif($data === "Jun"){
             $bulan="Juni";
        }elseif($data === "Jul"){
            $bulan="Juli";
        }elseif($data === "Agt"){
            $bulan="Agustus";
        }elseif($data === "Sep"){
            $bulan="Maret";
        }elseif($data === "Oct"){
            $bulan="Oktober";
        }elseif($data === "Nov"){
            $bulan="November";
        }else{
            $bulan="Desember";
        }

        return $bulan;
    }

    public function headerTable()
    {
        global $connection;
        $this->SetFont('Arial', 'B', 24);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(15, 6, "", 0, 0, 'C');
        $this->Cell(10, 10, 'No', 1, 0, 'C');
        $this->Cell(30, 10, 'Kode Order', 1, 0, 'C');
        $this->Cell(40, 10, 'Tanggal', 1, 0, 'C');
        $this->Cell(40, 10, 'Id Customer', 1, 0, 'C');
        $this->Cell(40, 10, 'Total', 1, 0, 'C');
        $this->Ln();
    }
    public function Header()
    {
        $bulan = $this->getBulan();
       //Pilih font Arial bold 15
       $this->SetFont('Arial','B',24);
       //Geser ke kanan
       $this->Cell(80);
       //Judul dalam bingkai
       $this->Cell(30,10,'LAPORAN BULANAN BUKULAPAK.COM',0,0,'C');
       $this->Ln();
       $this->SetFont('Arial','',20);
       $this->Cell(90,10,'Periode ',0,0,'R');
       $this->Cell(80,10,$bulan,0,0,'L');
       $this->Ln();      
    }
    public function viewTable()
    {
        global $connection;
        $this->SetFont('Arial', '', 12);
        $total=0;
        $no=1;
        $cari=$_GET['data'];
        $data1=mysqli_query($connection,"select * from chekout where tanggal like '%$cari%' AND status='Sudah Dikirim'");
        while ($data = mysqli_fetch_array($data1)) {
            $this->Cell(15, 6, "", 0, 0, 'C');
            $this->Cell(10, 6, $no, 1, 0, 'C');
            $this->Cell(30, 6, $data['kd_order'], 1, 0, 'C');
            $this->Cell(40, 6, $data['tanggal'], 1, 0, 'C');
            $this->Cell(40, 6, $data['id'], 1, 0, 'C');
            $this->Cell(40, 6, $data['total'], 1, 0, 'R');
            $this->Ln();
            $total=$total+$data['total'];
            $no++;
            
        }
        $this->Cell(15, 6, "", 0, 0, 'C');
        $this->Cell(120, 6,'Total :', 1, 0, 'R');
        $this->Cell(40, 6,$total, 1, 0, 'R');
    }
}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P', 'A4', '0');
$pdf->headerTable();
$pdf->viewTable();
$pdf->Output();
?>