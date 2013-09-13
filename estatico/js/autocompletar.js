$(document).ready(function(){
    
    // Load countries then initialize plugin:
    $.ajax({
        url:'/natane3/estatico/php/opcionesConsulta.php'
        ,type:'POST'                    
        ,data:{
            opcion:'busqueda',                            
            consulta: $("#loBusca").val()                        
        },
        dataType: 'json'
    }).done(function (respuesta) {

        var countriesArray = $.map(respuesta, function (value, key) { return { value: value, data: key }; }),
            countries = $.map(respuesta, function (value) { return value; });

        // Initialize ajax autocomplete:
        $('.autocomplete-ajax').autocomplete({
            // serviceUrl: '/autosuggest/service/url',
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                $('.selection-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
            },
            onHint: function (hint) {
                $('.autocomplete-ajax-x').val(hint);
            },
            onInvalidateSelection: function() {
                $('.selection-ajax').html('You selected: none');
            }
        });

        
    });

});