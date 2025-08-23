<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generate PDF</title>

</head>

<body>
  <div class="card-header mb-2 pb-0">
    <h3>Teachers Rank</h3>
    <p>Periode: <?= esc($periodName) ?></p>
  </div>

  <table border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 5px; text-align:center">
    <thead>
      <tr bgcolor=silver align=center>
        <th>Ranking</th>
        <th>Nama Guru</th>
        <th>Normalized Score</th>
        <th>Category</th>
        <th>Final Score</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($evaluations as $e): ?>
        <tr>
          <td><?= esc($e['rank']) ?></td>
          <td><?= esc($e['teacher_name']) ?></td>
          <td class="text-warning"><?= esc($e['normalized_score']) ?></td>
          <td class="text-warning"><?= esc($e['category']) ?></td>
          <td class="text-warning"><?= esc(number_format($e['final_score'], 4)) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <p>Jumlah data : <?= esc($totalData) ?></p>
</body>

</html>