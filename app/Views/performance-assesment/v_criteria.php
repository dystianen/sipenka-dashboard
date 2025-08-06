<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid px-0">
  <h4 class="text-white">Criterias</h4>
</div>

<div class="mt-3">
  <?php if (empty($criterias)): ?>
    <h1 class="text-center text-muted">No criteria data available.</h1>
  <?php else: ?>
    <div class="d-flex">
      <div class="container-fluid px-0">
        <div class="row g-2">
          <?php foreach ($criterias as $t): ?>
            <?php
            $isEvaluated = in_array($t['category_id'], $evaluatedCriterias ?? []);
            $cardClass = $isEvaluated ? 'bg-success text-white' : 'cursor-pointer';
            $clickAttr = $isEvaluated ? '' : "onclick=\"handleDetail({$t['category_id']})\"";
            ?>
            <div class="col-3">
              <div class="card <?= $cardClass ?>" <?= $clickAttr ?>>
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
  const segments = window.location.pathname.split('/');
  const teacherId = segments[2];

  function handleDetail(criteriaId) {
    window.location.href = `/performance-assesment/${teacherId}/${criteriaId}`
  }
</script>
<?= $this->endSection() ?>