<?= $this->extend('layouts/l_dashboard.php') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
  <h1 class="text-center text-white mt-8">Welcome, <?= session()->get('name') ?>.</h1>
</div>
<?= $this->endSection() ?>