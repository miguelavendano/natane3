
   function mapa_natane(datos){
       
        /*************** datos a modificar ************************/
        var mizoom=13;//1-23        
        var icono="/natane3/estatico/img/icono.jpg";//direcccion del icono 
        var lat;
        var lon;        
        var idMapa;        
        var ubicacion=new google.maps.LatLng(4.15,-73.64);
        var infowindow=null;//informacion como la direccion        
       /**********************************************************/
        
        var marker;
        var map;
        var makerOptions;
        var mapOptions ;
         
       
        ///definicion del json
        if(datos==undefined){
            datos="";
        }
       
        //coordenadas
        if(datos.lat!=undefined && datos.lon!=undefined){
            ubicacion=new google.maps.LatLng(datos.lat, datos.lon);
        }
           
        //arrastrar
        if(datos.drag==undefined){
            datos.drag=true;
        }
           
        //ubicacion automatica
        if(datos.automatico==undefined){
            datos.automatico=true;
        }
       
         //ubicacion automatica
        if(datos.idMapa==undefined){
            idMapa="idMapa";
        }else{
            idMapa=datos.idMapa;
        }
      

        function inicializa(){
            
            mapOptions = {
                zoom: mizoom,
                center: ubicacion,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            if(document.getElementById(idMapa)==null){
                alert("no existe el ID "+idMapa);
                return ;
            }

            map = new google.maps.Map(document.getElementById(idMapa),mapOptions);


            makerOptions={
                position: map.getCenter(),
                map: map,
                title: 'Click to zoom',
                icon:icono,
                draggable: datos.drag,
                animation: google.maps.Animation.DROP,
                cursor:"move"
            };


            marker = new google.maps.Marker(makerOptions);
             

            //si drap esta es verdadero se puede arrastar 
            if(datos.drag){
                ////eventos
                google.maps.event.addListener(marker, 'dragend', function() {
                    mostrarDetalles();
                });

                /**************al dar click en el mapa******************/
                google.maps.event.addDomListener(map,'click',function (e){
                    if(marker!=null){
                        marker.setPosition(e.latLng);
                        mostrarDetalles();
                    }
                    else{
                        marker = new google.maps.Marker(makerOptions);
                        marker.setPosition(e.latLng);
                        }
                });
            }
        }//cierre funcion inicializa
     
     
        this.go=function (){
            return datos;
        }
        
        //aceptacion de la solicitud de acceso a ubicacion
        function showPosition(position){            
            ubicacion=new google.maps.LatLng(position.coords.latitude, position.coords.lonitude);
            inicializa();
        }

 
 
        //muestra la direccion
        function mostrarDetalles(){
            if(infowindow!=null){
                infowindow.setContent();
                infowindow.close();
            }infowindow=null;
          
          
            $.ajax({
                url:'http://maps.googleapis.com/maps/api/geocode/json?latlng='+marker.getPosition().lat()+','+marker.getPosition().lng()+'&sensor=true'
                ,type:'GET'              
                ,dataType:'json'
                ,beforeSend:function(  jqXHR, settings ){}
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
        }
 
        
        
        /*************** llamado ****/
        inicializa();
        
        //si es true permite la geolocalizacion con el equipo
        if(datos.automatico){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition);
            }
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
                var latitud_sitio=marker.getPosition().lat();
                var longitud_sitio=marker.getPosition().lng();
              
                return {latitud:latitud_sitio, longitud:longitud_sitio};
            }
            else{
                return {latitud:null, longitud:null};
            }
            
        }
        this.getPosicion=posicion;
          
        /**************
         * elimina el  (marker)
         */
        this.limpiar=function(){
            marker.setMap(null);
            marker=null;              
        }
        
    }//CIERRA FUNCION NATANE_MAPA
        
        
$(document).ready(function(){        
            
    /********************* Princpal*******************/
    var mapa;
    var mapa_edit;

//    google.maps.event.addDomListener(window, 'load', function(){
//        mapa=new mapa_natane({idMapa:'P2'});
//        mapa=new mapa_natane({idMapa:'P1'});
//    });
    
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
                            //alert(data.lat+"____"+data.lon+"____"+data.idMapa+"____"+data.drag);
                            data.drag='false';
                            //alert(data.lat+"____"+data.lon+"____"+data.idMapa+"____"+data.drag);
                            mapa = new mapa_natane(data);  //carga el mapa 
                }
            });                                
    

        /*
         * Muestar el mapa del sitio para su edicion
         */            
        $("#EditarMapaSitio").click(function(){
                     
            $("#edicionMapaSitio").css({display:'inline'});           
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
                            //alert(data.lat+"____"+data.lon+"____"+data.idMapa+"____"+data.drag);                            
                            data.idMapa='EmapaSitio';
                            //alert(data.lat+"____"+data.lon+"____"+data.idMapa+"____"+data.drag);
                            mapa_edit = new mapa_natane(data);  //carga el mapa 
                }
            });             
        });
        
        /*
         * Muestar el mapa de la empresa para su edicion
         */        
        $("#EditarMapaEmpresa").click(function(){
                     
            $("#edicionMapaEmpresa").css({display:'inline'});           
            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            $.ajax({
                url:'/natane3/estatico/php/opcionesEmpresa.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'obtieneCoordenadasE',                   
                    sitio: id_url[1]
                }
                ,dataType:'JSON'
                ,success: function(data,textStatus,jqXHR){                           
                            alert(data.lat+"____"+data.lon+"____"+data.idMapa+"____"+data.drag);                            
                            data.idMapa='EmapaEmpresa';
                            alert(data.lat+"____"+data.lon+"____"+data.idMapa+"____"+data.drag);
                            mapa_edit = new mapa_natane(data);  //carga el mapa 
                }
            });             
        });
        
    });                                
    
    /*
     * Guardar coordenadas del sitio
     */
    $("#guardaCoordenadasSitio").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");              
            alert(mapa_edit.getPosicion());
            /*
            $.ajax({
                url:'/natane3/estatico/php/opcionesSitio.php'
                ,type:'POST'                    
                ,data:{
                    opcion: 'guardaCoodenadasS',                   
                    sitio: id_url[1],
                    lat_lon: mapa_edit.getPosicion()
                }
                ,dataType:'JSON'
                ,success: function(data,textStatus,jqXHR){                           

                        if(/true/.test(data)) {                                
                            alert("Cambios guardados.");
                            document.location.reload();                                     
                        }
                        else alert("No se han podido realizar los cambios");                                                     
                }
            });  */                      
    });
    
    
    /*
     * Guardar edicion de los datos del sitio
     */        
    $("#guarda_edicion_sitio").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            if($("#Epass1S").val()==$("#Epass2S").val()){  //valida contraseñas                                        

                $.ajax({
                    url:'/natane3/estatico/php/opcionesSitio.php'
                    ,type:'POST'                    
                    ,data:{
                        opcion: 'guardar_edicionS',                   
                        sitio: id_url[1],
                        nombre: $("#EnomS").val(),
                        descri: $("#EdescS").val(),
                        city: $("#EcityS").val(),                    
                        direc: $("#EdirS").val(),
                        tele: $("#EtelS").val(),                    
                        mail: $("#EmailS").val(),                    
                        lat_lon: mapa_edit.getPosicion(),
                        s_web: $("#Es_webS").val(),
                        face: $("#EfaceS").val(),
                        twit: $("#EtwiS").val(),
                        youtube: $("#EyouS").val(),
                        tsitio: $("input[name='EtipoS']:checked").val(),
                        pass: $("#Epass1S").val()
                        //imagen: $("#Epass1").val(data.imagen),
                    }
                    ,dataType:'JSON'
                    /*,beforeSend:function(jqXHR, settings ){
                        alert("Debe confirmar su identidad, para realizar los cambios.");                                        
                    }*/
                    ,success: function(data,textStatus,jqXHR){                           

                            if(/true/.test(data)) {                                
                                alert("Cambios guardados.");
                                document.location.reload();                                     
                            }
                            else alert("No se han podido realizar los cambios");                                                     
                    }
                });                        
            }else{ alert("Las contraseñas no coinciden"); }                    
    });        



    /*
     * Guardar edicion de los datos de la empresa
     */     
    $("#guarda_edicion_empresa").click(function(){

            var mi_url=document.location.href;
            var id_url=mi_url.split("=");  
            
            if($("#Epass1E").val()==$("#Epass2E").val()){  //valida contraseñas                                                    
                $.ajax({
                    url:'/natane3/estatico/php/opcionesEmpresa.php'
                    ,type:'POST'                    
                    ,data:{
                        opcion: 'guardar_edicionE',
                        empresa: id_url[1],
                        nombre: $("#EnomE").val(),
                        descri: $("#EdescE").val(),
                        nit: $("#EnitE").val(),
                        city: $("#EcityE").val(),                    
                        direc: $("#EdirE").val(),
                        tele: $("#EtelE").val(),                    
                        mail: $("#EmailE").val(),                    
                        lat_lon: mapa_edit.getPosicion(),                 
                        s_web: $("#Es_webE").val(),
                        face: $("#EfaceE").val(),
                        twit: $("#EtwiE").val(),
                        youtube: $("#EyouE").val(),
                        pass: $("#Epass1E").val()
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
            }else{ alert("Las contraseñas no coinciden"); }                                    
    });    

});

