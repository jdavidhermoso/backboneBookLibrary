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
    this.collection = new app.Library();
    this.collection.fetch({reset: true});
    this.render();

    this.listenTo(this.collection, 'add', this.renderBook);
    this.listenTo(this.collection, 'reset', this.render); // NEW
  },
  render: function () {
    $("#add_book").modal();
    this.collection.each(function (item) {
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
    e.preventDefault();
    var formData = {},
      voidForm = true;


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
      var that = this;
      this.collection.create(formData, {
        success: function() { that.successAddedBook(that) },
        error: function() { that.errorAddingBook(that) },
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
  successAddedBook: function (ctx) {
    Materialize.toast('Book added!', 3000);
    ctx.$('#add_book')[0].reset();
    ctx.toggleUploadingSpinner();
  },
  errorAddingBook: function (ctx) {
    Materialize.toast('Something went wrong!', 3000)
    ctx.$('#add_book')[0].reset();
    ctx.toggleUploadingSpinner();
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
      reader.readAsDataURL(file); //reads the data as a URL
    }
  },
  toggleUploadingSpinner: function() {
    this.$('.bl-addbook-uploading-spinner').hasClass('bl-hidden') ? this.$('.bl-addbook-uploading-spinner').removeClass('bl-hidden') : this.$('.bl-addbook-uploading-spinner').addClass('bl-hidden');
  }
});
