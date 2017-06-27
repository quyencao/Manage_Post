<?php require_once ("../includes/config.php"); ?>
<?php include_once ("../includes/layout/header.php"); ?>

<?php
    if(isset($_GET["update_id"])) {
        $post = Posts::get_post_by_id($connection, $_GET["update_id"]);
    } else {
        $post = Post::create_empty_post();
    }
?>

<?php
    if(isset($_POST["submit"])) {
        $title = $_POST["title"];
        $desc = $_POST["description"];
        $status = $_POST["status"];
        $image = $_FILES["image"]["name"];

        if($title == "" || $desc == "" || !in_array($status, array("0", "1"))) {
            $error = "Field must not be empty";
        } else {
            if(isset($_GET["update_id"])) {
                if($_FILES["image"]["error"] > 0) {
                    $image = $post->image;
                } else {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "../public/img/" . $_FILES["image"]["name"]);
                }
                Post::set_new_properties($post, $title, $desc, $image,(int)$status);
                Posts::update($connection, $post);
            }
            header("Location: index.php");
        }
    }
?>

<h1 class="col-sm-offset-2">Edit
    <a href="index.php" class="btn btn-primary">Back</a>
    <a href="" class="btn btn-default">Show</a>
</h1>

<form class="form-horizontal" method="post" action="edit.php?update_id=<?php echo isset($_GET["update_id"]) ? $_GET["update_id"] : -1 ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Title</label>
        <div class="col-sm-4">
            <input name="title" type="text" class="form-control" id="title" placeholder="title" value="<?php echo $post->title; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Description:</label>
        <div class="col-sm-10">
            <textarea name="description" id="description" cols="90" rows="10"><?php echo $post->description; ?>
            </textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="image">Image</label>
        <div class="col-sm-4">
            <input name="image" type="file" class="form-control" id="image" placeholder="Image">
        </div>
        <?php if(!empty($post->image)): ?>
            <div>
                <img src='../public/img/<?php echo $post->image ?>' width='200px' />
            </div>
        <?php endif; ?>
<!--        <img src="" alt="">-->
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="image">Status</label>
        <div class="col-sm-4">
            <select name="status" id="status" class="form-control">
                <option value="0" <?php $post->status == 0 ? 'selected' : '' ?>>Disable</option>
                <option value="1" <?php $post->status == 1 ? 'selected' : '' ?>>Enable</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            <input name="submit" type="submit" value="Submit" class="btn btn-primary">
        </div>
    </div>
</form>
<?php if(isset($error)): ?>
    <div class="col-sm-8 col-sm-offset-2 alert alert-danger">
        <?php echo $error; ?>
    </div>
<?php endif; ?>
<?php include_once ("../includes/layout/footer.php"); ?>

