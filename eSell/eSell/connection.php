<?php

class connect{


public static $dbms;

public static function dbConnection(){


    if(!isset(connect::$dbms)){
       connect::$dbms= new mysqli("127.0.0.1", "root", "thisitha#8002*", "eshop", "3306");
    }

}

public static function executer($Que){


    connect::dbConnection();

   $resultset= connect::$dbms->query($Que);

   
   return $resultset;

}



}
?>