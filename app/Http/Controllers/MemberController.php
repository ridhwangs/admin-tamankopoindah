<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\Member;
use App\Models\Parkir;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->member = new Member();
    }

    public function index()
    {
        $data = [
            'member' => Member::with('kendaraan')->where('jenis_member', '!=', 'master')->orderBy('nama','asc')->paginate(15),
        ];

        return view('member.index', $data);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    public function topup(Request $request)
    {
        if(empty($request->tanggal)){
            $query = $this->member->member_transaksi()->paginate(15);
        }else{
            $query = $this->member->member_transaksi()->whereDate('created_at', $request->tanggal)->paginate(15);
        }
        $data = [
            'member_transaksi' => $query,
            'member_transaksi_open' => $this->member->member_transaksi()->where('status','open')->paginate(15),
        ];

        return view('member.top_up', $data);
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
    public function show($id)
    {
        $data = [
            'member' => Member::where('rfid', $id)->first(),
            'member_transaksi' => $this->member->member_transaksi()->where('rfid', $id)->get(),
            'member_usesage' => Parkir::where('rfid', $id)->paginate(15),
        ];

        return view('member.show', $data);
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
        $data = [
            'status' => $request->status
        ];
        $this->member->member_transaksi()->where('topup_id', $id)->update($data);
        return redirect()->back()->with('message', 'Berhasil di simpan!');
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

    public function export(Request $request, $laporan)
    {
        switch ($laporan) {
            case 'member':
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $file_name = "MEMBER-".date('YmdHis');
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
                $sheet->setCellValue('A1', 'DATA MEMBER');
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
                $sheet->setCellValue('B4', "Register");
                $sheet->setCellValue('C4', "RFID");
                $sheet->setCellValue('D4', "Nama");
                $sheet->setCellValue('E4', "Kendaraan");
                $sheet->setCellValue('F4', "Jenis Member");
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

                $query =  Member::with('kendaraan')->where('jenis_member', '!=', 'master')->orderBy('nama','asc')->get();
                $no = 0;
                $rowCount = 5;
                foreach ($query as $key => $rows) {
                    $no++;
                    
                    $sheet->setCellValue('A' . $rowCount, $no);
                    $sheet->setCellValue('B' . $rowCount, $rows->tgl_awal);
                    $sheet->setCellValue('C' . $rowCount, $rows->nama);
                    $sheet->setCellValue('D' . $rowCount, $rows->rfid);
                    $sheet->setCellValue('E' . $rowCount, $rows->kendaraan->nama_kendaraan);
                    $sheet->setCellValue('F' . $rowCount, $rows->jenis_member);
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
            case 'topup':
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $file_name = "MEMBER-TOPUP-".date('YmdHis');
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
                $sheet->setCellValue('A1', 'DATA MEMBER TOPUP');
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
                $sheet->setCellValue('B4', "RFID");
                $sheet->setCellValue('C4', "Jumlah");
                $sheet->setCellValue('D4', "Hari");
                $sheet->setCellValue('E4', "Status");
                $sheet->setCellValue('F4', "Operator");
                $sheet->setCellValue('G4', "Waktu");

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

                if(empty($request->tanggal)){
                    $query = $this->member->member_transaksi()->get();
                }else{
                    $query = $this->member->member_transaksi()->whereDate('created_at', $request->tanggal)->get();
                }

                $no = 0;
                $rowCount = 5;
                foreach ($query as $key => $rows) {
                    $no++;
                    
                    $sheet->setCellValue('A' . $rowCount, $no);
                    $sheet->setCellValue('B' . $rowCount, $rows->rfid);
                    $sheet->setCellValue('C' . $rowCount, $rows->jumlah);
                    $sheet->setCellValue('D' . $rowCount, $rows->hari);
                    $sheet->setCellValue('E' . $rowCount, $rows->status);
                    $sheet->setCellValue('F' . $rowCount, $rows->created_by);
                    $sheet->setCellValue('G' . $rowCount, $rows->created_at);
                    
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
            default:
                # code...
                break;
        }
                
    }
}
