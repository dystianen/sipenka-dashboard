<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4><?= isset($criteria) ? 'Edit' : 'Add' ?> Criteria</h4>
  </div>
  <div class="card-body">
    <form action="<?= site_url('/criteria/save') ?>" method="post">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= isset($criteria) ? $criteria['criteria_id'] : '' ?>">

      <div class="mb-3">
        <label for="code" class="form-label">Code</label>
        <input
          type="text"
          name="code"
          class="form-control"
          value="<?= isset($criteria) ? esc($criteria['code']) : '' ?>"
          required>
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
          type="text"
          name="name"
          class="form-control"
          value="<?= isset($criteria) ? esc($criteria['name']) : '' ?>"
          required>
      </div>

      <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <input
          type="text"
          name="type"
          class="form-control"
          value="<?= isset($criteria) ? esc($criteria['type']) : '' ?>"
          required>
      </div>

      <div class="mb-3">
        <label for="weight" class="form-label">Weight</label>
        <input
          type="text"
          name="weight"
          class="form-control"
          value="<?= isset($criteria) ? esc($criteria['weight']) : '' ?>"
          required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input
          type="text"
          name="description"
          class="form-control"
          value="<?= isset($criteria) ? esc($criteria['description']) : '' ?>"
          required>
      </div>

      <a href="<?= base_url('/criteria') ?>" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary"><?= isset($criteria) ? 'Update' : 'Save' ?></button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>