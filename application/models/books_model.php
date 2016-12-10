<?php

class Books_model extends CI_Model
{
  public function getAllBooks()
  {
    $query = $this->db->query("SELECT title FROM books");

    foreach ($query->result() as $row)
    {
      return $row->title;
    }

  }

  public function searchBook($id)
  {

  }

  public function insertBook($title = '', $author = '', $releaseDate = '', $keywords = '')
  {
  }

  public function updateBook($title = '', $author = '', $releaseDate = '', $keywords = '')
  {

  }

  public function deleteBook($id)
  {

  }

}

?>
