<?php
require 'DB.php';

$_S_hostname = 'localhost';
$_S_username = 'root';
$_S_password = '';
$_S_dbname = 'hothothot';


// Create degree
$_SQL_table_degree = "CREATE TABLE degree(
        id int auto_increment,
        value_int float null,
        value_ext float null,
        alert_int varchar(255) null,
        alert_ext varchar(255) null,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        constraint degree_pk
                    primary key (id)
)";

//Create doc
$_SQL_table_doc = "CREATE TABLE documentation(
        id int auto_increment,
        doc_framework text null,
        doc_job text null,
        constraint documentation_pk
            primary key (id)
)";

// Create user
$_SQL_table_user = "create table user(
        id int auto_increment,
        firstname varchar(255) not null,
        lastname varchar(255) not null,
        password varchar(255) not null,
        email varchar(40) not null,
        nb_connection int DEFAULT 0,
        nb_connection_failed int DEFAULT 0,
        current_connection TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        last_connection TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        is_blocked tinyint(1) DEFAULT 0,
        constraint user_pk
            primary key (id)
    );
    
    create unique index user_email_uindex
        on user (email);
    
    create unique index user_password_uindex
        on user (password);
    
    create unique index user_username_uindex
        on user (username)
)";

// create recuperation
$_SQL_table_recuperation = "create table recuperation(
        id int auto_increment,
        mail varchar(255) not null,
        code varchar(50),
        last_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        constraint recuperation_pk
            primary key (id)
    );";

$successfull = false;
// Create database
try {
    $_O_conn_db = new PDO("mysql:host=$_S_hostname", $_S_username, $_S_password);
    // setting the PDO error mode to exception
    $_O_conn_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $_SQL_create = "CREATE DATABASE $_S_dbname";
    // using exec() because no results are returned
    $create = $_O_conn_db->exec($_SQL_create);
    if($create){
        $successfull = true;
    }
    echo "Database created successfully with the name $_S_dbname <br>";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br>";
}

if($successfull){
    $db = DB::getInstance();
    // Create table
    // Create degree
    try {
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sql to create table degree
        // $_SQL_table_degree
        // use exec() because np results are returned
        $db->exec($_SQL_table_degree);
        echo "Table degree created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    // Create documentation
    try {
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sql to create table documentation
        // $_SQL_table_doc
        // use exec() because np results are returned
        $db->exec($_SQL_table_doc);
        echo "Table documentation created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    // Create user
    try {
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sql to create table user
        // $_SQL_table_user
        // use exec() because np results are returned
        $db->exec($_SQL_table_user);
        echo "Table user created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }

    // Create recuperation
    try {
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Sql to create table user
        // $_SQL_table_user
        // use exec() because np results are returned
        $db->exec($_SQL_table_recuperation);
        echo "Table recuperation created successfully <br>";

    } catch (PDOException $e){
        echo $e->getMessage() . "<br>";
    }
}else{
    echo 'Cant create database table';
}



