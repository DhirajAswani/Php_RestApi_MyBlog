<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
        Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

//Instantiate Database
$database = new Database();
$db = $database->connect();

//Instantiate blog post object
$post = new Post($db);


//Get the raw Posted data. We can also get the data using GET['title'] method

$data = json_decode(file_get_contents("php://input"));

//SET ID  to update

$post->id = $data->id;
$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Update Post
if ($post->update()) {
    echo json_encode(
        array('message' => 'Post Updated')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}
