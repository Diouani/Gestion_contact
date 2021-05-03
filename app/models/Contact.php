<?php
class Contact
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }


  public function getContacts()
  {
    $this->db->query('SELECT * FROM `contacts` WHERE `user_id`=:session_id');
    $this->db->bind(':session_id', $_SESSION['user_id']);

    $results = $this->db->resultSet();

    if ($this->db->rowCount() < 1) {

      return 0;
    } else {
      return $results;
    }
  }

  public function addContact($data)
  {
    $this->db->query('INSERT INTO `contacts`( `name`, `phone`, `email`, `adress`, `user_id`) VALUES (:name,:phone,:email,:adress,:session_id)');
    // Bind values
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':phone', $data['phone']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':adress', $data['adress']);
    $this->db->bind(':session_id', $_SESSION['user_id']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }


  public function updateContact($data)
  {
    $this->db->query('UPDATE `contacts` SET `name`= :name,`phone`= :phone,`email`= :email ,`adress`= :adress WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':phone', $data['phone']);
    $this->db->bind(':email', $data['email']);
    $this->db->bind(':adress', $data['adress']);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function getContactById($id)
  {
    $this->db->query('SELECT * FROM `contacts` WHERE id = :id');
    $this->db->bind(':id', $id);

    $row = $this->db->single();

    return $row;
  }

  public function deleteContact($id)
  {
    $this->db->query('DELETE FROM `contacts` WHERE id = :id');
    // Bind values
    $this->db->bind(':id', $id);

    // Execute
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}
