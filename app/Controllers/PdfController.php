<?php

namespace App\Controllers;

use App\Models\AhpResultModel;
use App\Models\EvaluationResultModel;
use App\Models\PeriodModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;

class PdfController extends Controller
{
    public function generate()
    {
        $ahpModel = new AhpResultModel();
        $evaluationModel = new EvaluationResultModel();
        $periodModel = new PeriodModel();

        $period = $periodModel
            ->where('is_active', 1)
            ->first();

        if (!$period) {
            return redirect()->back()->with('error', 'Active period not found.');
        }

        $activePeriodId = $period['period_id'];

        // Ambil AHP result terbaru untuk periode
        $latestAhp = $ahpModel
            ->where('period_id', $activePeriodId)
            ->orderBy('created_at', 'DESC')
            ->first();

        if (!$latestAhp) {
            return redirect()->back()->with('error', 'AHP data not found.');
        }

        // Ambil filter tanggal dari GET
        $startDate = $this->request->getGet('start_date');
        $endDate   = $this->request->getGet('end_date');

        // Gunakan query yang sama dengan index()
        $evaluations = $evaluationModel->getEvaluationWithTeachers(
            $activePeriodId,
            $latestAhp['ahp_result_id'],
            $startDate,
            $endDate
        );

        // Inisialisasi Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('evaluation-results/v_pdf', [
            'evaluations' => $evaluations,
            'periodName'  => $period['name'],
            'totalData'   => count($evaluations),
            'startDate'   => $startDate,
            'endDate'     => $endDate
        ]));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Nama file
        $filename = date('Y-m-d') . '-teacher-ranking';

        // Stream PDF
        $dompdf->stream($filename, ['Attachment' => true]);
    }
}
