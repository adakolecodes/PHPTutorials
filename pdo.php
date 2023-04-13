<?php
/*

 WHAT IS PDO?
 PDO Stands for PHP Data Objects and it is a PHP extension which is a consistent way to access databases
 It can be used in place of mysqli
 PDO works with multiple database systems - mysql, firebird, MS Sql, ORACLE etc
 PDO provides a data access layer - no matter the database you are using you use the same functions to execute queries and fetch data.
 PDO is completely object oriented with methods and properties
 PDO It will not run on PHP 4
 
 BENEFITS OF PDO
 - Multiple databases: Works with multiple databases
 - Security: PDO uses prepared statements which helps prevent your database from sql injections. Sql injection is where someone tries to 
 insert sql statements and instructions through user inputs which can destroy your database. 
 A prepared statement is a precompiled sql statement that separates the instruction of the sql statement from the data.
 - Usability: It is very usable and has tonns of functions that can automate routine operations
 - Reusability
 - Excellent error handling
 
 MAIN PDO CLASSES
 1. PDO Class: Represents the connection between PHP and the database
 2. PDOStatement class: Represents the prepared statement and after it is executed the associated result from that statement
 3. PDOException class: Represents errors raised by PDO
 
 */

//CREATE DATABASE VARIABLES
$host = "localhost";
$user = "root";
$password = "";
$dbname = "phptutorials";

//Create a PDO instance which takes in the host, dbname, user and password
$pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $password);





/*
PREPARED STATEMENTS
With preprared statements we have two main methods - Prepare and Execute
There are two ways to use prepared statements - Positional Params and
*/

//User Input
$author = "Brad";
$is_published = true;
$id = 3;



//SELECT keyword

//Positional Params
//Fetch Multiple Posts
//Create our sql query statement
$sql = "SELECT * FROM posts WHERE author = ?";
//Prepare our statement
$stmt = $pdo->prepare($sql);
//Execute our statement
$stmt->execute([$author]);
//Fetch all posts
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


//Loop through all posts
foreach($posts as $post){
    echo "{$post['body']} <br>";
}


//Named Params
//Fetch Multiple Posts
//Create our sql query statement
$sql = "SELECT * FROM posts WHERE author = :author AND is_published = :is_published";
//Prepare our statement
$stmt = $pdo->prepare($sql);
//Execute our statement
$stmt->execute(["author" => $author, "is_published" => $is_published]);
//Fetch all posts
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Loop through all posts
foreach($posts as $post){
    echo "{$post['title']} <br>";
}


//Fetch Single Post
//Create our sql query statement
$sql = "SELECT * FROM posts WHERE id = ?";
//Prepare our statement
$stmt = $pdo->prepare($sql);
//Execute our statement
$stmt->execute([$id]);
//Fetch single post
$post = $stmt->fetch(PDO::FETCH_ASSOC);

echo "{$post['author']} <br>";


//GET ROW COUNT
//Create our sql query statement
$sql = "SELECT * FROM posts";
//Prepare our statement
$stmt = $pdo->prepare($sql);
//Execute our statement
$stmt->execute();
//Get row count
$postCount = $stmt->rowCount();

echo $postCount;

