<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4><?= isset($subcategory) ? 'Edit' : 'Create' ?> Question Subcategory</h4>
  </div>
  <div class="card-body">
    <form action="<?= site_url('/question-subcategories/save') ?>" method="post">
      <?= csrf_field() ?>

      <?php if (isset($subcategory['subcategory_id'])): ?>
        <input type="hidden" name="subcategory_id" value="<?= esc($subcategory['category_id']) ?>">
      <?php endif; ?>

      <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
          <option value="">-- Pilih Kategori --</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category['category_id'] ?>"
              <?= old('category_id', $subcategory['category_id'] ?? '') == $category['category_id'] ? 'selected' : '' ?>>
              <?= esc($category['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>


      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $subcategory['name'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $subcategory['description'] ?? '') ?></textarea>
      </div>

      <a href="<?= base_url('/question-subcategories') ?>" class="btn btn-secondary">Back</a>
      <button type="submit" class="btn btn-primary"><?= isset($subcategory) ? 'Update' : 'Create' ?></button>
    </form>
  </div>
</div>
<?= $this->endSection() ?>