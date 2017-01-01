var app = app || {};

app.LibraryView = Backbone.View.extend({
  el: '#book_library',
  events: {
    'click #add': 'addBook',
    'click #show_addbook_form': 'openAddBookForm',
    'change #coverImage': 'setCoverImage'
  },
  coverImage: '',
  initialize: function () {
    app.libraryCollection.fetch({reset: true});
    this.render();
    this.listenTo(app.libraryCollection, 'reset', this.render);
  },
  render: function () {
    this.$('#book_gallery').empty();
    $("#add_book").modal();
    app.libraryCollection.each(function (item) {
      this.renderBook(item);
    }, this);
  },
  renderBook: function (item) {
    var bookView = new app.BookView({
      model: item
    });


    this.$('#book_gallery').append(bookView.render().el);
  },
  addBook: function (e) {
    var formData = {},
      voidForm = true,
      new_model,
      view;
    e.preventDefault();


    $('#add_book input:not(".bl-avoid-formadata")').each(function (i, el) {
      if ($(el).val() !== '') {
        voidForm = false;
        formData[el.id] = $(el).val();
      }
    });
    if (this.coverImage) {
      formData['coverImage'] = this.coverImage;
    }
    if (!voidForm) {
      view = this;
      new_model = app.libraryCollection.create(formData, {
        success: function() {
          view.successAddedBook(view, new_model);
        },
        error: function() { view.errorAddingBook(view, new_model) },
      });
      this.toggleUploadingSpinner();
    } else {
      this.alertInvalidForm();
      return;
    }

    this.coverImage = '';
    if (this.isModalForm()) {
      this.closeAddBookForm();
    }
  },
  openAddBookForm: function () {
    $("#add_book").modal('open');
  },
  closeAddBookForm: function () {
    $("#add_book").modal('close');
  },
  successAddedBook: function (view) {
    Materialize.toast('Book added!', 3000);
    view.$('#add_book')[0].reset();
    view.toggleUploadingSpinner();
    view.coverImage = '';

    app.libraryCollection.fetch({reset: true});
  },
  errorAddingBook: function (view, model) {
    Materialize.toast('Something went wrong!', 3000);
    view.$('#add_book')[0].reset();
    view.toggleUploadingSpinner();
    view.coverImage = '';
  },
  alertInvalidForm: function () {
    var $toastContent = $('<span>Please, fill at least one field!</span>');
    Materialize.toast($toastContent, 3000);
  },
  isModalForm: function () {
    return window.screen.availWidth < 601;
  },
  maxFileSizeAlert: function () {
    Materialize.toast('Selected file is too big. Max. upload file is 1 MB', 3000);
    this.$('#coverImage').val('');
    this.$('#coverImagePath').val('');
  },
  setCoverImage: function (e) {
    var file = e.target.files[0],
      reader = new FileReader(),
      view = this;

    reader.onloadend = function () {
      if (file.size > 1000000) {
        view.maxFileSizeAlert();
        return;
      }
      view.coverImage = reader.result;
    };

    if (file) {
      reader.readAsDataURL(file);
    } else {
      view.coverImage = '';
    }
  },
  toggleUploadingSpinner: function() {
    this.$('.bl-addbook-uploading-spinner').hasClass('bl-hidden') ? this.$('.bl-addbook-uploading-spinner').removeClass('bl-hidden') : this.$('.bl-addbook-uploading-spinner').addClass('bl-hidden');
  },
  hideBookLibrary: function() {
    $('.page').removeClass('active_page');
  },
  showBookLibrary: function() {
    $('#book_library').addClass('active_page');
  }
});
