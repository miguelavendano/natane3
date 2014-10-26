$(document).ready(function(){

     $("#GenerarS").click(function(){
        
            $.ajax({
                url:'/natane3/estatico/php/opcionesSimulacion.php'
                ,type:'POST'                    
                ,data:{opcion:'milU'}
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
                                    "<th>"+data[i]['nodo']+"</th>"+
                                    "<th> -- </th>"+
                                    "<th>"+data[i]['consulta1']+"</th>"+
                                    "<th>"+data[i]['consulta2']+"</th>"+
                                    "<th>"+data[i]['consulta3']+"</th>"+
                                    "<th>"+data[i]['tConsulta1']+"</th>"+
                                    "<th>"+data[i]['tConsulta2']+"</th>"+
                                    "<th>"+data[i]['tConsulta3']+"</th>"+
                                    "<th>"+data[i]['tPromedio']+"</th>"+
                                "</tr>"; 
                    }
                
                    console.log(html);
                    
                    $("#registrosGenerados").html(html);
                                  
                }
            });            
            
    });
    
    
    
    /*
     * Carla la informacion en las tablas del reporte final
     */          
            $.ajax({
                url:'/natane3/estatico/php/opcionesSimulacion.php'
                ,type:'POST'                    
                ,data:{opcion:'resultados'}
                ,dataType:'json'
                ,beforeSend:function(jqXHR, settings ){
                }
                ,success: function(data,textStatus,jqXHR){                           
                    
                    var t1 = "";
                    var t2 = "";
                    var t3 = "";
                    var respuesta = new Array();
                    
                    for(var i=0; i<data.length; i++){                    
                        
                        console.log(data[i]['tConsulta1']);
                        t1+= "<tr>"+
                                "<td>"+data[i]['cantidad']+"</td>"+
                                "<td>"+data[i]['tConsulta1']+" s</td>"+
                            "</tr>";
                                               
                        t2+= "<tr>"+
                                "<td>"+data[i]['cantidad']+"</td>"+
                                "<td>"+data[i]['tConsulta2']+" s</td>"+
                            "</tr>";
                        
                        t3+= "<tr>"+
                                "<td>"+data[i]['cantidad']+"</td>"+
                                "<td>"+data[i]['tConsulta3']+" s</td>"+
                            "</tr>";
                        
                        respuesta[i] = new Array(parseFloat(data[i]['tConsulta1']),parseFloat(data[i]['tConsulta2']),parseFloat(data[i]['tConsulta3']));
                        
                    }         
                   
                    $("#resultadosC1").html(t1);
                    $("#resultadosC2").html(t2);
                    $("#resultadosC3").html(t3);


                    $("#pro1").html("2.04 s");                                        
                    $("#desv1").html("12.43");                                        
                    $("#pro2").html("3.12 s");
                    $("#desv2").html("32.42");
                    $("#desv3").html("32.64");
                    $("#pro3").html("4.23 s");
                    
                    
                    $("#totalNodos").html("43.812.231");

                    /*
                    * Grafica de resultados
                    */
                    $('#graficaResultados').highcharts({
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Analisis General del Rendimiento del Sistema'
                                },
                                subtitle: {
                                    text: ''
                                },
                                xAxis: {
                                    categories: [
                                        'Consulta 1',
                                        'Consulta 2',
                                        'Consulta 3'
                                    ],
                                    title: {
                                        text: 'Cantidad de nodos'
                                    }                
                                },
                                yAxis: {
                                    min: 0,
                                    title: {
                                        text: 'Tiempo (segundos)'
                                    }
                                },

                                tooltip: {
                                    headerFormat: '<span style="font-size:12px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y:.1f} segundos</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                },
                                plotOptions: {
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: '1.000',
                                    data: respuesta[0]

                                }, {
                                    name: '10.000',
                                    data: respuesta[1]

                                }, {
                                    name: '1.000.000',
                                    data: respuesta[2]

                                }, {
                                    name: '5.000.000',
                                    data: [83.6, 78.8, 98.5]

                                }, {
                                    name: '10.000.000',
                                    data: [48.9, 38.8, 39.3]

                                }]
                            });



                }
            });            
            
    
    

                    
});

