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
        $this->removeBook();
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
    echo var_dump($_POST);
    $this->books_model->insertBook();
  }

  private function updateBook()
  {
    echo 'update';
  }

  private function removeBook()
  {
    $id = $this->uri->segment(3);
    echo $this->books_model->deleteBook($id);
  }

  private function getRequestType()
  {
    return strtolower($this->input->server('REQUEST_METHOD'));
  }
}
