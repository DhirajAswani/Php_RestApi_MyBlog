<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

//Instantiate Database
$database = new Database();
$db = $database->connect();

//Instantiate blog post object
$post = new Post($db);

//Get Id from url

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get Post 
$post->read_single();

//create_array
$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name

);

//Make json

print_r(json_encode($post_arr));
