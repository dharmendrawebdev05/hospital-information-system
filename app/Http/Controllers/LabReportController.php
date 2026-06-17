<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\LabOrder;

class LabReportController extends Controller
{
    public function index()
    {
        $reports = LabOrder::with(['patient','doctor','test'])
            ->where('status','Completed')
            ->latest()
            ->get();

        return view('lab_reports.index', compact('reports'));
    }

    public function show($id)
    {
        $report = LabOrder::with(['patient','doctor','test'])
            ->findOrFail($id);

        return view('lab_reports.show', compact('report'));
    }

    public function print($id)
    {
    $report = LabOrder::with(['patient','doctor','test'])
        ->findOrFail($id);

    $pdf = Pdf::loadView('lab_reports.print', compact('report'));

    return $pdf->download('lab-report-'.$id.'.pdf');
    }





}
