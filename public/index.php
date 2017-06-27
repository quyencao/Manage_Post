<?php require_once ("../includes/config.php"); ?>
<?php include_once ("../includes/layout/header.php"); ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Thumbnail</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $posts = Posts::getAllPosts($connection);

                foreach ($posts as $post) :
            ?>
                <tr>
                    <td><?php echo $post->id; ?></td>
                    <td><img class="img-responsive" src="img/<?php echo $post->image; ?>" width="200px" alt=""></td>
                    <td><a href="single_post.php?id=<?php echo htmlspecialchars($post->id); ?>"><?php echo $post->title; ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <ul class="pagination">
        <?php
            $numberOfPosts = count($posts);
            echo $numberOfPosts;
            $postPerPage = 5;
            $minPages = floor($numberOfPosts / $postPerPage);
            $pages = $numberOfPosts % $postPerPage == 0 ?  $minPages : $minPages + 1;

            for($i = 1; $i <= $pages; $i++):
        ?>
            <li><a href="#"><?php echo $i; ?></a></li>
        <?php
            endfor;
        ?>
    </ul>


<?php include_once ("../includes/layout/footer.php"); ?>

