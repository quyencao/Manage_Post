<?php require_once("config.php"); ?>
<?php include_once(ABSPATH . "includes/layout/header.php"); ?>

    <table id="posts" class="table table-bordered table-striped">
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

    <div class="row">
        <div class="col-md-2">
            Page:
            <select name="" id="pages">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="all">All</option>
            </select>
        </div>
        <div class="col-md-8 text-center">
            <ul class="pagination">

            </ul>
        </div>
    </div>

    <script>
        (function () {
            var numberOfPosts = $("#posts tr").length;
            var postPerPage = 5;
            var minPages = Math.floor(numberOfPosts / postPerPage);
            var pages = numberOfPosts % postPerPage == 0 ? minPages : minPages + 1;

            $(".pagination").on('click', function (e) {
                var page = parseInt(e.target.textContent);

                $(".pagination li").removeClass("active");
                $(e.target).parent().addClass("active");

                $("#posts tbody tr").each(function (index) {
                    if(index >= (page - 1) * postPerPage && index < page * postPerPage) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $("#pages").change(function (e) {
                if(e.target.value == "all") {
                    postPerPage = numberOfPosts;
                } else {
                    postPerPage = parseInt(e.target.value);
                }

                minPages = Math.floor(numberOfPosts / postPerPage);
                pages = numberOfPosts % postPerPage == 0 ? minPages : minPages + 1;

                generatePagination();
                init();
            });

            function init() {
                $(".pagination li:first-child").addClass("active");

                $("#posts tbody tr").each(function (index) {
                    if(index >= 0 && index < postPerPage) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            function generatePagination() {
                $(".pagination li").remove();
                for(var i = 1; i <= pages; i++) {
                    $(".pagination").append("<li><a>" + i + "</a></li>");
                }
            }

            generatePagination();
            init();
        })();
    </script>


<?php include_once(ABSPATH . "includes/layout/footer.php"); ?>

