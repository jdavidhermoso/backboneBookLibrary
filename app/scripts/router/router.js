var app = app || {};

app.BookLibraryRouter = Backbone.Router.extend({
  routes: {
    "" : "defaultRoute",
    "book/:id" : "getBookFile"
  },
  navigateToHome: function() {
    app.router.navigate('/');
  },
  defaultRoute: function() {
    app.library.showBookLibrary();
    if (app.bookProfile) {
      app.bookProfile.hideBookProfile();
    }
  },
  getBookFile: function(id) {
    app.library.hideBookLibrary();
    app.bookProfile = new app.BookProfileView({ bookId: id});
    app.bookProfile.showBookProfile();
  }
});
