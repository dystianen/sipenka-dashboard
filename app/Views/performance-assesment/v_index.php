<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-0">
  <h4 class="text-white">Teachers</h4>
</div>

<div class="mt-3">
  <?php if (empty($teachers)): ?>
    <h1 class="text-center text-muted">No teachers data available.</h1>
  <?php else: ?>
    <div class="d-flex">
      <div class="container-fluid px-0">
        <div class="row g-2">
          <?php foreach ($teachers as $t): ?>
            <div class="col-3">
              <div class="card cursor-pointer" onclick="handleDetail(<?= $t['teacher_id'] ?>)">
                <div class="card-body">
                  <?= $t['name'] ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
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