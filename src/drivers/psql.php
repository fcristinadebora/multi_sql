<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class PsqlDriver {
    private $connection;

    function openConnection($host, $db, $user, $password){
        $conexao = pg_connect("host=$host port=5432 dbname=$db user=$user password=$password"); //Linha de conexão
    
        if(!$conexao){
            return false;
        }

        $this->connection = $conexao;
    
        return true;
    }
    
    function executeScript($script){
        $query = pg_query($this->connection, $script);
        
        $return = array();

        if(!$query){
            $return['error'] = true;
            $return['content'] = pg_last_error($this->connection);
            return $return;
        }

        $return['error'] = false;
        $return['affected_rows'] = pg_affected_rows($query);
        $return['content'] = array();

        while($line = pg_fetch_assoc($query)){
            $return['content'] = $line;
        }

        return $return;
    }
}