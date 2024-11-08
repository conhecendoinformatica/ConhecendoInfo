<?php
class Conexao {
   
   public static $instance;

   private function __construct() {
       //
   }

   public static function getConexao() {
       if (!isset(self::$instance)) {
           self::$instance = new PDO("pgsql:host=ep-icy-mountain-a4z390r0-pooler.us-east-1.aws.neon.tech;dbname=verceldb", "default", "92DyqdeouPBl");
           self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
       }

       return self::$instance;
   }

}
try {
    $sql = "SELECT * FROM membros";
    $result = Conexao::getConexao()->query($sql);
    $lista = $result->fetchAll(PDO::FETCH_ASSOC);
    $f_lista = array();
    foreach ($lista as $l) {
        $f_lista[] = $this->listaUsuarios($l);
    }
    var_dump($f_lista);
} catch (Exception $e) {
    print "Ocorreu um erro ao tentar Buscar Todos." . $e;
}