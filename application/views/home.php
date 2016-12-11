<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <title>Backbone.js Library</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo CSSPATH; ?>main.css">
  <link rel="stylesheet" href="<?php echo VENDORSPATH; ?>materialize/dist/css/materialize.css">
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
      <div class="bl-addbook-container col s12 m4 l3">
        <form class="bl-addbook-form modal" id="add_book" action="#">
          <div class="file-field input-field">
            <div class="btn bl-btn bl-main-color-btn col s12">
              <span> Cover Image </span>
              <input class="bl-avoid-formadata" id="coverImage" type="file"/>
            </div>
            <div class="bl-file-name-input">
              <input class="bl-input bl-input-main-color file-path validate bl-avoid-formadata" id="coverImagePath" type="text">
            </div>
          </div>
          <div class="input-field">
            <label for="title">Title: </label>
            <input class="bl-input bl-input-main-color" id="title" type="text"/>
          </div>
          <div class="input-field">
            <label for="author">Author: </label>
            <input class="bl-input bl-input-main-color" id="author" type="text"/>
          </div>

          <div class="input-field">
            <label for="keywords">Keywords: </label>
            <input class="bl-input bl-input-main-color" id="keywords" type="text"/>
          </div>
          <div class="bl-keywords-cloud" id="keywords_cloud">

          </div>
          <button class="bl-addbook-form-btn bl-btn bl-main-color-btn btn waves-effect waves-light" id="add">Add</button>
          <input class="bl-input bl-input-main-color bl-datepicker" id="releaseDate" type="date"/>
        </form>

      </div>
      <div class="bl-book-gallery-container col s12 m8 l9">
        <div class="bl-book-gallery-innner" id="book_gallery"></div>
      </div>
    </div>
    <div class="bl-addbook-float-btn" id="show_addbook_form">
      <button class="btn-floating bl-btn bl-main-color-btn btn-large waves-effect waves-light">
        <i class="material-icons">add</i>
      </button>
    </div>
  </div>
</main>
<script id="bookTemplate" type="text/template">
  <div class="bl-book card">
    <img class="bl-book-image" src="<%= coverImage %>" title="<%= title %>" alt="<%= title %> cover image" />
    <ul class="bl-book-desc">
      <li class="bl-book-title"><%= title %></li>
      <li class="bl-book-author"><%= author %></li>
      <li class="bl-book-release-date">
        <% if (releaseDate != 0) { %>
          <span class="bl-book-release-date"><%= releaseDate %></span>
        <% } %>
      </li>
      <li class="bl-book-keywords-container">
        <%
        _.each( keywords, function( keyobj ) {
        %>
        <span class="bl-book-keyword"><%= keyobj %></span>
        <%
        } );
        %>
      </li>
    </ul>
    <button class="bl-btn bl-second-color-btn delete">Delete</button>
  </div>
</script>
<script id="keywordTemplate" type="text/template">
  <span class="bl-keyword">
    <%= keyword %>
    <i class="material-icons">delete</i>
  </span>
</script>
<script src="<?php echo VENDORSPATH; ?>jquery/dist/jquery.min.js"></script>
<script src="<?php echo VENDORSPATH; ?>underscore/underscore-min.js"></script>
<script src="<?php echo VENDORSPATH; ?>backbone/backbone-min.js"></script>
<script src="<?php echo VENDORSPATH; ?>materialize/dist/js/materialize.js"></script>
<script src="<?php echo JSPATH; ?>models/book.js"></script>
<script src="<?php echo JSPATH; ?>collections/library.js"></script>
<script src="<?php echo JSPATH; ?>views/book.js"></script>
<script src="<?php echo JSPATH; ?>views/library.js"></script>
<script src="<?php echo JSPATH; ?>app.js"></script>
</body>
</html>
