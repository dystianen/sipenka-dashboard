<?= $this->extend('layouts/l_dashboard') ?>
<?= $this->section('content') ?>

<h3 class="text-white mb-3">Normalisasi Matriks dan Eigen Vector</h3>

<!-- Normalisasi Matriks -->
<div class="card mb-3">
  <div class="card-header bg-primary text-white">Normalisasi Matriks</div>
  <div class="card-body">
    <?php if (empty($categories) || empty($normalizedMatrix)): ?>
      <p class="text-center text-muted">No data available</p>
    <?php else: ?>
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th>Kriteria</th>
            <?php foreach ($categories as $c): ?>
              <th><?= esc($c['name']) ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($categories as $row): ?>
            <tr>
              <td><b><?= esc($row['name']) ?></b></td>
              <?php foreach ($categories as $col): ?>
                <td><?= number_format($normalizedMatrix[$row['category_id']][$col['category_id']] ?? 0, 3) ?></td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</div>

<!-- Eigen Vector -->
<div class="card mb-3">
  <div class="card-header bg-success text-white">Eigen Vector (Prioritas Kriteria)</div>
  <div class="card-body">
    <?php if (empty($weights)): ?>
      <p class="text-center text-muted">No data available</p>
    <?php else: ?>
      <table class="table table-bordered text-center">
        <thead class="table-light">
          <tr>
            <th>Kriteria</th>
            <th>Eigen Vector</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($weights as $w): ?>
            <tr>
              <td><?= esc($categoryMap[$w['criteria_id']] ?? '-') ?></td>
              <td><?= number_format($w['weight'], 3) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
  </div>
</div>

<!-- Info Consistency -->
<div class="card mb-3">
  <div class="card-header bg-info text-white">Konsistensi</div>
  <div class="card-body">
    <?php if (empty($result)): ?>
      <p class="text-center text-muted">No data available</p>
    <?php else: ?>
      <p>λmax (Lambda Max): <b><?= number_format($result['lambda_max'] ?? 0, 3) ?></b></p>
      <p>CI (Consistency Index): <b><?= number_format($result['ci'] ?? 0, 3) ?></b></p>
      <p>CR (Consistency Ratio): <b><?= number_format($result['consistency_ratio'] ?? 0, 3) ?></b></p>
      <p>Status:
        <?php if (!empty($result['is_valid']) && $result['is_valid']): ?>
          <span class="badge bg-success">Valid (CR < 0.1)</span>
            <?php else: ?>
              <span class="badge bg-danger">Tidak Konsisten</span>
            <?php endif; ?>
      </p>
    <?php endif; ?>
  </div>
</div>

<?= $this->endSection() ?>