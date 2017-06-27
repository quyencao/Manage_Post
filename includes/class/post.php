<?php

    class Post {
        public $id;
        public $title;
        public $description;
        public $image;
        public $status;
        public $create_at;
        public $update_at = null;

        public function __construct(
            string $title,
            string $description,
            string $image,
            int $status
        ) {
            $this->title = $title;
            $this->description = $description;
            $this->image = $image;
            $this->status = $status;
        }

        public static function create(
            int $id,
            string $title,
            string $description,
            string $image,
            int $status,
            $create_at,
            $update_at
        ) {
            $instance = new self($title, $description, $image, $status);
            $instance->id = $id;
            $instance->create_at = $create_at;
            $instance->update_at = $update_at;

            return $instance;
        }

        public static function create_empty_post() {
            return new self("", "", "", 0);
        }

        public static function set_new_properties(
            Post $post,
            string $title,
            string $description,
            string $image,
            int $status
        ) {
            $post->title = $title;
            $post->description = $description;
            $post->image = $image;
            $post->status = $status;
        }
    }