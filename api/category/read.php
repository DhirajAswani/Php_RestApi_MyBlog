<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../../config/Database.php';
require_once '../../models/Category.php';

//Instantiate Database
$database = new Database();
$db = $database->connect();

//Instantiate blog category object
$category = new Category($db);

//Blog category query

$result = $category->read();

//Get row count
$num = $result->rowCount();

//Check if any categorys
if ($num > 0) {
    $categorys_arr = array();
    $categorys_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // extract($row);

        // $category_item = array(
        //     'id' => $id,
        //     'title' => $title,
        //     'body' => html_entity_decode($body),
        //     'author' => $author,
        //     'category_id' => $category_id,
        //     'category_name' => $category_name
        // );

        $category_item = array(
            'id' => $row['id'],
            'name' => $row['name'],

        );

        //Push to "data"
        array_push($categorys_arr['data'], $category_item);
    }


    //turn it to json
    echo json_encode($categorys_arr);
} else {
    //No categorys
    echo json_encode(
        array('message' => 'No categorys Found')
    );
}
