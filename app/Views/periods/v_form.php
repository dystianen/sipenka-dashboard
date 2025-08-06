<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4><?= isset($period) ? 'Edit' : 'Add' ?> Question Category</h4>
  </div>
  <div class="card-body">
    <form action="<?= site_url('/periods/save') ?>" method="post">
      <?= csrf_field() ?>
      <?php if (isset($period['period_id'])): ?>
        <input type="hidden" name="period_id" value="<?= esc($period['period_id']) ?>">
      <?php endif; ?>
      <div class="row">

        <div class="col-md-6 mb-3">
          <label>Name</label>
          <input type="text" name="name" class="form-control" required
            value="<?= esc($period['name'] ?? '') ?>">
        </div>

        <div class="col-md-6 mb-3">
          <label for="is_active" class="form-label">Active</label><br>
          <div class="form-check form-switch">
            <input type="checkbox"
              class="form-check-input"
              id="is_active"
              name="is_active"
              value="1"
              <?= old('is_active', $period['is_active'] ?? false) ? 'checked' : '' ?>>
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="start_date">Start Date</label>
          <input type="date" class="form-control" name="start_date" id="start_date"
            value="<?= old('start_date', $period['start_date'] ?? '') ?>">
        </div>

        <div class="col-md-6 mb-3">
          <label for="end_date">End Date</label>
          <input type="date" class="form-control" name="end_date" id="end_date"
            value="<?= old('end_date', $period['end_date'] ?? '') ?>">
        </div>
      </div>

      <a href="<?= base_url('/periods') ?>" class="btn btn-secondary">Back</a>
      <button type="submit" class="btn btn-primary"><?= isset($period) ? 'Update' : 'Create' ?></button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>