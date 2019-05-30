<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(!isset($_POST)){
    echo "Unauthorized method";
    exit();
}

require_once 'drivers/psql.php';

switch($_POST['driver']){
    case 'psql':
        echo date('d/m/Y H:i:s') . ' - ';
        $driver = new PsqlDriver();
        $conexao = $driver->openConnection($_POST['host'], $_POST['database'], $_POST['user'], $_POST['password']);

        if(!$conexao){
            echo "[$_POST[name]] - Falha ao estabelecer conexão com a base.";
            exit();
        }

        $retorno = $driver->executeScript($_POST['script']);

        if($retorno['error']){
            echo "[$_POST[name]] - Erro ao executar o script : ";
            print_r($retorno['content']);
            exit();
        }

        echo "[$_POST[name]] - Script executado com sucesso. Linhas afetadas: $retorno[affected_rows] Resultado: ";
        print_r($retorno['content']);

    break;
}