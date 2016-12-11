var app = app || {};

app.LibraryView = Backbone.View.extend({
  el: '#book_library',

  events: {
    'click #add':'addBook'
  },

  initialize: function( initialBooks ) {
    this.collection = new app.Library();
    this.collection.fetch({reset: true});
    this.render();

    this.listenTo( this.collection, 'add', this.renderBook );
    this.listenTo( this.collection, 'reset', this.render ); // NEW
  },

  render: function() {
    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
    });
    this.collection.each(function( item ) {
      this.renderBook( item );
    }, this );
  },

  renderBook: function(item) {
    var bookView = new app.BookView({
      model: item
    });
    this.$('#book_gallery').append( bookView.render().el );
  },
  addBook: function( e ) {
    e.preventDefault();
    var formData = {};
    $( '#add_book input' ).each( function( i, el ) {
      if( $( el ).val() !== '' )
      {
        formData[ el.id ] = $( el ).val();
      }
    });

    this.collection.create(formData);
  },
});
