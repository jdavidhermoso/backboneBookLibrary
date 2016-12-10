<?php

class Books_model extends CI_Model
{
  public function getBooks($id = '')
  {
    $where = '';
    $limit = '';
    $booksArr = [];
    $book = [];

    if ($id) {
      $where = 'WHERE id = '.$id;
      $limit = 'LIMIT 1';
    }

    $booksQuery = $this->db->query("SELECT id,title,author,releaseDate, keywords FROM books ".$where." ORDER BY id ".$limit);

    foreach ($booksQuery->result() as $row)
    {
      $book['title'] = $row->title;
      $book['author'] = $row->author;
      $book['releaseDate'] = $row->releaseDate;
      $book['keywords'] = $row->keywords;

      array_push($booksArr,$book);

      unset($book);
    }

    return $booksArr;
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
