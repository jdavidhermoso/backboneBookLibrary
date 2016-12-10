<?php

class Books_model extends CI_Model
{
  public function getBooks($id = '')
  {
    $where = '';
    $limit = '';
    $booksArr = [];
    $book = [];
    $keyWordsArr = [];

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
      $keyWordsArr = explode(',', $row->keywords);
      $book['keywords'] = array_map('trim', $keyWordsArr);

      array_push($booksArr,$book);

      unset($book);
    }

    return $booksArr;
  }

  public function insertBook($title = '', $author = '', $releaseDate = '', $keywords = '')
  {
    $booksQuery = $this->db->query("INSERT INTO `books` (`title`, `author`, `releaseDate`, `keywords`) VALUES ('skdafsda', 'asdkfjadsf', '20100101', 'dfmasdfsda')");

    echo 'aa';
    die();


  }

  public function updateBook($title = '', $author = '', $releaseDate = '', $keywords = '')
  {

  }

  public function deleteBook($id)
  {

  }

}

?>
