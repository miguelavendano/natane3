   
    var id_sitio_auto = "";
    
    $( "#auto-sitios" ).autocomplete({
      source: "/natane3/estatico/php/buscaSitios.php", /*function( request, response ) {
        $.ajax({
          url: "http://gd.geobytes.com/AutoCompleteCity",
          dataType: "jsonp",
          data: {
            q: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },*/
      minLength: 3,
      select: function( event, ui ) {
          console.log("Sitio: " + ui.item.label+" id: "+ui.item.id );
          id_sitio_auto=ui.item.id;
      },
      open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
    });
