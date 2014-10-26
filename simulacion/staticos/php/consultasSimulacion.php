<?php
include_once 'coneccion.php';

class Consultas {
        
    /*
     * Busca todos los sitios turisticos
     */
    public function ListaRegistros(){     
        $sql =  "SELECT * FROM simulacion where id=(SELECT max(id) FROM simulacion);";        
        $mysql = new Coneccion();
        return $mysql->get_resultados_query($sql); 
    }
       
          
                        
}

?>
