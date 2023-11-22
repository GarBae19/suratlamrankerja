<?php

namespace App\Controllers;

use Config\Services;
use FPDF;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => "Surat Lamaran Kerja",
            'validation' => \Config\Services::validation()
        ];
        return view('index', $data);
    }
    function tanggal_indonesia($tanggal)
    {

        $bulan = array(
            1 =>       'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $var = explode('-', $tanggal);

        return $var[2] . ' ' . $bulan[(int)$var[1]] . ' ' . $var[0];
        // var 0 = tanggal
        // var 1 = bulan
        // var 2 = tahun
    }
    public function generatePDF()
    {

        $formatted_date = $this->tanggal_indonesia(date('Y-m-d'));
        // $imagePath = WRITEPATH . '\ttd\ttd.png';
        // inisialisasi objek PDF

        $pdf = new FPDF('P', 'mm', 'A4');

        // tambahkan halaman
        $pdf->AddPage();



        $pdf->SetY(35);
        $pdf->SetFont('Times', '', 12);

        $pdf->Cell(0, 7, $formatted_date, 0, 0, 'R');
        $pdf->Ln();
        $pdf->Cell(20, 7, 'Perihal', 0);
        $pdf->Cell(10);
        $pdf->Cell(0, 7, ':', 0);
        $pdf->SetFont('Times', 'BU', 12);
        $pdf->SetX($pdf->GetX() - 157);
        $pdf->Cell(0, 7, 'Permohonan Kerja', 0);
        $pdf->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 7, 'Kepada Yth.', 0);
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(0, 7, 'Bapak/Ibu', 0);
        $pdf->Ln();
        $pdf->Cell(0, 7, 'HRD', 0);
        $pdf->Ln();
        $pdf->Cell(0, 7, $this->request->getVar('perusahaan'), 0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(0, 7, 'Di Tempat', 0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(0, 7, 'Dengan Hormat,', 0);
        $pdf->Ln();
        $pdf->Cell(0, 7, 'Saya yang bertanda tangan di bawah ini :', 0);
        $pdf->Ln();
        $pdf->Ln();

        // Set judul kolom
        $pdf->SetFillColor(255, 255, 255); // Mengatur warna latar belakang ke putih
        $pdf->SetDrawColor(255, 255, 255); // Mengatur warna garis ke putih

        $pdf->Cell(60, 7, 'Nama', 'LT', 0, 'L', false); // Kolom Nama
        $pdf->MultiCell(0, 7, ': Tegar Sri Sumantri', 'RT', 'L', false); // Teks Nama

        $pdf->Cell(60, 7, 'Tempat, Tanggal lahir', 'L', 0, 'L', false); // Kolom Tempat, Tanggal Lahir
        $pdf->MultiCell(0, 7, ': Serang, 19 April 2000', 'R', 'L', false); // Teks Tempat, Tanggal Lahir

        $pdf->Cell(60, 7, 'Alamat', 'L', 0, 'L', false); // Kolom NIM
        $pdf->MultiCell(0, 7, ': BCP Blok B17 No3 Rt.15 Rw.04 Des.Ranjeng Kec.Ciruas Serang Banten', 'R', 'L', false); // Teks NIM

        $pdf->Cell(60, 7, 'Pendidikan Terakhir', 'L', 0, 'L', false); // Kolom Program Studi
        $pdf->MultiCell(0, 7, ': S-1 Komputer', 'R', 'L', false); // Teks Program Studi

        $pdf->Cell(60, 7, 'No. Telepon/Hp', 'L', 0, 'L', false); // Kolom Jenjang
        $pdf->MultiCell(0, 7, ': 0859102868989', 'R', 'L', false); // Teks Jenjang

        $pdf->Cell(60, 7, 'Email', 'L', 0, 'L', false); // Kolom Nama Orang Tua
        $pdf->Cell(60, 7, ':', 'L', 0, 'L', false); // Kolom Nama Orang Tua

        $pdf->SetTextColor(0, 0, 255); // RGB: biru (0, 0, 255)
        $pdf->SetFont('Times', 'U', 12);
        $pdf->SetX($pdf->GetX() - 58);
        $pdf->MultiCell(0, 7, 'tegarsumantri19@gmail.com', 0, 'L', false); // Teks Nama Orang Tua

        $pdf->SetFont('Times', '', 12);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->Ln();
        $pdf->Ln();
        $pdf->MultiCell(0, 7, 'Dengan saya mengajukan permohonan kerja untuk menempati posisi sebagai ' . $this->request->getVar('role') . ' pada ' . $this->request->getVar('perusahaan') . ' yang bapak/ibu Pimpin. ', 0);
        $pdf->Cell(0, 7, 'Demikian surat lamaran ini saya sampaikan, atas perhatiannya saya ucapkan terimakasih.', 0);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetX($pdf->GetX() + 147);
        $pdf->MultiCell(0, 7, "Hormat Saya", 0);
        $pdf->Image('ttd.png', $pdf->GetX() + 145, $pdf->GetY() - 13, 50, 50);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetX($pdf->GetX() + 147);
        $pdf->MultiCell(0, 9, "Tegar Sri Sumantri", 0);
        // output file PDF
        helper('text');
        $randomName = 'Surat Lamaran Kerja ' . $this->request->getVar('perusahaan');
        $namepdf = $randomName . '.pdf';

        // Output langsung ke browser tanpa menyimpan di server
        $pdf->Output('D', $namepdf);
        return $this->response;
        return redirect()->to('/');
    }
}
