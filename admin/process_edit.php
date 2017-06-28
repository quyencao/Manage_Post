<?php
 require_once ("admin_header.php");
 require_once(ABSPATH . "config.php");

$errors = "";

$id = $_POST["id"];
$title = $_POST["title"];
$desc = $_POST["description"];
$status = $_POST["status"];
$image = $_FILES["image"]["name"];
//echo $image;

if(strlen($title) == 0) {
    $errors .= "<div>Title is empty</div>";
}

if(strlen($desc) == 0) {
    $errors .= "<div>Description is empty</div>";
}

if(!in_array($status, ["0", "1"])) {
    $errors .= "<div>Status is wrong</div>";
}

if(!empty($errors)) {
    $result = array("errors" => $errors, "status" => 500);
    echo json_encode($result);
} else {
    if(!empty($_FILES["image"]["name"])) {
        move_uploaded_file($_FILES["image"]["tmp_name"], ABSPATH . 'img/' . $_FILES["image"]["name"]);
    } else {
        $image = $_POST["old_image"];
    }

    $post = new Post($title, $desc, $image,(int)$status);

    Posts::update($connection, $post, $id);
    echo json_encode(array("status" => 200));
}