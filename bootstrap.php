<?php

include __DIR__.'/helper.php';
include __DIR__.'/model.php';
include __DIR__.'/fetch.php';


spl_autoload_register('autoload');


function autoload ($cls_name) {
    $cls_name = strtolower($cls_name);
    load_fetch($cls_name);
}
