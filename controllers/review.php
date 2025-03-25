<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST'):
    exit();
endif;

if (Input::get('b') == 'step_2'){

    if (Input::exists()) {
    
        if (Token::check(Input::get('token_id'))) {
            $review_data = new Review(Input::get('id'));

            if ($review_data->data()->review_user_id == $user->data()->id) {
                 $review = new Review();
                 $getmcategory = new Categories();

                $update = $review->update(array(
                    'review_category_main' => $getmcategory->getIdMainCategory(Input::get('review_category')),
                    'review_category' => Input::get('review_category'),
                    'review_description' => Input::get('review_description'),
                    'review_step_info' => 1
                ), Input::get('id'));

                if ($update) {
                    $data = array(
                        'status' => 'success',
                        'location' => $site->url.'/review/'.$review_data->data()->review_username
                    );
                }
            }

            header("Content-type: application/json");
            if (isset($errors)):
                echo json_encode(array(
                    'errors' => $errors
                ));
            else:
            echo json_encode($data);
            endif;
        
            exit();

        }

    }

}

if (Input::get('b') == 'create'){

    if (Input::exists()) {
    
        if (Token::check(Input::get('token_id'))) {
    
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'review_name' => array(
                'name'     => $lang->get('review_name'),
                'required' => true,
                'min'      => 2,
                'max'      => 32
            ),
            'review_url' => array(
                'name'     => $lang->get('website_url'),
                'required' => true,
                'url' => true,
                'unique'   => 'nr_review'
            )
        ));
    
        if ($validation->passed()) {
            $review = new Review();

            $create = $review->create(array(
                'review_user_id' => $user->data()->id,
                'review_username'    => Review::getDomainHost(Input::get('review_url')),
                'review_name' => Input::get('review_name'),
                'review_url'    => Input::get('review_url'),
                'review_avatar' => Images::createAvatar(strtoupper(Input::get('review_name')[0])),
                'review_time'    => time(),
                'registered'    => date("m/Y")
            ));

            if ($create) {
                $review = new Review(Review::getDomainHost(Input::get('review_url')));

                $data = array(
                    'status' => 'success',
                    'location' => $site->url.'/create-review/'.$review->data()->review_username
                );
            }

        } else {
            foreach ($validation->errors() as $error) {
                $errors[] = $error.'<br>';
            }
        }
        
        header("Content-type: application/json");
        if (isset($errors)):
            echo json_encode(array(
                'errors' => $errors
            ));
        else:
        echo json_encode($data);
        endif;
    
        exit();
    
        }
    
    }

}

?>