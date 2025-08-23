<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>

<style>
  .dashboard-hero {
    background: url("<?= base_url('assets/img/sd.jpeg'); ?>") center/cover no-repeat;
    min-height: 40vh;
    border-radius: 1rem;
    position: relative;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    text-shadow: 0 3px 6px rgba(0, 0, 0, 0.6);
  }

  .dashboard-hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
    /* overlay gelap */
    border-radius: 1rem;
  }

  .dashboard-hero h1 {
    position: relative;
    z-index: 1;
    font-size: 2.5rem;
    font-weight: 700;
  }
</style>

<div class="container-fluid py-4">
  <!-- Hero Section -->
  <div class="dashboard-hero mb-5">
    <h1 class="text-white">Welcome, <?= session()->get('name') ?> 👋</h1>
  </div>

  <!-- Info Cards -->
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <i class="bi bi-people display-4 text-primary"></i>
          <h5 class="mt-3">Jumlah Guru</h5>
          <h3 class="fw-bold"><?= $jumlahGuru ?></h3>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <i class="bi bi-award display-4 text-success"></i>
          <h5 class="mt-3">Rata-rata Nilai</h5>
          <h3 class="fw-bold"><?= $avgScore ?></h3>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-body text-center">
          <i class="bi bi-graph-up display-4 text-danger"></i>
          <h5 class="mt-3">Ranking Tertinggi</h5>
          <?php if ($topRank): ?>
            <h4 class="fw-bold"><?= $topRank['teacher_name'] ?></h4>
            <p class="mb-0">Skor: <?= $topRank['normalized_score'] ?></p>
            <span class="badge bg-primary"><?= $topRank['category'] ?></span>
          <?php else: ?>
            <p class="text-muted">Belum ada data</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Tambahan Section -->
  <div class="mt-5">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0 text-white">Informasi Terbaru</h5>
      </div>
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li>📌 Evaluasi periode 2025 telah dimulai.</li>
          <li>📌 Deadline input penilaian: 30 September 2025.</li>
          <li>📌 Silakan cek menu <b>Evaluasi</b> untuk update terbaru.</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>