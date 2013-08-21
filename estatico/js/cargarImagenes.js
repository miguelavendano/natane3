$(document).ready(function(){
    
        function vistaPreviaImagenes(evt) {
          var files = evt.target.files; // FileList object
          var id=0;
          // Loop through the FileList and render image files as thumbnails.
          for (var i = 0, f; f = files[i]; i++) {

            // Solo procesa archivos de tipo imagen
            if (!!f.type.match('image.*')) {
            
                var reader = new FileReader();

                // Closure to capture the file information.
                reader.onload = (function(theFile) {
                  return function(e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="img_exp" id="myimg',id++,'"src="', e.target.result,
                                      '" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('list_img_exp').insertBefore(span, null);
                  };
                })(f);

                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }//cierre if
          }//cierra for
        }//cierra funcion

        document.getElementById('imagenes_experiencia').addEventListener('change', vistaPreviaImagenes, false);

});