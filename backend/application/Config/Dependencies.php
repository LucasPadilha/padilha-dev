<?php
// get the container
$container = $App->getContainer();

// database
$container['database'] = function($c) {
    $capsule = new \Illuminate\Database\Capsule\Manager();
    $capsule->addConnection($c->get('settings')['database'][$c->get('settings')['environment']]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};