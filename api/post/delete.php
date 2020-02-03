<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

//Delete Post
if ($post->delete()) {
    echo json_encode(
        array('message' => 'Post Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Deleted')
    );
}
