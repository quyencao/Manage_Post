<?php
    require_once ("database.php");
    require_once ("post.php");

    class Posts {

        public static function getAllPosts($conn) {
            $result =  self::select($conn);
            if(is_null($result)) {
                return [];
            }

            $posts = [];
            foreach ($result as $post) {
                $postOb = Post::create($post['id'], $post['title'], $post['description'],
                    $post['image'], $post['status'], $post['create_at'], $post['update_at']);
                $posts[] = $postOb;
            }
            return $posts;
        }

        public static function get_post_by_id($conn, $id) {
            $post = self::select_by_id($conn, $id);

            if(is_null($post)) { return null; }

            $postObj = Post::create($post['id'], $post['title'], $post['description'],
                $post['image'], $post['status'], $post['create_at'], $post['update_at']);
            return $postObj;
        }

        public static function select($conn) {
            if($conn instanceof PDO) {
                $stmt =  $conn->prepare('SELECT * FROM posts');
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $stmt->execute();
                return $stmt->fetchAll();
            }
            return null;
        }

        public static function select_by_id($conn, $id) {
            if($conn instanceof PDO) {
                $stmt = $conn->prepare("SELECT * FROM posts WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt->fetch();
            }
            return null;
        }

        public static function delete($conn, $id) {
            if($conn instanceof PDO) {
                $stmt = $conn->prepare("DELETE FROM posts WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            }
            header("Refresh:0; url=index.php");
        }

        public static function insert(PDO $conn,Post $post) {
            $stmt = $conn->prepare('INSERT INTO posts(title, description, image, status, create_at)
              VALUES (:title,:description,:image,:status,:create_at)');

            $stmt->bindParam(':title', $post->title);
            $stmt->bindParam(':description', $post->description);
            $stmt->bindParam(':image', $post->image);
            $stmt->bindParam(':status', $post->status);
            $stmt->bindParam(':create_at', date("Y-m-d H:i:s"));

            $stmt->execute();
        }

        public static function update(PDO $conn, Post $post, $id) {
            $stmt = $conn->prepare('UPDATE posts SET title = :title, description = :description, 
              image = :image, status = :status, update_at = :update_at WHERE id = :id');
            $stmt->bindParam(':title', $post->title);
            $stmt->bindParam(':description', $post->description);
            $stmt->bindParam(':image', $post->image);
            $stmt->bindParam(':status', $post->status);
            $stmt->bindParam(':update_at', date("Y-m-d H:i:s"));
            $stmt->bindParam(':id', $id);

            $stmt->execute();
        }

    }