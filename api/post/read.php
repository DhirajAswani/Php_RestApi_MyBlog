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

//Blog post query

$result = $post->read();

//Get row count
$num = $result->rowCount();

//Check if any posts
if ($num > 0) {
    $posts_arr = array();
    $posts_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // extract($row);

        // $post_item = array(
        //     'id' => $id,
        //     'title' => $title,
        //     'body' => html_entity_decode($body),
        //     'author' => $author,
        //     'category_id' => $category_id,
        //     'category_name' => $category_name
        // );

        $post_item = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'body' => $row['body'],
            'author' => $row['author'],
            'category_id' => $row['category_id'],
            'category_name' => $row['category_name']
        );

        //Push to "data"
        array_push($posts_arr['data'], $post_item);
    }


    //turn it to json
    echo json_encode($posts_arr);
} else {
    //No posts
    echo json_encode(
        array('message' => 'No Posts Found')
    );
}
