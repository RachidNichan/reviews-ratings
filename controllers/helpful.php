<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST'):
    exit();
endif;

if (Input::get('b') == 'create'){
  $helpful = new Review();
  switch(Input::get('action')){
    case 0:
        $create = $helpful->createHelpful(array(
            'user_id' => $user->data()->id,
            'post_id' => Input::get('id'),
            'time'    => time()
        ));
    break;
    case 1:
        $delete = $helpful->deleteHelpful(Input::get('id'));
    break;
  }
}

?>