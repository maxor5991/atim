<?php

include "../includes/dbconfig.php";
include "../includes/db.php";

session_start();

$db = new Db();
$result = $db->query("SELECT * FROM `posts` ORDER BY created DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog admin panel</title>
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<div class="container">

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Admin panel</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active" id="post-new"><a href="#">New</a></li>
                    <li><a href="#" id="post-list">Posts</a></li>
                    <li><a href="#" id="categories-editor">Categories</a></li>
                    <li><a href="../" id="categories-editor">Blog</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="form-group">
        <input type="text" class="form-control" id="title" placeholder="Your title" required>
        <br>
        <input type="text" class="form-control" id="slug" placeholder="Your slug">
        <br>
        <textarea class="form-control" rows="10" id="post" placeholder="Your blog-post" required></textarea>
        <br>
        <button type="button" id="post-send" class="btn btn-success">Publish blog-post</button>
    </div>

    <div class="message-done" style="display: none;">
        Success!
    </div>

    <div class="post-list-container" style="display: none;">
        <div class="container">
            <div class="col-md-12">
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo '<div data-id="' . $row['id'] . '"><h1>' . $row['name'] . '</h1><p>' . $row['content'] . '</p><div><span class="badge">' . $row['created'] . '</span>
          <div class="pull-right">
               <span class="label label-default">category</span>
               <span class="label label-primary">category</span>
               <span class="label label-success">category</span>
               <span class="label label-info">category</span>
               <span class="label label-warning">category</span>
               <span class="label label-danger">category</span>
           </div>
       </div>
       <br>
       <button type="button" class="btn btn-danger button-delete">Delete</button>
       </div>
       <hr>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="categories-editor-container" style="display: none;">

    </div>

</div>

<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>
    $(document).on('ready', function () {
        $('.navbar-nav li').on('click', function () {
            $('.navbar-nav li').removeClass('active');
            $(this).addClass('active');
        });

        $('#post-send').on('click', function () {
            if ($('#title').val() && $('#post').val()) {
                $('.form-group').hide();
                $('.message-done').show();

                var postData = {
                    'event': 'admin',
                    'type': 'new',
                    'title': $('#title').val(),
                    'slug': $('#slug').val(),
                    'post': $('#post').val(),
                    'category': '1'
                };

                $.ajax({
                    type: 'POST',
                    url: 'admin.php',
                    data: postData,
                    success: function (response) {
                        console.log(response);
                    }
                });
            }
        });

        $('#post-new').on('click', function () {
            $('.form-group').show();
            $('.message-done').hide();
            $('.post-list-container').hide();
        });

        $('#post-list').on('click', function () {
            $('.form-group').hide();
            $('.message-done').hide();
            $('.post-list-container').show();
        });

        $('.button-delete').on('click', function () {
            var postID = $(this).parent().data('id');
            console.info(postID);
            //send ajax post with this ID to delete blog-post
        });
    })
</script>

</body>
</html>