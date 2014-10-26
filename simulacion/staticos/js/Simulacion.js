$(document).ready(function(){

     
});


    function generarPrueba(opc, cant){
        
        
            $.ajax({
                url:'staticos/php/opcionesSimulacion.php'
                ,type:'GET'                    
                ,data:{ 
                    opcion:opc,
                    cant:cant
                }
                ,dataType:'json'
                ,beforeSend:function(jqXHR, settings ){

                    $("#reload").css({visibility: 'visible',
                                        opacity:'1',
                                        position: 'fixed',
                                        top: '200px',
                                        right: '50px',
                                        left: '50px',
                                        width: 'auto',
                                        margin: '0 auto'
                                    });   
                }
                ,success: function(data,textStatus,jqXHR){                           
                                        
                    $("#reload").css({visibility: 'hidden'});   
                    //$(".reload-backdrop").css({visibility: 'hidden'});                    
                                     
                    var html ="";
                    
                    console.log(data);
                    
                    for(var i=0; i<data.length; i++){                    
                                            
                        html +=  "<tr>"+                                    
                                    "<th>"+data[i]['id_nodo']+"</th>"+
                                    "<th>"+data[i]['tipo_nodo']+"</th>"+
                                    "<th>"+data[i]['consulta']+"</th>"+
                                    "<th id="+data[i]['prueba']+data[i]['tipo_nodo']+data[i]['id_nodo']+">"+data[i]['tiempo']+"</th>"+
                                "</tr>"; 
                    }
                
                    console.log(html);
                    
                    $("#registrosGenerados"+data[0]['prueba']).html(html);
                                  
                }
            });              
            
    };



    function ejecutarPrueba(opc, cant){


            $.ajax({
                url:'staticos/php/opcionesSimulacion.php'
                ,type:'GET'                    
                ,data:{ 
                    opcion:opc,
                    cant:cant
                }
                ,dataType:'json'
                ,beforeSend:function(jqXHR, settings ){

                    $("#reload").css({visibility: 'visible',
                                        opacity:'1',
                                        position: 'fixed',
                                        top: '200px',
                                        right: '50px',
                                        left: '50px',
                                        width: 'auto',
                                        margin: '0 auto'
                                    });   
                }
                ,success: function(data,textStatus,jqXHR){                           
                                        
                     $("#reload").css({visibility: 'hidden'});   
                     $(".reload-backdrop").css({visibility: 'hidden'});                    
                                     
                     var html ="";
                    
                     console.log(data);
                    
                     for(var i=0; i<data.length; i++){                    
                                            
                        $("th#"+data[i]['prueba']+data[i]['tipo_nodo']+data[i]['id_nodo']).html(data[i]['tiempo']);
                        
                     }
                     
                     
                     
                    /*
                    * Grafica de resultados
                    */
                    $('#graficaResultados'+cant).highcharts({ 
 
                        chart: {
                           type: 'column'
                       },
                       title: {
                           text: 'Comparacion Consulta / Tiempo '
                       },
                       subtitle: {
                           text: 'Neo4j'
                       },
                       xAxis: {
                           type: 'category',
                           labels: {
                               rotation: -45,
                               style: {
                                   fontSize: '13px',
                                   fontFamily: 'Verdana, sans-serif'
                               }
                           }
                       },
                       yAxis: {
                           min: 0,
                           title: {
                               text: 'Tiempo (Mili-Segundos)'
                           }
                       },
                       legend: {
                           enabled: false
                       },
                       tooltip: {
                           pointFormat: 'Consulta: <b>{point.y:.1f} ms</b>'
                       },
                       series: [{
                           name: 'Population',
                           data: [
                               ['Consulta 1', parseFloat(data[0]['tiempo'])],
                               ['Consulta 2', parseFloat(data[1]['tiempo'])],
                               ['Consulta 3', parseFloat(data[2]['tiempo'])]    
                           ],
                           dataLabels: {
                               enabled: true,
                               rotation: -90,
                               color: '#FFFFFF',
                               align: 'right',
                               x: 4,
                               y: 10,
                               style: {
                                   fontSize: '13px',
                                   fontFamily: 'Verdana, sans-serif',
                                   textShadow: '0 0 3px black'
                               }
                           }
                       }]
    
 
 
                    });                     
                                         
                                  
                }
            });              

    };
    
    
    
    function cargarPrueba(opc, cant){


            $.ajax({
                url:'staticos/php/opcionesSimulacion.php'
                ,type:'GET'                    
                ,data:{ 
                    opcion:opc,
                    cant:cant
                }
                ,dataType:'json'
                ,beforeSend:function(jqXHR, settings ){

                    $("#reload").css({visibility: 'visible',
                                        opacity:'1',
                                        position: 'fixed',
                                        top: '200px',
                                        right: '50px',
                                        left: '50px',
                                        width: 'auto',
                                        margin: '0 auto'
                                    });   
                }
                ,success: function(data,textStatus,jqXHR){                           
                                        
                     $("#reload").css({visibility: 'hidden'});   
                     $(".reload-backdrop").css({visibility: 'hidden'});                    
                                     
                     var html ="";
                    
                     console.log(data);
                     
                    for(var clave in data){
                                                              
                        html +=  "<tr>"+
                                    "<th>"+clave+"</th>"+
                                    "<th>"+data[clave]+"</th>"+
                                "</tr>"; 
                    }
                
                    console.log(html);
                    
                    $("#tablaNodos"+cant).html(html);        
                                         
                    $("#tNodos"+cant).html(data['Total']);
                    
                    analisisFinal('final', cant);
                    
                }
            });              

    };
    
    
    function analisisFinal(opc, cant){
        
        
            $.ajax({
                url:'staticos/php/opcionesSimulacion.php'
                ,type:'GET'                    
                ,data:{ 
                    opcion:opc,
                    cant:cant
                }
                ,dataType:'json'
                ,beforeSend:function(jqXHR, settings ){

                    $("#reload").css({visibility: 'visible',
                                        opacity:'1',
                                        position: 'fixed',
                                        top: '200px',
                                        right: '50px',
                                        left: '50px',
                                        width: 'auto',
                                        margin: '0 auto'
                                    });   
                }
                ,success: function(data,textStatus,jqXHR){                           
                                        
                     $("#reload").css({visibility: 'hidden'});   
                     $(".reload-backdrop").css({visibility: 'hidden'});                    
                                     
                     var html ="";
                    
                     console.log(data);
                     
                    for(var clave in data){
                                                              
                        html +=  "<tr>"+
                                    "<th>"+clave+"</th>"+
                                    "<th>"+data[clave]+"</th>"+
                                "</tr>"; 
                    }
                
                    console.log(html);
                    
                    $("#tablaNodos"+cant).html(html);        
                                         
                    $("#tNodos"+cant).html(data['Total']);
                    
                    analisisFinal('final', cant);
                    
                }
            });          
        
        
    }