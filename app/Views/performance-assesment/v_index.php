<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-0">
  <h4 class="text-white">Teachers</h4>
</div>

<div class="mt-3">
  <?php if (empty($teachers)): ?>
    <h1 class="text-center text-muted">No teachers data available.</h1>
  <?php else: ?>
    <div class="d-flex flex-column align-items-start gap-4">
      <div class="container-fluid px-0">
        <div class="row g-2">
          <?php foreach ($teachers as $t): ?>
            <div class="col-3">
              <div class="card cursor-pointer <?= $t['is_fully_scored'] ? 'bg-success text-white disabled' : '' ?>"
                onclick="<?= $t['is_fully_scored'] ? '' : 'handleDetail(' . $t['teacher_id'] . ')' ?>">
                <div class="card-body">
                  <?= $t['name'] ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 1000; text-align: center;">
        <form action="<?= site_url('/ahp/calculate') ?>" method="post">
          <?= csrf_field() ?>
          <button type="submit" class="btn btn-primary" <?= !$can_process_ahp ? 'disabled' : '' ?>>
            Calculate AHP
          </button>
          <?php if (!$can_process_ahp): ?>
            <small class="d-block mt-1 text-danger">
              * You must complete all pairwise comparisons and ensure all teachers are fully scored before calculating AHP.
            </small>
          <?php endif; ?>
        </form>
      </div>

    </div>
  <?php endif; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  function handleDetail(teacherId) {
    window.location.href = `/performance-assesment/${teacherId}`
  }
</script>
<?= $this->endSection() ?>