<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

$user = new User();
$user->logout();

Redirect::to($site->url);

?>