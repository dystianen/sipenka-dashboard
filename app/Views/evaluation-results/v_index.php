<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header mb-4 pb-0 d-flex align-items-center justify-content-between">
    <h4>Teachers Rank</h4>
    <a class="btn btn-danger" href="<?php echo site_url('evaluation-results/pdf/generate') ?>">
      <i class="fas fa-file-pdf"></i>
      Export PDF
    </a>
  </div>

  <div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive px-4">
      <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th>Ranking</th>
            <th>Nama Guru</th>
            <th>Final Score</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($evaluations)): ?>
            <tr>
              <td colspan="9" class="text-center text-muted">No teachers data available.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($evaluations as $e): ?>
              <tr>
                <td><?= esc($e['rank']) ?></td>
                <td><?= esc($e['teacher_name']) ?></td>
                <td><?= esc(number_format($e['final_score'], 4)) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>

      </table>
    </div>
  </div>
</div>
<?= $this->endSection() ?>