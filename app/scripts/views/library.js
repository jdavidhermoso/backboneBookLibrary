var app = app || {};

app.LibraryView = Backbone.View.extend({
  el: '#book_library',
  events: {
    'click #add': 'addBook',
    'click #show_addbook_form': 'openAddBookForm',
    'change #coverImage': 'setCoverImage',
    'keydown #keywords': 'keywordType'
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
    $('.bl-datepicker').pickadate({
      selectMonths: true,
      selectYears: 15
    });
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
  renderKeywords: function (keywords) {
    this.$('#keywords_cloud').empty();
    var template = _.template($('#keywordTemplate').html()),
      html;
    console.log(keywords);
    var keyword = {};
    for (var i = 0, z = keywords.length; i < z; i++) {
      keyword = {
        keyword: keywords[i]
      };
      html = template(keyword);
      this.$('#keywords_cloud').append(html);
    }
    this.$('#keywords')[0].value = '';

    return this;
  },
  addBook: function (e) {
    e.preventDefault();
    var formData = {},
      voidForm = true,
      keywords = this.getAddedKeywords();

    $('#add_book input:not(".bl-avoid-formadata")').each(function (i, el) {
      if ($(el).val() !== '') {
        voidForm = false;
        formData[el.id] = $(el).val();
      }
    });

    formData['coverImage'] = this.coverImage;
    formData['keywords'] = keywords.join();

    if (!voidForm) {
      this.collection.create(formData, {
        success: this.successAddedBook,
        error: this.errorAddingBook
      });
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
  successAddedBook: function () {
    Materialize.toast('Book added!', 3000)
  },
  errorAddingBook: function () {
    Materialize.toast('Something went wrong!', 3000)
  },
  alertInvalidForm: function () {
    var $toastContent = $('<span>Please, fill at least one field!</span>');
    Materialize.toast($toastContent, 3000);
  },
  isModalForm: function () {
    return window.screen.availWidth < 601;
  },
  maxFileSizeAlert: function (fileSize) {
    Materialize.toast('Selected file is too big. Max. upload file is 64 kb and your file is ' + fileSize + '!', 3000);
    this.$('#coverImage').val('');
    this.$('#coverImagePath').val('');
  },
  setCoverImage: function (e) {
    var file = e.target.files[0],
      reader = new FileReader(),
      view = this;

    reader.onloadend = function () {
      if (file.size > 65535) {
        view.maxFileSizeAlert(file.size);
        return;
      }
      view.coverImage = reader.result;
    };

    if (file) {
      reader.readAsDataURL(file); //reads the data as a URL
    }
  },
  keywordType: function (e) {
    var key = e.keyCode,
      keywords = this.getAddedKeywords();;
    if (key == 32) {
      keywords.push(e.target.value);
      this.renderKeywords(keywords);
    }
  },
  getAddedKeywords: function() {
    var keywords = [];
    this.$('#keywords_cloud span').each(function(i, el) {
      keywords.push(el.textContent.trim());
    });

    return keywords;
  }
});
