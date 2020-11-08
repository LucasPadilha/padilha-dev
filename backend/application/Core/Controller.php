<?php

namespace App\Core;

use Slim\Container;

class Controller
{
    protected $container;

    protected $settings;

    protected $db;

    public function __construct(Container $container)
    {
        $this->container = $container;

        $this->settings = $this->container->get('settings');

        $this->db = $this->container->get('database');
    }
}