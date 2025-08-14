<?= $this->extend('layouts/l_auth.php') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-center align-items-center" style="height: 80vh">
  <div class="card shadow-lg">
    <div class="card-body">
      <div class="d-flex flex-column align-items-center justify-content-center">
        <img src="<?php echo base_url(); ?>/assets/img/logo.png" width="100" height="150" />
        <h1 class="ms-1 font-weight-bolder">SDS Mustika<span style="color: #A0937D">.</span></h1>
      </div>

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