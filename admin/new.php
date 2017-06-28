<?php require_once ("admin_header.php"); ?>
<?php require_once(ABSPATH . "config.php"); ?>
<?php include_once (ABSPATH . "includes/layout/header.php"); ?>


<div class="row">
    <h1 class="col-sm-offset-2 col-sm-8">Edit
        <a href="index.php" class="btn btn-default pull-right">Back</a>
        <a href="" class="btn btn-primary pull-right">Show</a>
    </h1>
</div>

<div class="row">
    <form id="new_post" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Title</label>
            <div class="col-sm-4">
                <input name="title" type="text" class="form-control" id="title" placeholder="title">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Description:</label>
            <div class="col-sm-10">
                <textarea name="description" id="description" cols="105" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="image">Image</label>
            <div class="col-sm-4">
                <input name="image" type="file" class="form-control" id="image" placeholder="Image">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="image">Status</label>
            <div class="col-sm-4">
                <select name="status" id="status" class="form-control">
                    <option value="0" selected="selected">Disable</option>
                    <option value="1">Enable</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <input name="submit" type="submit" value="Submit" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>

<div class="col-md-8 col-md-offset-2" id="errors">

</div>
<script>
    $("input[type=submit]").on("click", function (event) {
        event.preventDefault();

        var form_data = new FormData(document.getElementById("new_post"));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process_new.php", true);
        xhr.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
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
