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
            // Bisa ditambahkan tampilan error PDF jika mau
            return redirect()->back()->with('error', 'Data AHP tidak ditemukan.');
        }

        // Ambil evaluasi berdasarkan AHP ID dan Periode
        $evaluations = $evaluationModel->getEvaluationWithTeachers($activePeriodId, $latestAhp['ahp_result_id']);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('evaluation-results/v_pdf', [
            'evaluations' => $evaluations,
            'periodName'  => $period['name'],
            'totalData'      => count($evaluations),
        ]));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Nama file
        $filename = date('Y-m-d-H-i-s') . '-teacher-ranking';

        // Stream PDF
        $dompdf->stream($filename, ['Attachment' => true]);
    }
}
