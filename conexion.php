<?php

 $dsn = "mysql:host=localhost;dbname=sigsm;charset=utf8m4"

 try{

    $pdo = new PDO ($dsn, "root", ""[
    PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASOC
  )];

    } catch (PDOEception $e) {

          die ("error de conexión:" . $e->getMessage());
    }

?>