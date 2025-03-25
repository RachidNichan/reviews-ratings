<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST'):
    exit();
endif;

$admin = new Admin();

if (Input::get('b') == 'edit_custom_page'){
    
    if (Input::exists()) {
        
        if (Token::check(Input::get('token_id'))) {

            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'page_name' => array(
                    'name'     => 'Page Name',
                    'required' => true,
                    'min'      => 2,
                    'max'      => 50,
                    'unique'   => 'nr_custompages'
                ),
                'page_title' => array(
                    'name'     => 'Page Title',
                    'required' => true,
                    'min'      => 2,
                    'max'      => 200,
                ),
                'page_content' => array(
                    'name'     => 'Page Content',
                    'required' => true
                )
            ));

        if ($validation->passed()) {

            $update = $admin->updateCustomPage(array(
                'page_name' => Input::get('page_name'),
                'page_title'    => Input::get('page_title'),
                'page_content' => Input::get('page_content', false)
            ), Input::get('id'));

            if ($update) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Page added successfully',
                    'location' => $site->dir_admin.'/manage-custom-pages'
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

if (Input::get('b') == 'add_new_page'){
    
    if (Input::exists()) {
        
        if (Token::check(Input::get('token_id'))) {

            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'page_name' => array(
                    'name'     => 'Page Name',
                    'required' => true,
                    'min'      => 2,
                    'max'      => 50,
                    'unique'   => 'nr_custompages'
                ),
                'page_title' => array(
                    'name'     => 'Page Title',
                    'required' => true,
                    'min'      => 2,
                    'max'      => 200,
                ),
                'page_content' => array(
                    'name'     => 'Page Content',
                    'required' => true
                )
            ));

        if ($validation->passed()) {

            $create = $admin->addNewPage(array(
                'page_name' => Input::get('page_name'),
                'page_title'    => Input::get('page_title'),
                'page_content' => Input::get('page_content', false)
            ));

            if ($create) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Page added successfully',
                    'location' => $site->dir_admin.'/manage-custom-pages'
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

if (Input::get('b') == 'update_terms_setting'){
    
    if (Input::exists()) {
        
        if (Token::check(Input::get('token_id'))) {

            foreach ($_POST as $key => $value) {
                $update = $admin->updateTerms($key, $value);
            }

            if ($update) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Settings updated successfully'
                );
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

if (Input::get('b') == 'design_settings'){
    
    if (Input::exists()) {
        
        if (Token::check(Input::get('token_id'))) {

            foreach ($_POST as $key => $value) {
                $update = $admin->updateConfig($key, $value);
            }

            if ($update) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Settings updated successfully'
                );
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

if (Input::get('b') == 'ads_settings'){
    
    if (Input::exists()) {
        
        if (Token::check(Input::get('token_id'))) {

            foreach ($_POST as $key => $ads) {
                $update = $admin->updateAdsCode($key, $ads);
            }

            if ($update) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Settings updated successfully'
                );
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

if (Input::get('b') == 'delete'){

    if (Input::exists()) {
        
            $delete = $admin->deleteData(Input::get('action'), Input::get('id'));

            if ($delete) {
                $data = array(
                    'status' => 'success'
                );
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

if (Input::get('b') == 'add_new_language'){
    
    if (Input::exists()) {
        
        if (Token::check(Input::get('token_id'))) {

            $create = $admin->addNewLanguage(Input::get('lang'));

            if ($create) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Settings updated successfully'
                );
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

if (Input::get('b') == 'add_new_key'){
    
    if (Input::exists()) {
        
        if (Token::check(Input::get('token_id'))) {

            $create = $admin->addNewKey(array('lang_key' => Input::get('lang_key')));

            if ($create) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Key successfully added'
                );
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

if (Input::get('b') == 'update_config'){
    
    if (Input::exists()) {
        
        if (Token::check(Input::get('token_id'))) {

            foreach ($_POST as $key => $value) {
                $update = $admin->updateConfig($key, $value);
            }

            if ($update) {
                $data = array(
                    'status' => 'success',
                    'message' => 'Settings updated successfully'
                );
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