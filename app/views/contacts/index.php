<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row mb-3">
  <div class="col-md-6">
    <h1>Contacts</h1>
  </div>
  <div class="col-md-6">
    <a href="<?php echo URLROOT; ?>/contacts/add" class="btn btn-primary pull-right">
      <i class="fa fa-pencil"></i> Add Contact
    </a>
  </div>
</div>

<?php
if (isset($data['no_contact'])) {

  echo "<h1>Pas de contact</h1>";
} else {


  foreach ($data['contacts'] as $contact) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $contact->name; ?></h4>

      <p class="card-text"><?php echo $contact->phone; ?></p>
      <p class="card-text"><?php echo $contact->email; ?></p>
      <p class="card-text"><?php echo $contact->adress; ?></p>
      <a href="<?php echo URLROOT; ?>/contacts/update/<?php echo $contact->id; ?>" class="btn btn-dark">Update</a>
      <a href="<?php echo URLROOT; ?>/contacts/delete/<?php echo $contact->id; ?>" class="btn btn-warning">Delete</a>
    </div>
<?php endforeach;
} ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>