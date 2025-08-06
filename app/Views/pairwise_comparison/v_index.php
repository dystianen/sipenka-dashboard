<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('pairwise-comparison/save') ?>" method="post">
  <div class="container-fluid card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
      <h4>Pairwise Comparison</h4>

      <select name="period_id" class="form-select" required style="width: 200px;">
        <option value="">-- Periode --</option>
        <?php foreach ($periods as $index => $p): ?>
          <option value="<?= esc($p['period_id']) ?>"><?= esc($p['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="card-body">
      <table class="table table-responsive">
        <thead>
          <tr>
            <th style="width: 40%">Kriteria 1</th>
            <th style="width: 40%">Kriteria 2</th>
            <th style="width: 20%">Nilai</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pairs as $index => $pair): ?>
            <tr>
              <td><?= $pair['criteria1_name'] ?></td>
              <td><?= $pair['criteria2_name'] ?></td>
              <td>
                <select name="comparisons[<?= $index ?>][value]" class="form-select" required>
                  <option value="">-- Pilih --</option>
                  <option value="1">1 - Sama penting</option>
                  <option value="3">3 - Sedikit lebih penting</option>
                  <option value="5">5 - Cukup lebih penting</option>
                  <option value="7">7 - Lebih penting</option>
                  <option value="9">9 - Sangat penting</option>
                  <option value="1/3">1/3 - Lawannya 3</option>
                  <option value="1/5">1/5 - Lawannya 5</option>
                  <option value="1/7">1/7 - Lawannya 7</option>
                  <option value="1/9">1/9 - Lawannya 9</option>
                </select>
              </td>
              <input type="hidden" name="comparisons[<?= $index ?>][criteria1_id]" value="<?= $pair['criteria1_id'] ?>">
              <input type="hidden" name="comparisons[<?= $index ?>][criteria2_id]" value="<?= $pair['criteria2_id'] ?>">
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <button type="submit" class="btn btn-primary">Save Pairwise Comparison</button>
    </div>
  </div>
</form>
<?= $this->endSection() ?>