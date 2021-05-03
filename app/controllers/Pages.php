<?php
class Pages extends Controller
{
  public function __construct()
  {
  }

  public function index()
  {
    if (isLoggedIn()) {
      redirect('contacts');
    }

    $data = [
      'title' => 'Test',
      'description' => 'test'
    ];

    $this->view('pages/index', $data);
  }

  public function about()
  {
    if (isLoggedIn()) {
      redirect('contacts');
    }
    $data = [
      'title' => 'About Us',
      'description' => 'TEST'
    ];

    $this->view('pages/about', $data);
  }
}
