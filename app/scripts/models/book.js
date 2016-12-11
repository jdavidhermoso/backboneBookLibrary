var app = app || {};
app.Book = Backbone.Model.extend({
  defaults: {
    coverImage: 'dist/images/placeholder.png',
    title: 'No title',
    author: '',
    releaseDate: '',
    keywords: ''
  }
});
