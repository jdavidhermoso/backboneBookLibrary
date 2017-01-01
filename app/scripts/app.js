var app = app || {};

$(function () {
  app.libraryCollection = new app.Library();
  app.library = new app.LibraryView();
  app.router = new app.BookLibraryRouter();
  Backbone.history.start();
});
