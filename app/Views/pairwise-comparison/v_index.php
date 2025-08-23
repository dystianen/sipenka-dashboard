<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>

<form action="<?= base_url('pairwise-comparison/save') ?>" method="post">
  <div class="container-fluid card">
    <div class="card-header pb-0 d-flex align-items-center justify-content-between">
      <h4>Pairwise Comparison</h4>

      <!-- onchange auto submit GET -->
      <select name="period_id" class="form-select" required style="width:200px;"
        onchange="window.location='?period_id='+this.value">
        <option value="">-- Periode --</option>
        <?php foreach ($periods as $p): ?>
          <option value="<?= esc($p['period_id']) ?>"
            <?= ($selectedPeriodId == $p['period_id'] ? 'selected' : '') ?>>
            <?= esc($p['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="card-body">
      <table class="table table-responsive">
        <thead>
          <tr>
            <th style="width:30%">Kriteria 1</th>
            <th style="width:30%">Nilai</th>
            <th style="width:40%">Kriteria 2</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pairs as $index => $pair): ?>
            <tr>
              <td><?= $pair['criteria1_name'] ?></td>
              <td>
                <select name="comparisons[<?= $index ?>][value]" class="form-select" required>
                  <option value="">-- Pilih --</option>
                  <option value="1" <?= ($pair['selected_value'] == 1 ? 'selected' : '') ?>>1 - Sama penting</option>
                  <option value="3" <?= ($pair['selected_value'] == 3 ? 'selected' : '') ?>>3 - Sedikit lebih penting</option>
                  <option value="5" <?= ($pair['selected_value'] == 5 ? 'selected' : '') ?>>5 - Cukup lebih penting</option>
                  <option value="7" <?= ($pair['selected_value'] == 7 ? 'selected' : '') ?>>7 - Lebih penting</option>
                  <option value="9" <?= ($pair['selected_value'] == 9 ? 'selected' : '') ?>>9 - Sangat penting</option>
                  <option value="0.3333" <?= ($pair['selected_value'] == 0.3333 ? 'selected' : '') ?>>1/3 - Lawannya 3</option>
                  <option value="0.2" <?= ($pair['selected_value'] == 0.2 ? 'selected' : '') ?>>1/5 - Lawannya 5</option>
                  <option value="0.1429" <?= ($pair['selected_value'] == 0.1429 ? 'selected' : '') ?>>1/7 - Lawannya 7</option>
                  <option value="0.1111" <?= ($pair['selected_value'] == 0.1111 ? 'selected' : '') ?>>1/9 - Lawannya 9</option>
                </select>
              </td>
              <td><?= $pair['criteria2_name'] ?></td>
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