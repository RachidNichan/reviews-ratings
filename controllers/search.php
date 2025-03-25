<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST'):
    exit();
endif;

if (Input::get('b') == 'search_companies_home'){
    
    if (Input::exists()) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'query_companies' => array(
                'name'     => 'search',
                'required' => true
            )
        ));

        if ($validation->passed()) {

            $search = new Search(Input::get('query_companies'));
            $data_search = $search->data();

            if (!$search->exists()) {
                $location = $site->url.'/search/'.Input::get('query_companies');
            } else {
                $location = $site->url.'/review/'.$data_search->review_username;
            }

            $data = array(
                'status' => 'success',
                'location' => $location
            );

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

if (Input::get('b') == 'view_search_companies'){

    if (Input::exists()) {
        $search = new Search();

        $all_search = $search->getSearch(Input::get('query'), 0, 5);
        if ($all_search):
            foreach ($all_search as $search_data):
                $all_companies_data[] = $search_data->review_username;
            endforeach;
        endif;

        echo json_encode($all_companies_data);

    }

}

if (Input::get('b') == 'get_search'){

    if (Input::exists()) {

        $data = array(
            'status' => 'success',
            'location' => $site->url.'/search/'.Input::get('search')
        );
        
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

?>