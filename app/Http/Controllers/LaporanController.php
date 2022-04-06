<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Parkir;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    public function export(Request $request, $laporan)
    {
        switch ($laporan) {
            case 'masuk':
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $file_name = "LAPORAN-MASUK-".$request->tanggal."-".date('YmdHis');
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
                $sheet->setCellValue('A1', 'LAPORAN MASUK');
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

                $sheet->getStyle('A4:G4')->applyFromArray($HeadstyleArray);
                //header
                $sheet->setCellValue('A4', "No");
                $sheet->setCellValue('B4', "No Tiket");
                $sheet->setCellValue('C4', "Barcode");
                $sheet->setCellValue('D4', "RFID");
                $sheet->setCellValue('E4', "Tanggal");
                $sheet->setCellValue('F4', "Kategori");
                $sheet->setCellValue('G4', "Status");

                $sheet->getStyle('A4:G4')->getAlignment()->setHorizontal('center')->setVertical('center');
                $sheet->getStyle('A4:G4')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR);


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

                $query =  Parkir::where('status','!=','keluar')->whereDate('check_in', $request->tanggal)->orderBy('check_in', 'DESC')->get();
                $no = 0;
                $rowCount = 5;
                foreach ($query as $key => $rows) {
                    $no++;
                    
                    $sheet->setCellValue('A' . $rowCount, $no);
                    $sheet->setCellValue('B' . $rowCount, $rows->no_ticket);
                    $sheet->setCellValue('C' . $rowCount, $rows->barcode_id);
                    $sheet->setCellValue('D' . $rowCount, $rows->rfid);
                    $sheet->setCellValue('E' . $rowCount, $rows->check_in);
                    $sheet->setCellValue('F' . $rowCount, $rows->kategori);
                    $sheet->setCellValue('G' . $rowCount, $rows->status);
                    
                    $sheet->getStyle('A'.$rowCount.':G'.$rowCount)->applyFromArray($IsistyleArray);
                    $rowCount++;
                }

                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
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
            break;
            case 'keluar':
                $today = Carbon::today();
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

                $spreadsheet = new Spreadsheet();
                
                $spreadsheet->getSheet(0);
                $spreadsheet->getSheetByName('NON MEMBER');
                $sheet = $spreadsheet->getActiveSheet()->setTitle('NON MEMBER');

                $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
               
                $spreadsheet->getActiveSheet()->getRowDimension('4')->setRowHeight(25, 'pt');

                $sheet->setCellValue('A1', 'LAPORAN KELUAR NON MEMBER');
                $sheet->setCellValue('A2', $request->tanggal);
                $sheet->getStyle('A4:J4')->applyFromArray($HeadstyleArray);
                //header
                $sheet->setCellValue('A4', "No");
                $sheet->setCellValue('B4', "No Tiket");
                $sheet->setCellValue('C4', "BARCODE");
                $sheet->setCellValue('D4', "Waktu Masuk");
                $sheet->setCellValue('E4', "Waktu Keluar");
                $sheet->setCellValue('F4', "Tarif");
                $sheet->setCellValue('G4', "Keterangan");
                $sheet->setCellValue('H4', "No Polisi");
                $sheet->setCellValue('I4', "Operator");
                $sheet->setCellValue('J4', "Shift");

                $sheet->getStyle('A4:J4')->getAlignment()->setHorizontal('center')->setVertical('center');
                $sheet->getStyle('A4:J4')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR);

             
                $where = [
                    'status' => 'keluar',
                ];

                if(!empty($request->tanggal)){
                    $today = $request->tanggal;
                }

                $operator_id = 0;
                if(!empty($request->operator_id)){
                    $operator_id = $request->operator_id;
                    $where['operator_id'] = $operator_id;
                }

                $shift_id = 0;
                if(!empty($request->shift_id)){
                    $shift_id = $request->shift_id;
                    $where['shift_id'] = $shift_id;
                }
                
                $query = Parkir::with('kendaraan','operator','shift')->where($where)->whereDate('check_out', $today)->whereNull('rfid')->orderBy('check_out', 'DESC')->get();
                $no = 0;
                $rowCount = 5;

                foreach ($query as $key => $rows) {
                    $no++;

                    $sheet->setCellValue('A' . $rowCount, $no);
                    $sheet->setCellValue('B' . $rowCount, $rows->no_ticket);
                    $sheet->setCellValue('C' . $rowCount, $rows->barcode_id);
                    $sheet->setCellValue('D' . $rowCount, $rows->check_in);
                    $sheet->setCellValue('E' . $rowCount, $rows->check_out);
                    $sheet->setCellValue('F' . $rowCount, $rows->tarif);
                    $sheet->setCellValue('G' . $rowCount, $rows->keterangan);
                    $sheet->setCellValue('H' . $rowCount, $rows->no_kend);
                    $sheet->setCellValue('I' . $rowCount, $rows->operator->nama);
                    $sheet->setCellValue('J' . $rowCount, $rows->shift->nama_shift);
                    
                    $sheet->getStyle('A'.$rowCount.':J'.$rowCount)->applyFromArray($IsistyleArray);
                    $rowCount++;
                }

                $rowSum = $rowCount;

                $spreadsheet->getActiveSheet()->getStyle('F5:F' . $rowSum)->getNumberFormat()->setFormatCode('#,##0');
               
                $sum = $rowSum - 1;
                $sheet->setCellValue('A' . $rowSum, "GRAND TOTAL");
                $sheet->setCellValue('F' . $rowSum, '=SUM(F5:F' . $sum . ')');

                $sheet->getStyle('A' . $rowSum . ':J' . $rowSum)->applyFromArray($HeadstyleArray);
                $sheet->mergeCells('A' . $rowSum . ':E' . $rowSum);
                $sheet->getStyle('A' . $rowSum . ':E' . $rowSum)->getAlignment()->setHorizontal('right')->setVertical('center');

                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);
                $sheet->getColumnDimension('J')->setAutoSize(true);
                $sheet->getColumnDimension('K')->setAutoSize(true);

                
                // LAP. KELUAR MEMBER
                $spreadsheet->createSheet(1);
                $sheetM = $spreadsheet->setActiveSheetIndex(1)->setTitle('MEMBER');
                
                $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
                $spreadsheet->getActiveSheet()->getRowDimension('4')->setRowHeight(25, 'pt');

                $sheetM->setCellValue('A1', 'LAPORAN KELUAR MEMBER');
                $sheetM->setCellValue('A2', $request->tanggal);
                $sheetM->getStyle('A4:J4')->applyFromArray($HeadstyleArray);
                //header
                $sheetM->setCellValue('A4', "No");
                $sheetM->setCellValue('B4', "No Tiket");
                $sheetM->setCellValue('C4', "Barcode");
                $sheetM->setCellValue('D4', "RFID");
                $sheetM->setCellValue('E4', "Nama Member");
                $sheetM->setCellValue('F4', "Waktu Masuk");
                $sheetM->setCellValue('G4', "Waktu Keluar");
                $sheetM->setCellValue('H4', "No Polisi");
                $sheetM->setCellValue('I4', "Operator");
                $sheetM->setCellValue('J4', "Shift");

                $sheetM->getStyle('A4:J4')->getAlignment()->setHorizontal('center')->setVertical('center');
                $sheetM->getStyle('A4:J4')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR);


                $whereM = [
                    'status' => 'keluar',
                ];

                if(!empty($request->tanggal)){
                    $today = $request->tanggal;
                }

                $operator_id = 0;
                if(!empty($request->operator_id)){
                    $operator_id = $request->operator_id;
                    $whereM['operator_id'] = $operator_id;
                }

                $shift_id = 0;
                if(!empty($request->shift_id)){
                    $shift_id = $request->shift_id;
                    $whereM['shift_id'] = $shift_id;
                }
                
                $queryM = Parkir::with('kendaraan','operator','shift','member')->where($whereM)->whereDate('check_out', $today)->whereNotNull('rfid')->orderBy('check_out', 'DESC')->get();
                $no = 0;
                $rowCount = 5;

                foreach ($queryM as $key => $rows) {
                    $no++;

                    $sheetM->setCellValue('A' . $rowCount, $no);
                    $sheetM->setCellValue('B' . $rowCount, $rows->no_ticket);
                    $sheetM->setCellValue('C' . $rowCount, $rows->barcode_id);
                    $sheetM->setCellValue('D' . $rowCount, $rows->rfid);
                    $sheetM->setCellValue('E' . $rowCount, $rows->member->nama);
                    $sheetM->setCellValue('F' . $rowCount, $rows->check_in);
                    $sheetM->setCellValue('G' . $rowCount, $rows->check_out);
                    $sheetM->setCellValue('H' . $rowCount, $rows->no_kend);
                    $sheetM->setCellValue('I' . $rowCount, $rows->operator->nama);
                    $sheetM->setCellValue('J' . $rowCount, $rows->shift->nama_shift);
                    
                    $sheetM->getStyle('A'.$rowCount.':J'.$rowCount)->applyFromArray($IsistyleArray);
                    $rowCount++;
                }

                $sheetM->getColumnDimension('A')->setWidth(5);
                $sheetM->getColumnDimension('B')->setAutoSize(true);
                $sheetM->getColumnDimension('C')->setAutoSize(true);
                $sheetM->getColumnDimension('D')->setAutoSize(true);
                $sheetM->getColumnDimension('E')->setAutoSize(true);
                $sheetM->getColumnDimension('F')->setAutoSize(true);
                $sheetM->getColumnDimension('G')->setAutoSize(true);
                $sheetM->getColumnDimension('H')->setAutoSize(true);
                $sheetM->getColumnDimension('I')->setAutoSize(true);
                $sheetM->getColumnDimension('J')->setAutoSize(true);
                $sheetM->getColumnDimension('K')->setAutoSize(true);


                $spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
                $spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);

                $spreadsheet->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
                $spreadsheet->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
                $sheet->getPageMargins()->setLeft(0.3)->setRight(0.3)->setTop(0.4)->setBottom(0.4)->setHeader(0);

                $file_name = "LAPORAN-KELUAR-".$request->tanggal."-".date('YmdHis');

                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename="'.$file_name.'.xlsx"');
                $writer->save("php://output");
            break;
            default:
                # code...
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        switch ($id) {
            case 'masuk':
                $data = [
                    'parkir' => Parkir::where('status','!=','keluar')->whereDate('check_in', $request->tanggal)->orderBy('check_in', 'DESC')->paginate(15),
                ];
                return view('laporan.masuk.index', $data);
                break;
            case 'keluar':
                $today = Carbon::today();
                $where = [
                    'status' => 'keluar',
                ];

                if(!empty($request->tanggal)){
                    $today = $request->tanggal;
                }

                $operator_id = 0;
                if(!empty($request->operator_id)){
                    $operator_id = $request->operator_id;
                    $where['operator_id'] = $operator_id;
                }

                $shift_id = 0;
                if(!empty($request->shift_id)){
                    $shift_id = $request->shift_id;
                    $where['shift_id'] = $shift_id;
                }

                $data = [
                    'parkir' => Parkir::with('kendaraan','operator','shift')->where($where)->whereDate('check_out', $today)->orderBy('check_out', 'DESC')->paginate(15),
                    'filter_operator_dashboard' => Parkir::with('operator')->where('status','keluar')->groupBy('operator_id')->get(),
                    'filter_shift_dashboard' => Parkir::with('shift')->where('status','keluar')->groupBy('shift_id')->get(),
                ];
                return view('laporan.keluar.index', $data);
                break;
            default:
                # code...
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
