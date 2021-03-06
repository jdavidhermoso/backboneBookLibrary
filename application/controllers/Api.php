<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model("Books_model");
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
      case 'delete':
        $this->removeBook();
        break;
    }
  }

  private function searchBooks()
  {
    $id = $this->uri->segment(3);
    $result = $this->Books_model->getBooks($id);
    echo json_encode($result);
  }

  private function addBook()
  {
    $post_params = $this->get_post();
    $title = $post_params['title'];
    $author = $post_params['author'];
    $coverImage = $post_params['coverImage'];

    $this->Books_model->insertBook($title, $author, $coverImage);

    $response = array('status' => 'OK');

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
      ->_display();
    exit;
  }


  private function removeBook()
  {
    $id = $this->uri->segment(3);
    echo $this->Books_model->deleteBook($id);
  }

  private function getRequestType()
  {
    return strtolower($this->input->server('REQUEST_METHOD'));
  }

  private function get_post() {
    $rest_json = file_get_contents("php://input");
    return json_decode($rest_json, true);
  }
}
