<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Backbone.js Library</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="<?php echo CSSPATH; ?>main.css">
  <link rel="stylesheet" href="<?php echo VENDORSPATH; ?>materialize/dist/css/materialize.min.css">
</head>
<body>
<header>
  <h1 class="center-align">
    Book library
  </h1>
</header>
<main class="bl-main-container">
  <div id="book_library">
    <div class="row">
      <div class="bl-addbook-container col s12 m3 l3">
        <form class="bl-addbook-form" id="add_book" action="#">
          <div class="file-field input-field">
            <div class="btn col s12">
              <span> Cover Image </span>
              <input id="coverImage" type="file"/>
            </div>
            <div class="bl-file-name-input">
              <input class="file-path validate" type="text">
            </div>
          </div>
          <div class="input-field">
            <label for="title">Title: </label>
            <input id="title" type="text"/>
          </div>
          <div class="input-field">
            <label for="author">Author: </label>
            <input id="author" type="text"/>
          </div>
          <div class="input-field">
            <label for="releaseDate">Release date: </label>
            <input id="releaseDate" type="text"/>
          </div>
          <div class="input-field">
            <label for="keywords">Keywords: </label>
            <input id="keywords" type="text"/>
          </div>
          <button class="btn waves-effect waves-light" id="add">Add</button>
        </form>
      </div>
      <div class="bl-book-gallery-container col s12 m9 l9">
        <div class="bl-book-gallery-innner" id="book_gallery">

        </div>
      </div>

    </div>

  </div>
</main>
<script id="bookTemplate" type="text/template">
  <div class="bl-book card">
    <img class="bl-book-image" src="<%= coverImage %>" title="<%= title %>" alt="<%= title %> cover image" />
    <ul class="bl-book-desc">
      <li><%= title %></li>
      <li><%= author %></li>
      <li><%= releaseDate %></li>
      <li>
        <%
        _.each( keywords, function( keyobj ) {
        %>
        <span><%= keyobj %></span>
        <%
        } );
        %>
      </li>
    </ul>
    <button class="delete">Delete</button>
  </div>
</script>

<script src="<?php echo VENDORSPATH; ?>jquery/dist/jquery.min.js"></script>
<script src="<?php echo VENDORSPATH; ?>underscore/underscore-min.js"></script>
<script src="<?php echo VENDORSPATH; ?>backbone/backbone-min.js"></script>
<script src="<?php echo VENDORSPATH; ?>materialize/dist/js/materialize.min.js"></script>
<script src="<?php echo JSPATH; ?>models/book.js"></script>
<script src="<?php echo JSPATH; ?>collections/library.js"></script>
<script src="<?php echo JSPATH; ?>views/book.js"></script>
<script src="<?php echo JSPATH; ?>views/library.js"></script>
<script src="<?php echo JSPATH; ?>app.js"></script>
</body>
</html>
