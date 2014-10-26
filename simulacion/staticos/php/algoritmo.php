<?php
    
    include_once ('../../../core/ConexionMysql.php');
    include_once ('../../../core/modeloSitio.php');
    include_once ('../neo4j/creaEmpresa.php');
    include_once ('../neo4j/creaUsuario.php');
    include_once ('../neo4j/creaComentario.php');
    include_once ('../neo4j/creaSitio.php');
    include_once ('../neo4j/creaExperiencia.php');
    include_once ('../neo4j/creaImagen.php');
    include_once ('../neo4j/creaServicio.php');
    include_once ('relaciones.php');

        

class Algoritmo{
    
    public $mysql;
    public $totalNodos;
    public $i;
    
    
    public function __construct($total){
        
        $this->totalNodos = $total;
        $this->i= 0;
        $this->mysql = new Conexion();        
        
        
    }

    
    public function cargaUsuarios(){
        
        echo "---------------------- -------------------------------------------- ------------  USUARIOS  --------- ------------------------------------------------ -----------------------------<br>";   
        
        $sexo=['M','F'];        
        $s=rand(0,1);
        $gen=$sexo[$s];        
        
        $nombres = $this->mysql->get_resultados_query("select nombre FROM nombres;");
        $apellidos = $this->mysql->get_resultados_query("SELECT apellido FROM natane.apellidos;");
        
        
        
        for($i=0; $i < $this->totalNodos*0.1; $i++){
        
        
            $nom = utf8_encode($nombres[rand(0, count($nombres)-1)]['nombre']);            
            $nom = preg_replace('/[^(\x20-\x7F)]*/','', $nom);
            $ape = utf8_encode($apellidos[rand(0, count($apellidos)-1)]['apellido']);        
            $ape = preg_replace('/[^(\x20-\x7F)]*/','', $ape);
            $nik=substr($nom,0,3)."_".substr($ape,0,3);         
            $mail=substr($nom,0,3)."_".substr($ape,0,3)."@gmail.com";           
            $img = "usuarioimagen".rand(0, 999).".jpg";
            
            echo $nom."<br>";
            echo $ape."<br>";
            echo $nik."<br>";
            echo $mail."<br>";
            echo $img."<br>" ;                        
            echo "------------------------------------------<br>";
            
            creaNodoUsuario($nom,$ape,$img,$gen,$nik, "villavo","granada",$mail);
            
        }
        
        
    
    }
    
    public function cargaSitios(){        
        
        echo "---------------------- -------------------------------------------- ------------  SITIOS  --------- -------------------------------------------------- ---------------------------<br>";   
        
        
        $tipo_sitio = array("icon-music",
                            "icon-glass",
                            "icon-food",
                            "icon-suitcase",
                            "icon-flag",
                            "icon-road");        
        
        $sitios = $this->mysql->get_resultados_query("select nombre FROM sitios;");
        $ciudad = $this->mysql->get_resultados_query("SELECT ciudad FROM ciudad;");
        $desc = $this->mysql->get_resultados_query("SELECT exprecion FROM expreciones;");
        
        for($i=0; $i < $this->totalNodos*0.1; $i++ ){
        
            $nom = utf8_encode($sitios[rand(0, count($sitios)-1)]['nombre']);
            $nom = preg_replace('/[^(\x20-\x7F)]*/','', $nom);
            $ciu = utf8_encode($ciudad[rand(0, count($ciudad)-1)]['ciudad']);                    
            $ciu = preg_replace('/[^(\x20-\x7F)]*/','', $ciu);
            $descrip = utf8_encode($desc[rand(0, count($desc)-1)]['exprecion']);             
            $descrip = preg_replace('/[^(\x20-\x7F)]*/','', $descrip);
            $img = "imagen (".rand(0, 999).").jpg";
            $tipo = $tipo_sitio[rand(0, count($tipo_sitio)-1)];
            $mail=substr($nom,0,3)."_".substr($tipo,0,3)."@gmail.com";           
                             
            echo $nom."<br>";
            echo $ciu."<br>";
            echo $descrip."<br>";
            echo $img."<br>";
            echo $tipo."<br>";
            echo $mail."<br>";
            echo "-------------------------------------------------------<br>";
            creaNodoSitio($nom,$descrip,$img,$tipo,$ciu,$mail);
            //creaNodoSitio($nom,$desc,$img,$tipo,$tel,$ciudad,$dir,$mail);
            
        }                
    }    


    public function cargaEmpresas(){
        
        echo "---------------------- ------------------------------------------------ --------  EMPRESAS  --------- ----------------------------------------------- ------------------------------<br>";   
               
        $empresas = $this->mysql->get_resultados_query("select empresa FROM empresas;");
        $ciudad = $this->mysql->get_resultados_query("SELECT ciudad FROM ciudad;");
        $desc = $this->mysql->get_resultados_query("SELECT exprecion FROM expreciones;");
        
        
        for($i=0; $i < $this->totalNodos*0.05; $i++ ){
        
            $nom = utf8_encode($empresas[rand(0, count($empresas)-1)]['empresa']);
            $nom = preg_replace('/[^(\x20-\x7F)]*/','', $nom);
            $ciu = $ciudad[rand(0, count($ciudad)-1)]['ciudad'];
            $ciu = preg_replace('/[^(\x20-\x7F)]*/','', $ciu);
            $mail= substr($nom,0,3)."_".substr($ciu,0,3)."@gmail.com";
            $img = "empresaimagen".rand(0, 999).".jpg";
            $descrip = utf8_encode($desc[rand(0, count($desc)-1)]['exprecion']);           
            $descrip = preg_replace('/[^(\x20-\x7F)]*/','', $descrip);
            
            

            echo $nom."<br>";
            echo $ciu."<br>";
            echo $mail."<br>";
            echo $img."<br>";
            echo $descrip."<br>";            
            
            echo "-------------------------------------------------------<br>";
            
            creaNodoEmpresa($nom,$descrip,$img,$ciu,$mail);
            
        }
        
    }      
    
    
    public function cargaExperiencias(){     
        
        echo "------------------------------------------------------------- ----- ------------  EXPERIENCIAS  --------- ---------------------------------------------------------------- -------------<br>";   
        
        $exprecion = $this->mysql->get_resultados_query("select exprecion FROM expreciones;");        
        
        for($i=0; $i < $this->totalNodos*0.2 ; $i++ ){
        
            $nom = utf8_encode($exprecion[rand(0, count($exprecion)-1)]['exprecion']);
            $nom = preg_replace('/[^(\x20-\x7F)]*/','', $nom);
            $desc = utf8_encode($exprecion[rand(0, count($exprecion)-1)]['exprecion']);
            $desc = preg_replace('/[^(\x20-\x7F)]*/','', $desc);
        
            
            
            echo $nom."<br>";            
            echo $desc."<br>";
            
            echo "-------------------------------------------------------<br>";
            
            creaNodoExperiencia($nom,$desc);            
        }
        
    }    
    
    public function cargaComentarios(){        
        
        echo "---------------------- --------------------------------------------------- -----  COMENTARIOS  --------- -------------------------------------------------------------- ---------------<br>";   
        
        $exprecion = $this->mysql->get_resultados_query("select exprecion FROM expreciones;");
        
        //$this->totalNodos*0.15
        for($i=0; $i < $this->totalNodos*0.08 ; $i++){
        
            $desc = utf8_encode($exprecion[rand(0, count($exprecion)-1)]['exprecion']);
            $desc = preg_replace('/[^(\x20-\x7F)]*/','', $desc);
        
            
            echo $desc."<br>";
            
            echo "-------------------------------------------------------<br>";           
            
            
            creaNodoComentario($desc);
            
        }
        
        
    }    

    
    public function cargaServicios(){        
        
        echo "------------------------------------------------------------------  ------------  SERVICIOS  --------- ----------------------------------------------------------------------- ------<br>";   
        
        $exprecion = $this->mysql->get_resultados_query("select exprecion FROM expreciones;");
        
        //$this->totalNodos*0.15
        for($i=0; $i < $this->totalNodos*0.02 ; $i++ ){
                    
            $desc = utf8_encode($exprecion[rand(0, count($exprecion)-1)]['exprecion']);
            $desc = preg_replace('/[^(\x20-\x7F)]*/','', $desc);
            
            echo $desc."<br>";
            
            echo "-------------------------------------------------------<br>";   
            creaNodoServicio($desc);
            
        }
        
        
    }          

    
    public function cargaImagenes(){        
        
        echo "----------------------------------------------------------------------- ----------------- ------------  IMAGENES  ---------------------------------------------------- - -------------------------------------------------------<br>";   
        
        $exprecion = $this->mysql->get_resultados_query("select exprecion FROM expreciones;");
                
        for($this->i; $this->i <$this->totalNodos*0.45 ; $this->i++ ){
        
            $img = "imagen".rand(0, 999).".jpg";            
            $desc = utf8_encode($exprecion[rand(0, count($exprecion)-1)]['exprecion']);
                     
            $desc = preg_replace('/[^(\x20-\x7F)]*/','', $desc);
            
            echo $img."<br>";
            echo $desc."<br>";
            
            echo "-------------------------------------------------------<br>";              
            
            
            
            creaNodoImagen($img,$desc);
            
        }
        
        
    } 
    
    
    public function renombrarSitios(){
        
                
        $msitio = new ModelSitios();        
        $ids = $msitio->get_ids_sitios();
        //echo "<br><br><br>";

        //print_r($ids);
        
        
        for ($i=0; $i< count($ids); $i++){            
            
            $img = "imagen".rand(0, 999).".jpg";            
            
            $msitio->editar_sitio($ids[$i], "imagen", $img);            
            
            echo $ids[$i]."<br>"; 
            echo "imagen"."<br>"; 
            echo $img."<br>";
            echo "-----------------------------------------------<br>";
            
        }
        
        
        
        
        
        
        
        
        
    }


    
    public function principal(){
                
//        $this->cargaImagenes();        
//        $this->cargaUsuarios();
//        $this->cargaSitios();
//        $this->cargaEmpresas();
//        $this->cargaExperiencias();
//        $this->cargaComentarios();              
//        $this->cargaServicios();
//        
        

//        $this->renombrarSitios();
        
        
//        crearRelaciones();
        
    }



}
echo "hola";
$obj = new Algoritmo(100000);
$obj->principal();


?>
