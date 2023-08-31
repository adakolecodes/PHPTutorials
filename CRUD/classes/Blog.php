<?php

class Blog{
    //Create post method
    public function createPost($data){
        //Inlcude db connection
        include "../config/db-connect.php";

        //Extract data from $data array
        $title = $data['title'];
        $body = $data['body'];
        $featured_image = $data['featured_image'];

        //Create our sql query statement
        $sql = "INSERT INTO blog_posts (title, body, featured_image) VALUES (?, ?, ?)";
        //Prepare our statement
        $stmt = $pdo->prepare($sql);
        //Execute our statement
        $result = $stmt->execute([$title, $body, $featured_image]);

        return $result;
    }

    //Get all posts
    public function getAllPosts(){
        include "config/db-connect.php";
        $sql = "SELECT * FROM blog_posts";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        //Fetch our result and store it in the $posts variable (fetch is for fetching a single record, while fetchAll is for fetching multiple records)
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }

    //Get posts by id
    public function getPostById($id){
        include "config/db-connect.php";
        $sql = "SELECT * FROM blog_posts WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    //Get posts by title
    public function getPostByTitle($title){
        include "../config/db-connect.php";
        $sql = "SELECT * FROM blog_posts WHERE title = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        return $post;
    }

    public function updatePostWithImage($data){
        //Inlcude db connection
        include "../config/db-connect.php";

        //Extract data from $data array
        $id = $data['id'];
        $title = $data['title'];
        $body = $data['body'];
        $featured_image = $data['featured_image'];

        $sql = "UPDATE blog_posts SET title = ?, body = ?, featured_image = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$title, $body, $featured_image, $id]);
        return $result;
    }

    public function updatePostWithoutImage($title, $body, $id){
        //Inlcude db connection
        include "../config/db-connect.php";

        $sql = "UPDATE blog_posts SET title = ?, body = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$title, $body, $id]);
        return $result;
    }
}