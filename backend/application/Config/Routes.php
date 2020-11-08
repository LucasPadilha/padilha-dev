<?php

$App->get('/', 'HomeController:index')->setName('home.index');

$App->post('/contact', 'HomeController:contact')->setName('home.contact');