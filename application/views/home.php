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
  <div id="book_library" class="page active_page">
    <div class="row">
      <div class="bl-addbook-container col s12 m4 l3">
        <form class="bl-addbook-form modal" id="add_book" action="#">
          <div class="file-field input-field">
            <div class="btn bl-btn bl-main-color-btn col s12">
              <span> Cover Image </span>
              <input class="bl-avoid-formadata" id="coverImage" type="file" accept="image/*"/>
            </div>
            <div class="bl-file-name-input">
              <input class="bl-input bl-input-main-color file-path validate bl-avoid-formadata" id="coverImagePath"
                     type="text">
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
          <button class="bl-addbook-form-btn bl-btn bl-main-color-btn btn waves-effect waves-light" id="add">Add
          </button>

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
    <div class="bl-addbook-uploading-spinner bl-hidden" id="uploading_spinner">
      <img src="/dist/images/spinner.gif" alt="Wait, please!" title="Wait until image is uploaded, please!">
    </div>
  </div>
  <div id="book_profile" class="page row"></div>
</main>
<script id="bookTemplate" type="text/template">
  <div class="bl-book card">
    <img class="bl-book-image" src="<%= coverImage || 'dist/images/no-cover-pic.jpg' %>" title="<%= title %>"
         alt="<%= title %> cover image"/>
    <ul class="bl-book-desc">
      <li class="bl-book-title" data-book-id="<%= id %>"><a href="#/book/<%= id %>"> <%= title %> </a></li>
      <li class="bl-book-author"><%= author %></li>
    </ul>
    <button class="bl-btn bl-second-color-btn delete">Delete</button>
  </div>
</script>
<script id="bookProfileTemplate" type="text/template">
  <div class="bl-book bl-book-profile card">
    <div class="row">
      <div class="col s12">
        <img class="bl-book-image" src="<%= coverImage || 'dist/images/no-cover-pic.jpg' %>" title="<%= title %>"
             alt="<%= title %> cover image"/>
      </div>
      <div class="col s12">
        <ul class="bl-book-desc">
          <li class="bl-book-title" data-book-id="<%= id %>"><%= title %></li>
          <li class="bl-book-author"><%= author %></li>
        </ul>
      </div>
    </div>
  </div>
</script>
<script src="<?php echo VENDORSPATH; ?>jquery/dist/jquery.min.js"></script>
<script src="<?php echo VENDORSPATH; ?>underscore/underscore-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.3.3/backbone-min.js"></script>
<script src="<?php echo VENDORSPATH; ?>materialize/dist/js/materialize.js"></script>
<script src="<?php echo JSPATH; ?>router/router.js"></script>
<script src="<?php echo JSPATH; ?>models/book.js"></script>
<script src="<?php echo JSPATH; ?>collections/library.js"></script>
<script src="<?php echo JSPATH; ?>views/book.js"></script>
<script src="<?php echo JSPATH; ?>views/library.js"></script>
<script src="<?php echo JSPATH; ?>views/bookprofile.js"></script>
<script src="<?php echo JSPATH; ?>app.js"></script>
</body>
</html>
