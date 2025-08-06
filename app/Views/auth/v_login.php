<?= $this->extend('layouts/l_auth.php') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-center align-items-center" style="height: 80vh">
  <div class="card shadow-lg">
    <div class="card-body">
      <h1 class="ms-1 font-weight-bolder">SIPENKA<span style="color: #A0937D">.</span></h1>

      <p class="auth-subtitle mb-5">Log in with your data that the admin entered.</p>

      <form action="<?php echo base_url(); ?>login/store" method="post">
        <div class="form-group position-relative has-icon-left mb-4">
          <input name="email" type="text" class="form-control form-control-xl" placeholder="Email">
          <div class="form-control-icon">
            <i class="bi bi-person"></i>
          </div>
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
          <input name="password" type="password" class="form-control form-control-xl" placeholder="Password">
          <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-2 w-100 rounded-pill">Log in</button>
        </button>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>