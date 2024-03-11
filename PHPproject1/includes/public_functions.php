<?php

//Returns all published posts

function getPublishedPosts($conn) {
    $sql = "SELECT * FROM posts WHERE published = true";
    $result = mysqli_query($conn, $sql);

    //fetch all posts as associative array
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();
    foreach($posts as $post) {
        $post['topic'] = getPostTopic($conn, $post['id']);
        array_push($final_posts, $post);
    }
    return $final_posts;
}

function getPostTopic($conn, $post_id) {
    $sql = "SELECT * FROM topics WHERE id = (SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $topic = mysqli_fetch_assoc($result);
    return $topic;
}

/* * * * * * * * * * * * * * * *
* Returns all posts under a topic
* * * * * * * * * * * * * * * * */
function getPublishedPostsByTopic($conn, $topic_id) {
    $sql = "SELECT * FROM posts ps 
                    WHERE ps.id IN 
                    (SELECT pt.post_id FROM post_topic pt 
                            WHERE pt.topic_id=$topic_id GROUP BY pt.post_id 
                            HAVING COUNT(1) = 1)";

    $result = mysqli_query($conn, $sql);

     // Check for errors
     if (!$result) {
        echo "Error: " . mysqli_error($conn);
    }

    // fetch all posts as an associative array called $posts
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $final_posts = array();
    foreach ($posts as $post) {
            $post['topic'] = getPostTopic($conn, $post['id']); 
            array_push($final_posts, $post);
    }
    return $final_posts;
}
/* * * * * * * * * * * * * * * *
* Returns topic name by topic id
* * * * * * * * * * * * * * * * */
function getTopicNameById($conn, $id) {
    $sql = "SELECT name FROM topics WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $topic = mysqli_fetch_assoc($result);
    return $topic['name'];
}

/* * * * * * * * * * * * * * *
* Returns a single post
* * * * * * * * * * * * * * */
function getPost($conn, $slug){
    // Get single post slug
    $post_slug = $_GET['post-slug'];
    $sql = "SELECT * FROM posts WHERE slug='$post_slug' AND published=true";
    $result = mysqli_query($conn, $sql);

    // fetch query results as associative array.
    $post = mysqli_fetch_assoc($result);
    if ($post) {
            // get the topic to which this post belongs
            $post['topic'] = getPostTopic($conn, $post['id']);
    }
    return $post;
}
/* * * * * * * * * * * *
*  Returns all topics
* * * * * * * * * * * * */
function getAllTopics($conn) {
    $sql = "SELECT * FROM topics";
    $result = mysqli_query($conn, $sql);
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $topics;
}