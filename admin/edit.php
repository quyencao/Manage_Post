<?php require_once ("../includes/config.php"); ?>
<?php include_once ("../includes/layout/header.php"); ?>

<?php
if(isset($_GET["update_id"])) {
    $post = Posts::get_post_by_id($connection, $_GET["update_id"]);
    $_FILES["image"]["name"] = $post->image;
} else {
    $post = Post::create_empty_post();
}
?>

<h1 class="col-sm-offset-2">Edit
    <a href="index.php" class="btn btn-primary">Back</a>
    <a href="" class="btn btn-default">Show</a>
</h1>

<form id="edit_post" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <input name="id" type="text" hidden value="<?php echo $post->id; ?>">
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
            <input type="text" hidden name="old_image" value="<?php echo $post->image; ?>">
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

<div id="errors" class="col-sm-8 col-sm-offset-2">

</div>

<script>
    $("input[type=submit]").on("click", function (event) {
        event.preventDefault();

        var form_data = new FormData(document.getElementById("edit_post"));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_edit.php", true);
        xhr.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
//                console.log(this.responseText);
                try {
                    var json = JSON.parse(this.responseText);
                    $("#errors").addClass("alert alert-danger").html(json.errors);
                } catch (e) {
                    window.location.href = "index.php";
                }
            }
        }
        xhr.send(form_data);
    });
</script>

<?php include_once ("../includes/layout/footer.php"); ?>

