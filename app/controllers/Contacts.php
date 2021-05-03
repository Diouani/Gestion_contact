<?php
class Contacts extends Controller
{
  public function __construct()
  {
    if (!isLoggedIn()) {
      redirect('users/login');
    }

    $this->contactModel = $this->model('Contact');
    $this->userModel = $this->model('User');
  }

  public function index()
  {
    // Get posts
    $contacts = $this->contactModel->getContacts();

    if ($contacts < 1) {
      $data = [
        'no_contact' => 'no'

      ];
    } else {
      $data = [
        'contacts' => $contacts
      ];
    }



    $this->view('contacts/index', $data);
  }

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {



      $data = [
        'name' => trim($_POST['name']),
        'phone' => trim($_POST['phone']),
        'email' => trim($_POST['email']),
        'adress' => trim($_POST['adress']),
        'user_id' => $_SESSION['user_id'],
        'name_err' => '',
        'phone_err' => '',
        'email_err' => '',
        'adress_err' => ''
      ];


      if (empty($data['name'])) {
        $data['name_err'] = 'Please enter a name';
      }
      if (empty($data['phone'])) {
        $data['phone_err'] = 'Please enter a valid phone number';
      }
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter a valid email';
      }
      if (empty($data['adress'])) {
        $data['adress_err'] = 'Please enter an adress';
      }




      if (empty($data['name_err']) && empty($data['email_err']) && empty($data['phone_err']) && empty($data['adress_err'])) {

        if ($this->contactModel->addContact($data)) {

          $this->view('contacts/index');
        } else {
          die('ERROR 404');
        }
      } else {
        // Load view with errors
        $this->view('contacts/add', $data);
      }
    } else {
      $data = [
        'name' => '',
        'phone' => '',
        'email' => '',
        'adress' => ''
      ];

      $this->view('contacts/add', $data);
    }
  }

  public function update($id)
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


      $data = [
        'id' => $id,
        'name' => trim($_POST['name']),
        'phone' => trim($_POST['phone']),
        'email' => trim($_POST['email']),
        'adress' => trim($_POST['adress']),
        'name_err' => '',
        'phone_err' => '',
        'email_err' => '',
        'adress_err' => ''
      ];

      if (empty($data['name'])) {
        $data['name_err'] = 'Please enter a name';
      }
      if (empty($data['phone'])) {
        $data['phone_err'] = 'Please enter a valid phone number';
      }
      if (empty($data['email'])) {
        $data['email_err'] = 'Please enter a valid email';
      }
      if (empty($data['adress'])) {
        $data['adress_err'] = 'Please enter an adress';
      }


      if (empty($data['name_err']) && empty($data['email_err']) && empty($data['phone_err']) && empty($data['adress_err'])) {

        // Validation
        if ($this->contactModel->updateContact($data)) {
          redirect('contacts');
        } else {
          die('ERROR 404');
        }
      } else {
        // Load view with errors
        $this->view('contacts/update', $data);
      }
    } else {
      // fetch for contact if no submit 
      $contact = $this->contactModel->getContactById($id);

      // Check for owner
      if ($contact->user_id != $_SESSION['user_id']) {
        redirect('contacts');
      }

      $data = [
        'id' => $id,
        'name' => $contact->name,
        'phone' => $contact->phone,
        'email' => $contact->email,
        'adress' => $contact->adress
      ];

      $this->view('contacts/update', $data);
    }
  }

  // public function show($id)
  // {
  //   $contact = $this->contactModel->getContactById($id);
  //   $user = $this->userModel->getUserById($contact->user_id);

  //   $data = [
  //     'contact' => $contact,
  //     'user' => $user
  //   ];

  //   $this->view('contacts/show', $data);
  // }

  public function delete($id)
  {

    // Get existing post from model
    $contact = $this->contactModel->getContactById($id);
    if ($contact->user_id != $_SESSION['user_id']) {
      redirect('contacts');
    } else {
      // Check for owner
      if ($contact->user_id != $_SESSION['user_id']) {
        redirect('contacts');
      }

      if ($this->contactModel->deleteContact($id)) {

        redirect('contacts');
      } else {
        die('ERROR 404');
      }
    }
  }
}
