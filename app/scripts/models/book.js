var app = app || {};
app.Book = Backbone.Model.extend({
  defaults: {
    coverImage: 'dist/images/no-cover-pic.jpg',
    title: '',
    author: ''
  }
});
