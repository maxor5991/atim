<?php
header('Content-Type: text/html; charset=utf-8');
include "../includes/dbconfig.php";
include "../includes/db.php";

session_start();

class admin
{
    private $event;
    private $type;
    private $title;
    private $category;
    private $slug;
    private $post;

    function __construct()
    {
        $this->event = isset($_POST['event']) ? $_POST['event'] : null;
        $this->type = isset($_POST['type']) ? $_POST['type'] : null;
        $this->title = isset($_POST['title']) ? $_POST['title'] : null;
        $this->category = isset($_POST['category']) ? $_POST['category'] : null;
        $this->slug = isset($_POST['slug']) ? $_POST['slug'] : null;
        $this->post = isset($_POST['post']) ? $_POST['post'] : null;
    }

    function start()
    {
        if ($this->type == 'new') {
            $db = new Db();

            $insertQuery = "INSERT INTO `posts` (`id`, `category_id`, `user_id`, `name`, `slug`, `content`, `created`) VALUES (NULL, '1', '2', '$this->title', '$this->slug', '$this->post', NOW())";

            $result = $db->query($insertQuery);
            if ($result) {
                echo 'Post successfully added';
            }
        }

    }
}

$admin = new admin();

if (!empty($_POST)) {
    $admin->start();
}