<?php

namespace Watson\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Watson\Domain\Link;
use Watson\Domain\User;
use Watson\Domain\Tag;
use Watson\Form\Type\LinkType;
use Watson\Form\Type\UserType;

class LinkController {

public function indexAction ($page, Application $app){

    $users = $app['dao.user']->findAll();
    

    $linkPerPage = 15;
    $linkCount = $app['dao.link']->countAll();
    

    $nbPages =ceil($linkCount / $linkPerPage);
    
    if($page > $nbPages) {

        $page = $nbPages;

    }

    $links =$app['dao.link']->findByPage($page, $linkPerPage);

    return $app['twig']->render('admin.html.twig', array (

        'links' => $links,
        'users' => $users));

}

}
