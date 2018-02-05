<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends EasyAdminController
{
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }
}
