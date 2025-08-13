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

        $activePeriodId = $period['period_id'];

        // Ambil AHP result terbaru
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

        $builder = $evaluationModel
            ->where('period_id', $activePeriodId)
            ->where('ahp_result_id', $latestAhp['ahp_result_id']);

        if ($startDate && $endDate) {
            $builder->where('created_at >=', $startDate . ' 00:00:00')
                ->where('created_at <=', $endDate . ' 23:59:59');
        }

        $evaluations = $builder->orderBy('final_score', 'DESC')->findAll();

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
