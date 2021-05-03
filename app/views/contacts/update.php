<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/contacts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<div class="card card-body bg-light mt-5">
  <h2>Update Contact</h2>

  <form action="<?php echo URLROOT; ?>/contacts/update/<?php echo $data['id']; ?>" method="post">
    <div class="form-group">
      <label for="title">Name: <sup>*</sup></label>
      <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
      <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
    </div>

   
    <div class="form-group">
      <label for="title">Phone: <sup>*</sup></label>
      <input type="number" name="phone" class="form-control form-control-lg <?php echo (!empty($data['phone_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
      <span class="invalid-feedback"><?php echo $data['phone_err']; ?></span>
    </div>


    <div class="form-group">
      <label for="title">email: <sup>*</sup></label>
      <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
      <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
    </div>

    <div class="form-group">
      <label for="body">Adress: <sup>*</sup></label>
      <textarea name="adress" class="form-control form-control-lg <?php echo (!empty($data['adress_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['adress']; ?></textarea>
      <span class="invalid-feedback"><?php echo $data['adress_err']; ?></span>
    </div>

    <input type="submit" class="btn btn-success" value="Submit">
  </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>