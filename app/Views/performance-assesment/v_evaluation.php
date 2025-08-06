<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-0">
  <h4 class="text-white">Penilaian Guru</h4>
</div>

<div class="mt-3">
  <?php if (empty($categories)): ?>
    <h1 class="text-center text-muted">Tidak ada data kriteria tersedia.</h1>
  <?php else: ?>
    <form action="<?= base_url('/performance-assesment/save') ?>" method="post">
      <input type="hidden" name="teacher_id" value="<?= esc($teacherId) ?>">

      <?php foreach ($categories as $category): ?>
        <div class="card mb-4">
          <div class="card-header bg-primary">
            <h5 class="mb-0 text-white"><?= esc($category['name']) ?></h5>
          </div>
          <div class="card-body">
            <?php foreach ($category['subcategories'] as $sub): ?>
              <h6 class="text-muted"><?= esc($sub['name']) ?></h6>
              <ul class="list-group mb-3">
                <?php foreach ($sub['questions'] as $q): ?>
                  <li class="list-group-item">
                    <div class="mb-2"><?= esc($q['question_text']) ?></div>
                    <?php if ($q['scoring_type'] === 'scale_1_3'): ?>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="scores[<?= $q['question_id'] ?>]" value="1" required>
                        <label class="form-check-label">1 - Tidak Sesuai</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="scores[<?= $q['question_id'] ?>]" value="2">
                        <label class="form-check-label">2 - Sesuai Sebagian</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="scores[<?= $q['question_id'] ?>]" value="3">
                        <label class="form-check-label">3 - Sesuai Seluruhnya</label>
                      </div>
                    <?php elseif ($q['scoring_type'] === 'boolean'): ?>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="scores[<?= $q['question_id'] ?>]" value="1" required>
                        <label class="form-check-label">Ya</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="scores[<?= $q['question_id'] ?>]" value="0">
                        <label class="form-check-label">Tidak</label>
                      </div>
                    <?php endif; ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="text-end">
        <button type="submit" class="btn btn-success">Save Evaluation</button>
      </div>
    </form>
  <?php endif; ?>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  const segments = window.location.pathname.split('/');
  const teacherId = segments[2];
  console.log("Teacher ID:", teacherId);
</script>
<?= $this->endSection() ?>