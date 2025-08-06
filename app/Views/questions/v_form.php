<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4><?= isset($question) ? 'Edit' : 'Create' ?> Question</h4>
  </div>
  <div class="card-body">
    <form action="<?= site_url('/questions/save') ?>" method="post">
      <?= csrf_field() ?>

      <?php if (isset($question['question_id'])): ?>
        <input type="hidden" name="question_id" value="<?= esc($question['question_id']) ?>">
      <?php endif; ?>

      <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
          <option value="">-- Select Category --</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category['category_id'] ?>"
              <?= old('category_id', $question['category_id'] ?? '') == $category['category_id'] ? 'selected' : '' ?>>
              <?= esc($category['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="subcategory_id" class="form-label">Subcategory</label>
        <select class="form-select" id="subcategory_id" name="subcategory_id" required>
          <option value="">-- Select Subcategory --</option>
          <?php foreach ($subcategories as $s): ?>
            <option value="<?= $s['subcategory_id'] ?>"
              <?= old('subcategory_id', $question['subcategory_id'] ?? '') == $s['subcategory_id'] ? 'selected' : '' ?>>
              <?= esc($s['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="question_text" class="form-label">Question Text</label>
        <input type="text" class="form-control" id="question_text" name="question_text" value="<?= old('question_text', $question['question_text'] ?? '') ?>" required>
      </div>

      <div class="mb-3">
        <label for="scoring_type" class="form-label">Scoring Type</label>
        <select class="form-select" id="scoring_type" name="scoring_type" required>
          <option value="">-- Choose Scoring Type --</option>
          <option value="scale_1_3" <?= old('scoring_type', $question['scoring_type'] ?? '') === 'scale_1_3' ? 'selected' : '' ?>>
            Scale 1–3
          </option>
          <option value="boolean" <?= old('scoring_type', $question['scoring_type'] ?? '') === 'boolean' ? 'selected' : '' ?>>
            Yes / No (Boolean)
          </option>
        </select>
      </div>

      <div class="mb-3">
        <label for="weight" class="form-label">Weight</label>
        <input type="number" class="form-control" id="weight" name="weight" value="<?= old('weight', $question['weight'] ?? '') ?>" required>
      </div>

      <a href="<?= base_url('/questions') ?>" class="btn btn-secondary">Back</a>
      <button type="submit" class="btn btn-primary"><?= isset($question) ? 'Update' : 'Create' ?></button>
    </form>
  </div>
</div>

<script>
  document.getElementById('category_id').addEventListener('change', function() {
    const categoryId = this.value;
    const subcategorySelect = document.getElementById('subcategory_id');

    // Kosongkan dulu
    subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';

    if (!categoryId) return;

    fetch(`/question-subcategories/by-category/${categoryId}`)
      .then(response => response.json())
      .then(data => {
        data.forEach(sub => {
          const option = document.createElement('option');
          option.value = sub.subcategory_id;
          option.textContent = sub.name;
          subcategorySelect.appendChild(option);
        });
      })
      .catch(error => {
        console.error('Error loading subcategories:', error);
      });
  });
</script>

<?= $this->endSection() ?>