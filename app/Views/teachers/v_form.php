<?= $this->extend('layouts/l_dashboard') ?>
<?= $this->section('content') ?>
<div class="container-fluid card">
  <div class="card-header pb-0">
    <h4><?= isset($teacher) ? 'Edit Teacher' : 'Add Teacher' ?></h4>
  </div>

  <div class="card-body">
    <form action="<?= site_url('teachers/save') ?>" method="post" enctype="multipart/form-data">
      <input type="hidden" name="teacher_id" value="<?= isset($teacher) ? $teacher['teacher_id'] : '' ?>">
      <input type="hidden" name="role" value="guru">

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="name">Name</label>
          <input type="text" class="form-control" name="name" id="name" required
            value="<?= old('name', $teacher['name'] ?? '') ?>" placeholder="Enter full name">
        </div>

        <div class="col-md-6 mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" required
            value="<?= old('email', $teacher['email'] ?? '') ?>" placeholder="Enter email address">
        </div>

        <?php if (!isset($teacher)): ?>
          <div class="col-md-6 mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" required
              placeholder="Enter password">
          </div>
        <?php endif; ?>

        <div class="col-md-6 mb-3">
          <label for="education">Education</label>
          <input type="text" class="form-control" name="education" id="education" required
            value="<?= old('education', $teacher['education'] ?? '') ?>" placeholder="Enter last education">
        </div>

        <div class="col-md-6 mb-3">
          <label for="major">Major</label>
          <input type="text" class="form-control" name="major" id="major" required
            value="<?= old('major', $teacher['major'] ?? '') ?>" placeholder="Enter major/field of study">
        </div>

        <div class="col-md-6 mb-3">
          <label for="institution">Institution</label>
          <input type="text" class="form-control" name="institution" id="institution" required
            value="<?= old('institution', $teacher['institution'] ?? '') ?>" placeholder="Enter institution/university">
        </div>

        <div class="col-md-6 mb-3">
          <label for="gender">Gender</label>
          <select class="form-control" name="gender" id="gender" required>
            <option value="">-- Select Gender --</option>
            <option value="Laki-laki" <?= (old('gender', $teacher['gender'] ?? '') == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="Perempuan" <?= (old('gender', $teacher['gender'] ?? '') == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
          </select>
        </div>

        <div class="col-md-6 mb-3">
          <label for="phone_number">Phone Number</label>
          <input type="text" class="form-control" name="phone_number" id="phone_number"
            value="<?= old('phone_number', $teacher['phone_number'] ?? '') ?>" placeholder="Enter phone number">
        </div>


        <div class="col-md-6 mb-3">
          <label for="birth_place">Birth Place</label>
          <input type="text" class="form-control" name="birth_place" id="birth_place"
            value="<?= old('birth_place', $teacher['birth_place'] ?? '') ?>" placeholder="Enter place of birth">
        </div>

        <div class="col-md-6 mb-3">
          <label for="birth_date">Birth Date</label>
          <input type="date" class="form-control" name="birth_date" id="birth_date"
            value="<?= old('birth_date', $teacher['birth_date'] ?? '') ?>">
        </div>

        <div class="col-md-12 mb-3">
          <label for="address">Address</label>
          <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter full address"><?= old('address', $teacher['address'] ?? '') ?></textarea>
        </div>

        <div class="col-md-6 mb-3">
          <label for="photo">Photo</label>
          <input type="file" class="form-control" name="photo" id="photo">
        </div>

        <div class="col-md-6 mb-3">
          <label for="gender">Status</label>
          <select class="form-control" name="status" id="status" required>
            <option value="">-- Select status --</option>
            <option value="active" <?= (old('status', $teacher['status'] ?? '') == 'active') ? 'selected' : '' ?>>Active</option>
            <option value="inactive" <?= (old('status', $teacher['status'] ?? '') == 'inactive') ? 'selected' : '' ?>>Inactive</option>
            <option value="on_leave" <?= (old('status', $teacher['status'] ?? '') == 'on_leave') ? 'selected' : '' ?>>on Leave</option>
          </select>
        </div>

        <div class="col-md-6 mb-3 mt-4">
          <?php if (!empty($teacher['photo'])): ?>
            <img src="<?= base_url(esc($teacher['photo'])) ?>" alt="image" width="200" height="auto" style="border-radius: 10px">
          <?php else: ?>
            <p>-</p>
          <?php endif; ?>
        </div>


        <div class="col-12 mt-4">
          <a href="<?= base_url('/teachers') ?>" class="btn btn-secondary">Cancel</a>
          <button type="submit" class="btn btn-primary"><?= isset($teacher) ? 'Update' : 'Save' ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>