<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>

<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4>Add Question Categories & Questions</h4>
  </div>
  <div class="card-body">
    <form action="<?= site_url('/criteria/save') ?>" method="post">
      <?= csrf_field() ?>

      <div id="category-container">
        <!-- Category Group Start -->
        <div class="category-group mb-4 border p-3 rounded">
          <div class="mb-3">
            <label>Category Name</label>
            <input type="text" name="categories[0][name]" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Category Description</label>
            <input type="text" name="categories[0][description]" class="form-control">
          </div>

          <div class="subcategory-container"></div>
          <button type="button" class="btn btn-sm btn-primary add-subcategory mt-3">+ Add Subcategory</button>
        </div>
        <!-- End Category Group -->
      </div>

      <button type="button" class="btn btn-info" id="add-category">+ Add Category</button>
      <hr>
      <button type="submit" class="btn btn-primary">Save All</button>
    </form>
  </div>
</div>

<script>
  let categoryIndex = 0;

  document.getElementById('add-category').addEventListener('click', function() {
    categoryIndex++;
    const categoryTemplate = document.querySelector('.category-group').cloneNode(true);
    categoryTemplate.querySelectorAll('input').forEach(input => input.value = '');
    categoryTemplate.querySelector('.subcategory-container').innerHTML = '';
    updateInputNames(categoryTemplate, categoryIndex);
    document.getElementById('category-container').appendChild(categoryTemplate);
  });

  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('add-subcategory')) {
      const categoryGroup = e.target.closest('.category-group');
      const subContainer = categoryGroup.querySelector('.subcategory-container');
      const subIndex = subContainer.querySelectorAll('.subcategory-group').length;
      const catIndex = getCategoryIndex(categoryGroup);

      const subGroup = document.createElement('div');
      subGroup.classList.add('subcategory-group', 'border', 'rounded', 'p-3', 'mt-3');

      subGroup.innerHTML = `
        <div class="mb-3">
          <label>Subcategory Name</label>
          <input type="text" name="categories[${catIndex}][subcategories][${subIndex}][name]" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Subcategory Description</label>
          <input type="text" name="categories[${catIndex}][subcategories][${subIndex}][description]" class="form-control">
        </div>

        <div class="question-container"></div>
        <button type="button" class="btn btn-sm btn-success add-question">+ Add Question</button>
      `;

      subContainer.appendChild(subGroup);
    }

    if (e.target.classList.contains('add-question')) {
      const subGroup = e.target.closest('.subcategory-group');
      const questionContainer = subGroup.querySelector('.question-container');
      const qIndex = questionContainer.querySelectorAll('.question-group').length;
      const catIndex = getCategoryIndex(subGroup.closest('.category-group'));
      const subIndex = getSubcategoryIndex(subGroup);

      const questionGroup = document.createElement('div');
      questionGroup.classList.add('question-group', 'border', 'rounded', 'p-3', 'mb-3');

      questionGroup.innerHTML = `
        <div class="mb-2">
          <label>Question Text</label>
          <input type="text" name="categories[${catIndex}][subcategories][${subIndex}][questions][${qIndex}][text]" class="form-control" required>
        </div>
        <div class="mb-2">
          <label>Scoring Type</label>
          <select name="categories[${catIndex}][subcategories][${subIndex}][questions][${qIndex}][scoring_type]" class="form-control" required>
            <option value="">-- Select Type --</option>
            <option value="scale_1_3">Scale 1–3</option>
            <option value="1_0">Yes / No (1 = Yes, 0 = No)</option>
          </select>
        </div>
        <div class="mb-2">
          <label>Weight</label>
          <input type="number" name="categories[${catIndex}][subcategories][${subIndex}][questions][${qIndex}][weight]" class="form-control" value="1" min="1" required>
        </div>
      `;

      questionContainer.appendChild(questionGroup);
    }
  });

  function updateInputNames(categoryGroup, catIndex) {
    categoryGroup.querySelectorAll('input').forEach(input => {
      if (input.name.includes('[name]')) {
        input.name = `categories[${catIndex}][name]`;
      } else if (input.name.includes('[description]')) {
        input.name = `categories[${catIndex}][description]`;
      }
    });
  }

  function getCategoryIndex(categoryGroup) {
    const input = categoryGroup.querySelector('input[name^="categories["]');
    const match = input.name.match(/categories\[(\d+)\]/);
    return match ? match[1] : 0;
  }

  function getSubcategoryIndex(subGroup) {
    const input = subGroup.querySelector('input[name*="[subcategories]"]');
    const match = input.name.match(/subcategories\[(\d+)\]/);
    return match ? match[1] : 0;
  }
</script>

<?= $this->endSection() ?>