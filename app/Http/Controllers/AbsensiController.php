<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;

use App\Models\Absensi;

class AbsensiController extends Controller
{

    public function __construct()
    {
        $this->absensi = new Absensi();
    }

    public function index()
    {
        $data = [
            'absensi' => $this->absensi->absensi_mingguan()->groupBy('parkir.rfid')->get(),
        ];
        return view('absensi.index', $data);
    }

    public function show(Request $request, $id)
    {
        $data = [
            'rfid' => $id,
            'absensi' => $this->absensi->absensi_mingguan()->whereDate('check_in', $request->tanggal)->where('parkir.rfid', $id)->get(),
        ];

        return view('absensi.show', $data);
    }

    public function export(Request $request, $id)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $file_name = "ABSENSI-".date('YmdHis');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
        $sheet->setCellValue('A1', 'ABSENSI HARIAN');
        $sheet->setCellValue('A2', $request->tanggal);
        $spreadsheet->getActiveSheet()->getRowDimension('4')->setRowHeight(25, 'pt');
        $HeadstyleArray = array(
            'borders' => array(
                'outline' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
                'color' => array('rgb' => 'FFFFFFFF'),
                ),
            ),
            'font' => [
                'bold' => true,
                'color' => array('argb' => 'FFFFFFFF'),
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => array('argb' => '1F4E78'),
            ],
        );

        $sheet->getStyle('A4:G5')->applyFromArray($HeadstyleArray);
        //header
        $sheet->setCellValue('A4', "No");
        $sheet->setCellValue('B4', "RFID");
        $sheet->setCellValue('C4', "Nama");
        $sheet->setCellValue('D4', "Masuk");
        $sheet->setCellValue('D5', "Tanggal");
        $sheet->setCellValue('E5', "Jam");
        $sheet->setCellValue('F4', "Keluar");
        $sheet->setCellValue('F5', "Tanggal");
        $sheet->setCellValue('G5', "Jam");

        $sheet->getStyle('A4:G5')->getAlignment()->setHorizontal('center')->setVertical('center');
        $sheet->getStyle('A4:G5')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR);

        $sheet->mergeCells("A4:A5");
        $sheet->mergeCells("B4:B5");
        $sheet->mergeCells("C4:C5");
        $sheet->mergeCells("D4:E4");
        $sheet->mergeCells("F4:G4");

        $IsistyleArray = array(
            'borders' => [
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
                ],
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOTTED,
                ],
            ],
        );

        $query =  $this->absensi->absensi_mingguan()->where('parkir.rfid', $id)->whereDate('check_in', $request->tanggal)->get();
        $no = 1;
        $rowCount = 6;
        foreach ($query as $key => $rows) {
           
            $sheet->setCellValue('A' . $rowCount, $no++);
            $sheet->setCellValue('B' . $rowCount, $rows->rfid);
            $sheet->setCellValue('C' . $rowCount, $rows->nama);
            $sheet->setCellValue('D' . $rowCount, date('d/m/Y', strtotime($rows->check_in)));
            $sheet->setCellValue('E' . $rowCount, date('H:i', strtotime($rows->check_in)));
            if(empty($rows->check_out)){
                 $sheet->setCellValue('F' . $rowCount, '-');
                 $sheet->mergeCells('F'.$rowCount.':G'.$rowCount);
            }else{
                $sheet->setCellValue('F' . $rowCount, date('d/m/Y', strtotime($rows->check_out)));
                $sheet->setCellValue('G' . $rowCount, date('H:i', strtotime($rows->check_out)));
            }
            
            
            $sheet->getStyle('A'.$rowCount.':G'.$rowCount)->applyFromArray($IsistyleArray);
            $rowCount++;
        }

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setWidth(55);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

        $spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);

        $spreadsheet->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $spreadsheet->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
        $sheet->getPageMargins()->setLeft(0.3)->setRight(0.3)->setTop(0.4)->setBottom(0.4)->setHeader(0);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="'.$file_name.'.xlsx"');
        $writer->save("php://output");
    }
}
