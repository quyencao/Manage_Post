<?php require_once ("../includes/config.php"); ?>
<?php include_once ("../includes/layout/header.php"); ?>
    <?php
        if(isset($_GET["id"])) {
            $post = Posts::get_post_by_id($connection, $_GET["id"]);
        }
    ?>
    <?php if(isset($post)): ?>
        <div class="row">
            <h1><?php echo $post->title; ?>
                <a class="btn btn-default pull-right" href="index.php">Back</a>
            </h1>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <img class="img-responsive" src="img/<?php echo $post->image; ?>" alt="">
            </div>
            <div class="col-md-8">
                <?php echo $post->description; ?>
            </div>
        </div>
    <?php endif; ?>
<?php include_once ("../includes/layout/footer.php"); ?>
