<?php

namespace App\Http\Controllers;

use App\Models\Category;   //nama model
use App\Models\Setting;   //nama model
use App\Models\Complaint;   //nama model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //untuk membuat query di controller
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use App\Helpers\DateHelpers; // Important
use Carbon\Carbon;

class ReportController extends Controller
{
     ## Cek Login
     public function __construct()
     {
         $this->middleware('auth');
     }
     
     ## Tampikan Data
     public function index()
     {
         $title = "Laporan";
         $category = category::get();
         return view('admin.report.index',compact('title','category'));
     }

     ## Tampilkan Data Search
    public function download_report(Request $request)
    {
        $setting = Setting::first();

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->getColumnDimension('A')->setWidth(3);
		$sheet->getColumnDimension('B')->setWidth(30);
		$sheet->getColumnDimension('C')->setWidth(15);
		$sheet->getColumnDimension('D')->setWidth(35);
		$sheet->getColumnDimension('E')->setWidth(35);
		$sheet->getColumnDimension('F')->setWidth(50);
		$sheet->getColumnDimension('G')->setWidth(30);
		$sheet->getColumnDimension('H')->setWidth(30);
		$sheet->getColumnDimension('I')->setWidth(15);
		$sheet->getColumnDimension('J')->setWidth(30);

        
        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('xx');
        $drawing->setDescription('xx');
        $drawing->setPath(public_path("./upload/setting/166120532712.png"));
        $drawing->setCoordinates('C3');
        $drawing->setOffsetX(0);
        $drawing->setWidth(70);
        $drawing->setHeight(70);
        $drawing->getShadow()->setVisible(true);
        // $drawing->getShadow()->setDirection(45);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setName('xx');
        $drawing->setDescription('xx');
        $drawing->setPath(public_path("./upload/setting/".$setting->small_icon));
        $drawing->setCoordinates('I3');
        $drawing->setOffsetX(-30);
        $drawing->setWidth(70);
        $drawing->setHeight(70);
        $drawing->getShadow()->setVisible(true);
        // $drawing->getShadow()->setDirection(45);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        $month = $request->month;
        $year = $request->year;
        $category_id = $request->category_id;
        $report_type = $request->report_type;

        $sheet->getStyle('A3:A6')->getFont()->setBold(true);
        $sheet->setCellValue('A3', 'PEMERINTAH KOTA BAUBAU'); $sheet->mergeCells('A3:J3');
        $sheet->getStyle('A3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        if($report_type =="emergency"){
            $sheet->setCellValue('A4', 'REKAPITULASI ADUAN VIA BUTTON EMERGENCY'); $sheet->mergeCells('A4:J4');
        } else if($report_type =="phone"){
            $sheet->setCellValue('A4', 'REKAPITULASI ADUAN VIA PANGGILAN TELEPON'); $sheet->mergeCells('A4:J4');
        } else if($report_type =="complaint"){
            $sheet->setCellValue('A4', 'REKAPITULASI ADUAN VIA COMPLAINT'); $sheet->mergeCells('A4:J4');
        } else{
            $sheet->setCellValue('A4', 'REKAPITULASI SEMUA ADUAN'); $sheet->mergeCells('A4:J4');
        }
        $sheet->getStyle('A4:J4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $sheet->setCellValue('A5', 'DINAS KESEHATAN BAUBAU'); $sheet->mergeCells('A5:J5');
        $sheet->getStyle('A5:J5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $sheet->setCellValue('A6', 'BULAN '.strtoupper(DateHelpers::month($month)).' TAHUN '.$year); $sheet->mergeCells('A6:J6');
        $sheet->getStyle('A6:J6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $sheet->getStyle('A9:J10')->getFont()->setBold(true);
        $sheet->getStyle('A9:J10')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('A9', 'NO');$sheet->mergeCells('A9:A10');
        $sheet->setCellValue('B9', 'NAMA PENGADU');$sheet->mergeCells('B9:B10');
        $sheet->setCellValue('C9', 'NOMOR HP');$sheet->mergeCells('C9:C10');
        $sheet->setCellValue('D9', 'JENIS ADUAN');$sheet->mergeCells('D9:D10');
        $sheet->setCellValue('E9', 'RINGKASAN KEJADIAN');$sheet->mergeCells('E9:E10');
        $sheet->setCellValue('F9', 'LOKASI ADUAN');$sheet->mergeCells('F9:F10');

        $sheet->setCellValue('G9', 'WAKTU ADUAN');$sheet->mergeCells('G9:H9');
        $sheet->setCellValue('G10', 'MULAI');
        $sheet->setCellValue('H10', 'SELESAI');

        $sheet->setCellValue('I9', 'STATUS ADUAN');$sheet->mergeCells('I9:I10');
        $sheet->setCellValue('J9', 'KETERANGAN');$sheet->mergeCells('J9:J10');
        $rows = 11;
        $no = 1;
    
        $complaint = Complaint::
                    where(function ($query) {
                        $query->where('status', 'reject')
                            ->orWhere('status', 'done');
                    })->orderBy('created_at', 'DESC');
        
                    if($request->get('month')){
                        $complaint = $complaint->where(function ($query) use ($month) {
                            $query->whereMonth('created_at', $month);
                        });
                    }

                    if($request->get('year')){
                        $complaint = $complaint->where(function ($query) use ($year) {
                            $query->whereYear('created_at', $year);
                        });
                    }

                    if($request->get('category_id')){
                        $complaint = $complaint->where(function ($query) use ($category_id) {
                            $query->where('category_id', $category_id);
                        });
                    }

                    if($request->get('report_type')){
                        $complaint = $complaint->where(function ($query) use ($report_type) {
                            $query->where('report_type', $report_type);
                        });
                    }

                    $complaint = $complaint->get();
        
        foreach($complaint as $v){
            $sheet->setCellValue('A' . $rows, $no++);
            $sheet->setCellValue('B' . $rows, $v->name);
            $sheet->setCellValue('C' . $rows, $v->phone_number);
            $sheet->setCellValue('D' . $rows, $v->category->name);
            $sheet->setCellValue('E' . $rows, $v->summary);
            $sheet->setCellValue('F' . $rows, $v->incident_area);
            $day_response_time = Carbon::parse($v->handling->response_time)->format('D');
            $date_response_time = Carbon::parse($v->handling->response_time)->format('d');
            $month_response_time = Carbon::parse($v->handling->response_time)->format('m');
            $year_response_time = Carbon::parse($v->handling->response_time)->format('Y');
            $time_response_time = Carbon::parse($v->handling->response_time)->format('H:i');
            $sheet->setCellValue('G' . $rows, ucfirst(DateHelpers::day($day_response_time)).', '.$date_response_time.' '.ucfirst(DateHelpers::month($month_response_time)).' '.$year_response_time.'  '.$time_response_time);
            
            $day_done_time = Carbon::parse($v->handling->done_time)->format('D');
            $date_done_time = Carbon::parse($v->handling->done_time)->format('d');
            $month_done_time = Carbon::parse($v->handling->done_time)->format('m');
            $year_done_time = Carbon::parse($v->handling->done_time)->format('Y');
            $time_done_time = Carbon::parse($v->handling->done_time)->format('H:i');
            $sheet->setCellValue('H' . $rows, ucfirst(DateHelpers::day($day_done_time)).', '.$date_done_time.' '.ucfirst(DateHelpers::month($month_done_time)).' '.$year_done_time.'  '.$time_done_time);
            
            if($v->status=="reject"){
                $sheet->setCellValue('I' . $rows, "Ditolak");
                $sheet->setCellValue('J' . $rows, $v->reason);
            } else {
                $sheet->setCellValue('I' . $rows, "Selesai");
                $sheet->setCellValue('J' . $rows, $v->description);
            }
            $rows++;
        }
        
        $sheet->getStyle('A9:J'.($rows-1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getStyle('A9:J'.($rows-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        
        $type = 'xlsx';
        $fileName = "Rekapitulasi Aduan Dinas Kesehatan Baubau.".$type;

        if($type == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
        } else if($type == 'xls') {
            $writer = new Xls($spreadsheet);			
        }		
        $writer->save("public/upload/report/".$fileName);
        header("Content-Type: application/vnd.ms-excel");
        return redirect(url('/')."/public/upload/report/".$fileName);    

    }
 
}
