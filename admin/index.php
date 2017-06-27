<?php require_once ("../includes/config.php"); ?>
<?php include_once ("../includes/layout/header.php"); ?>

    <?php
        if(isset($_GET["delete_id"])) {
            $delete_id = $_GET["delete_id"];
            Posts::delete($connection, $delete_id);
        }
    ?>

    <div>
        <h1>Manage
            <a href="new.php" class="btn btn-primary pull-right">New</a>
        </h1>
    </div>
    <hr>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $posts = Posts::getAllPosts($connection);

        foreach ($posts as $post) :
            ?>
            <tr>
                <td><?php echo $post->id; ?></td>
                <td><img class="img-responsive" src="../public/img/<?php echo htmlspecialchars($post->image); ?>" width="200px" alt=""></td>
                <td><?php echo $post->title; ?></td>
                <td><?php echo $post->status ? "Enabled" : "Disabled"; ?></td>
                <td>
                    <a href="../public/single_post.php?id=<?php echo htmlspecialchars($post->id); ?>">Show</a> |
                    <a href="edit.php?update_id=<?php echo htmlspecialchars($post->id); ?>">Edit</a> |
                    <a href="index.php?delete_id=<?php echo htmlspecialchars($post->id); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php include_once ("../includes/layout/footer.php"); ?>