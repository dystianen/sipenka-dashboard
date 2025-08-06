<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4><?= isset($criteria) ? 'Edit' : 'Add' ?> Question Category</h4>
  </div>
  <div class="card-body">
    <form action="<?= site_url('/criteria/save') ?>" method="post">
      <?= csrf_field() ?>
      <?php if (isset($criteria['category_id'])): ?>
        <input type="hidden" name="category_id" value="<?= esc($criteria['category_id']) ?>">
      <?php endif; ?>

      <div class="mb-3">
        <label>Category Name</label>
        <input type="text" name="name" class="form-control" required
          value="<?= esc($criteria['name'] ?? '') ?>">
      </div>
      <div class="mb-3">
        <label>Category Description</label>
        <input type="text" name="description" class="form-control"
          value="<?= esc($criteria['description'] ?? '') ?>">
      </div>

      <a href="<?= base_url('/criteria') ?>" class="btn btn-secondary">Back</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>