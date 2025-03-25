<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST'):
    exit();
endif;

if (Input::get('b') == 'update'){
    
    if (Input::exists()) {

        if (Token::check(Input::get('token_id'))) {
    
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'lang_code' => array(
                'name'     => $lang->get('language'),
                'required' => true
            )
        ));
    
        if ($validation->passed()) {
            $user = new User();

                $update = $user->update(array(
                    'lang_code'    => Input::get('lang_code'),
                    'user_about'    => Input::get('user_about')
                ));
    
                if ($update) {
                    $image = new Images();
                    if ($image->uploadImage($_FILES["avatar"]["tmp_name"], $_FILES['avatar']['name'], 'avatar', $_FILES['avatar']['type'], $user->data()->id, 'user') === true) {
                    }
                    $data = array(
                        'status' => 'success',
                        'message' => $lang->get('setting_updated')
                    );
                }
    
        } else {
            foreach ($validation->errors() as $error) {
                $errors[] = $validation->errors();
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

if (Input::get('b') == 'login'){
    
    if (Input::exists()) {
    
        if (Token::check(Input::get('token_id'))) {
    
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'user_email' => array(
                'name'     => $lang->get('email'),
                'required' => true,
                'email' => true,
            ),
            'user_password' => array(
                'name'     => $lang->get('password'),
                'required' => true
            )
        ));
    
        if ($validation->passed()) {
            $user = new User();
            $login = $user->login(Input::get('user_email'), Input::get('user_password'));
            
            if ($login) {
                $data = array(
                    'status' => 'success',
                    'message' => $lang->get('welcome'),
                    'location' => $site->url
                );
            } else {
                $errors[] = $lang->get('incorrect_email_or_password_label');
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

if (Input::get('b') == 'register'){

    if (Input::exists()) {
    
        if (Token::check(Input::get('token_id'))) {
    
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'user_username' => array(
                'name'     => $lang->get('username'),
                'required' => true,
                'username' => true,
                'min'      => 5,
                'max'      => 32,
                'unique'   => 'nr_users'
            ),
            'user_email' => array(
                'name'     => $lang->get('email'),
                'required' => true,
                'email' => true,
                'unique'   => 'nr_users'
            ),
            'user_password' => array(
                'name'     => $lang->get('password'),
                'required' => true,
                'min'      => 6
            )
        ));

    if ($site->get('user_registration') == 1) {
    
        if ($validation->passed()) {
            $user = new User();

            $ip     = '0.0.0.0';
            $get_ip = User::getIpAddress();
            if (!empty($get_ip)) {
                $ip = $get_ip;
            }

            $activate = ($site->get('email_validation') == '1') ? '0' : '1';

                $register = $user->create(array(
                    'user_username' => Input::get('user_username'),
                    'user_email'    => Input::get('user_email'),
                    'user_password' => Hash::password(Input::get('user_password')),
                    'user_avatar' => Images::createAvatar(strtoupper(Input::get('user_username')[0])),
                    'ip_address' => $ip,
                    'country_code' => 'ma',
                    'email_status' => $activate,
                    'email_code' => Hash::unique(20),
                    'device' => User::getDevice(),
                    'browser' => json_encode(User::getBrowser()),
                    'time' => time(),
                    'registered' => date("m/Y")
                ));
    
                if ($register) {

                    $user = new User();
                    $login = $user->login(Input::get('user_email'), Input::get('user_password'));

                    if ($login) {
                        $data = array(
                            'status' => 'success',
                            'message' => $lang->get('welcome'),
                            'location' => $site->url
                        );
                    }

                }
    
        } else {
            foreach ($validation->errors() as $error) {
                $errors[] = $error.'<br>';
            }
        }

    } else {
        $errors = '';
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