<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Backbone.js Library</title>
  <link rel="stylesheet" href="<?php echo CSSPATH; ?>main.css">
</head>
<body>

<div id="books">
  <form id="addBook" action="#">
    <div>
      <label for="coverImage">CoverImage: </label><input id="coverImage" type="file" />
      <label for="title">Title: </label><input id="title" type="text" />
      <label for="author">Author: </label><input id="author" type="text" />
      <label for="releaseDate">Release date: </label><input id="releaseDate" type="text" />
      <label for="keywords">Keywords: </label><input id="keywords" type="text" />
      <button id="add">Add</button>
    </div>
  </form>
</div>

<script id="bookTemplate" type="text/template">
  <img src="<%= coverImage %>"/>
  <ul>
    <li><%= title %></li>
    <li><%= author %></li>
    <li><%= releaseDate %></li>
    <li><%= keywords %></li>
  </ul>

  <button class="delete">Delete</button>
</script>

<script src="<?php echo VENDORSPATH; ?>jquery/dist/jquery.min.js"></script>
<script src="<?php echo VENDORSPATH; ?>underscore/underscore-min.js"></script>
<script src="<?php echo VENDORSPATH; ?>backbone/backbone-min.js"></script>
<script src="<?php echo JSPATH; ?>models/book.js"></script>
<script src="<?php echo JSPATH; ?>collections/library.js"></script>
<script src="<?php echo JSPATH; ?>views/book.js"></script>
<script src="<?php echo JSPATH; ?>views/library.js"></script>
<script src="<?php echo JSPATH; ?>app.js"></script>
</body>
</html>
