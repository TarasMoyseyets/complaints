<?php

return array(
    'news/([0-9]+)' => 'news/view/$1',
    'news' => 'news/index',  //method actionIndex  --- controller newsController
    'product' => 'product/list',
    'form' => 'complaints/add', //actionAdd
    'getpages' => 'complaints/getpages', //actionAdd
    'pagination' => 'complaints/pagination',
    'captcha' => 'complaints/captcha',
    'admin' => 'complaints/admin',
    'update' => 'complaints/update',
    'delete' => 'complaints/delete',
    'logout' => 'complaints/logout',
    'complaints' => 'complaints/index',
    

);

