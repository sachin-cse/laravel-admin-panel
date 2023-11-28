<?php

namespace App\Http\Controllers;
// use Dompdf\Dompdf;
use PDF;
// use Dompdf\Options;
// use Barryvdh\DomPDF\PDF;
use App\Models\Activitylog;
use Illuminate\Http\Request;
use App\Exports\ActivityLogExport;
use Maatwebsite\Excel\Facades\Excel;

class ActivityLogController extends Controller
{
    //
    public function downloadFormat($format, $id){
        $get_data = Activitylog::find($id);
        // dd($get_data);

        $data = [
            'id' => $get_data->id,
            'current_logged_id' => $get_data->current_logged_id,
            'ip_address' => $get_data->ip_address,
            'user_type' => $get_data->user_type,
            'user_name' => $get_data->user_name,
            'device_access' => $get_data->device_access
        ];
        // dd($data);
        if($format === 'excel'){
          return $this->downloadExcel($data);
        } else if($format === 'pdf'){
            return $this->downloadPDF($data);
        }
    }

    // call these function

    private function downloadExcel($data){
        // dd($data);
        return Excel::download(new ActivityLogExport($data), 'activity_log.xlsx');
    }

    private function downloadPDF($data){
        $pdf = PDF::loadView('pdf.activity-log', compact('data'));

        // return $pdf->stream('activity-log.pdf');

        return $pdf->download('activity_log.pdf');
    }

    // private function downloadPDF($data){
    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml(view('admin.activity_log', ['data' => $data])->render());
    
    //     // Set paper size (optional)
    //     $dompdf->setPaper('A4', 'landscape');
    
    //     // Render the HTML as PDF
    //     $dompdf->render();
    
    //     // Output the PDF content
    //     return $dompdf->stream('activity_log.pdf');
    
    // }


}
