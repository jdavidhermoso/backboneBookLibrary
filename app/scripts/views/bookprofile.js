var app = app || {};

app.BookProfileView = Backbone.View.extend({
  tagName: 'div',
  className: 'bl-book-container col s12 m6 l3',
  template: _.template( $( '#bookTemplate' ).html() ),
  initialize: function (options) {
    var bookProfileView;
    this.collection = app.libraryCollection;
    bookProfileView = this;
    this.bookId = options.bookId;
    app.libraryCollection.fetch({
      reset: true,
      success: function() {

        if (app.libraryCollection.length) {
          bookProfileView.model = app.libraryCollection.get(bookProfileView.bookId);
          this.$('#book_profile').append(bookProfileView.render().el);
        } else {
          app.router.navigateToHome();
        }
      },
      error: function() {
        app.router.navigateToHome();
      }
    });
  },
  render: function() {
    this.$el.html( this.template( this.model.attributes ) );
    return this;
  },
  showBookProfile: function() {
    $('#book_profile').addClass('active_page');
  },
  hideBookProfile: function() {
    $('#book_profile').removeClass('active_page');
  }

});
