<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model("books_model");
  }

  public function index()
  {

  }

  public function books()
  {
    switch ($this->getRequestType()) {
      case 'get':
        $this->searchBooks();
        break;
      case 'post':
        $this->addBook();
        break;
      case 'put':
        $this->updateBook();
        break;
      case 'delete':
        $this->deleteBook();
        break;
    }
  }

  private function searchBooks()
  {
    $id = $this->uri->segment(3);
    $result = $this->books_model->getBooks($id);
    echo json_encode($result);
  }

  private function addBook()
  {
    $this->books_model->insertBook();
  }

  private function updateBook()
  {
    echo 'update';
  }

  private function deleteBook()
  {
    echo 'delete';
  }

  private function getRequestType()
  {
    return strtolower($this->input->server('REQUEST_METHOD'));
  }
}
