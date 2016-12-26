var app = app || {};
app.Book = Backbone.Model.extend({
  defaults: {
    coverImage: '',
    title: '',
    author: ''
  }
});
