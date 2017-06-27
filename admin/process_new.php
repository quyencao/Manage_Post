<?php
require_once ("../includes/config.php");

$errors = "";

$title = $_POST["title"];
$desc = $_POST["description"];
$status = $_POST["status"];
$image = $_FILES["image"]["name"];

 if(strlen($title) == 0) {
     $errors .= "<div>Title is empty</div>";
 }

 if(strlen($desc) == 0) {
     $errors .= "<div>Description is empty</div>";
 }

if(!in_array($status, ["0", "1"])) {
    $errors .= "<div>Status is wrong</div>";
}

if($_FILES["image"]["error"] > 0) {
    $errors .= "<div>Image is empty</div>";
}

if(!empty($errors)) {
    $result = array("errors" => $errors, "status" => 500);
    echo json_encode($result);
} else {
    move_uploaded_file($_FILES["image"]["tmp_name"], "../public/img/" . $_FILES["image"]["name"]);
    $post = new Post($title, $desc, $image,(int)$status);
    Posts::insert($connection, $post);
    echo json_encode(array("status" => 200));
 }