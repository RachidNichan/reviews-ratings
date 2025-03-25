<?php

if (!defined("nichan")):
    Redirect::to($site->url.'/404');
endif;

if ($user->isLoggedIn()):
    Redirect::to($site->url);
endif;

require './views/themes/nichan/layout/register/content.php';

?>