var app = app || {};
app.Library = Backbone.Collection.extend({
  model: app.Book,
  url: 'index.php/api/books'
});
