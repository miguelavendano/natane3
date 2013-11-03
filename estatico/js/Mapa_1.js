$(document).ready(function(){

        function mapa_natane() {

            /*************** datos a modificar ************************/
             var mizoom=13;//1-23
             var icono="/natane3/estatico/img/icono.jpg";//direcccion del icono 
             var ubicacion=new google.maps.LatLng(4.15,-73.64);
             var infowindow=null;//informacion como la direccion
            /**********************************************************/

            var marker;
            var map;
            var makerOptions;
            var mapOptions ;

            function inicializa(){

                mapOptions = {
                    zoom: mizoom,
                    center: ubicacion,
                    mapTypeId: google.maps.MapTypeId.ROADMAP                    
                };                   
                   
                if(document.getElementsByClassName('mapa-natane').length==0){ 
                    alert("no existe la class=mapa_natane");
                    return ;
                }

                map = new google.maps.Map(document.getElementsByClassName('mapa-natane')[0],mapOptions);

                makerOptions={
                    position: map.getCenter(),
                    map: map,
                    title: 'Selecciona, arrastra y posiciona tu sitio',
                    icon:icono,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    cursor:"move"                    
                  };

                marker = new google.maps.Marker(makerOptions);


                //eventos
                google.maps.event.addListener(marker, 'dragend', function() {
                       mostrarDetalles();                       
                });    


                /**************al dar click en el mapa******************/
                google.maps.event.addDomListener(map,'click',function (e){
                    if(marker!=null)   
                        {marker.setPosition(e.latLng);
                            mostrarDetalles();
                    }
                    else{
                        marker = new google.maps.Marker(makerOptions);
                        marker.setPosition(e.latLng);
                        }
                });
                
            }//CIERRA LA FUNCION DE INICILIZACION



             //aceptacion de la solicitud de acceso a ubicacion
            function showPosition(position){
                ubicacion=new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                inicializa();
            }

            //muestre el mapa con la ubicacion que pasa por parametro
            function muestraPosicionActual(latitud,longitud){
                alert("entro a la fucion");
                ubicacion=new google.maps.LatLng(latitud,longitud);
                inicializa();
            }


            //muestra la direccion
            function mostrarDetalles(){
                    if(infowindow!=null){
                        infowindow.setContent();
                        infowindow.close();
                    }
                    
                    infowindow=null;


                    $.ajax({
                        url:'http://maps.googleapis.com/maps/api/geocode/json?latlng='+marker.getPosition().lat()+','+marker.getPosition().lng()+'&sensor=true'
                        ,type:'GET'
                        ,dataType:'json'
                        ,success: function(data,textStatus,jqXHR){
    
                                var contenido="";
                                if(data!=null  && data!='null' && marker!=null && data.status=="OK"){
                                    contenido="direccion aproximada : <br>"+data.results[0].formatted_address;
                                 }
                                else{
                                    }

                                //mostrar la direccion
                                infowindow = new google.maps.InfoWindow({
                                         content: contenido
                                });
                                google.maps.event.addListener(marker, 'click', function() {
                                     infowindow.open(map,marker);
                                });

                                infowindow.open(map,marker);
                        }
                    });

                 //console.log(posicion());
                 
            }//CIERRA FUNCION mostrarDetalles



            /*************** llamado ****/
            inicializa();
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition);
            }


            //FUNCIONES
            /*******
             * 
             * retorna la posicion del objeto ubicado
             * en el formato {latitud, longitud}
             * en caso de no existir los dos tendran valores null
             * 
             */
            function posicion(){
                if(marker!=null){
                    var latitud=marker.getPosition().lat();
                    var longitud=marker.getPosition().lng();
                    //alert("latitud:"+latitud+"   longitud:"+longitud);
                   return {latitud:latitud, longitud:longitud};
                }
                else{
                    return {latitud:null, longitud:null};
                }
            }            
            this.getPosicion=posicion;
            /**************
             * 
            elimina el  (marker)
             */
            this.limpiar=function(){
                marker.setMap(null);
                marker=null;
            }
            
        }//CIERRE DE LA FUNCION DE MAPA_NATANE


        
        
            
    /********************* Princpal*******************/

    var mapa;

    google.maps.event.addDomListener(window, 'load', function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'obtieneCoordenadasS',                   
                    sitio: id_url[1]
                }
                ,dataType:'JSON'
                ,success: function(data,textStatus,jqXHR){                           
                            //alert(data.latitud+"____"+data.longitud)
                            mapa=new mapa_natane();
                            
                            mapa.muestraPosicionActual(data.latitud,data.longitud);
                }
            });                                
    });


    $("#muestraCoordenadas").click(function(){
        
        alert("entroooo!!!! servidor de amazon AWS");        
        alert(mapa.getPosicion());
        
    });    

    /*
     * Guardar coordenadas del sitio
     */
    $("#guardaCoordenadasSitio").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");              

            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'guardaCoodenadasS',                   
                    sitio: id_url[1],
                    lat_lon: mapa.getPosicion()
                }
                ,dataType:'JSON'
                ,success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                
                            alert("Cambios guardados.");
                            document.location.reload();                                     
                        }
                        else alert("No se han podido realizar los cambios");                                                     
                }
            });                        
    });   

});

