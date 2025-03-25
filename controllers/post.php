<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST'):
    exit();
endif;

if (Input::get('b') == 'delete'){
    $post = new Review();
    $delete = $post->deletePost(Input::get('id'));
}

if (Input::get('b') == 'create'){

    if (Input::exists()) {
    
        if (Token::check(Input::get('token_id')) && !empty(Input::get('post_content'))) {

            $post = new Review();

            $create = $post->createPost(array(
                'user_id' => $user->data()->id,
                'post_content'    => Input::get('post_content'),
                'review_id' => Input::get('review_id'),
                'rating' => Input::get('rating_data'),
                'time'    => time(),
                'registered'    => date("m/Y")
            ));

            if ($create) {
                $posts = new Review();
                foreach ($posts->getPostsInReview(Input::get('review_id'), 0, 1) as $post_data):
                    $user_post = new User($post_data->user_id);
                    include './views/themes/nichan/layout/posts/content.php';
                endforeach;
            }
            
        exit();
    
        }
    
    }

}

?>