<?php

$container['HomeController'] = function($c) {
    return new \App\Controller\HomeController($c);
};