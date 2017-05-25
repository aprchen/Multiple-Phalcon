<?php
namespace Multiple\Backend\Controllers;
use Multiple\Backend\Auth\AjaxBj;
use Phalcon\Mvc\View;
use Sl\Models\Node;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('首页');
        parent::initialize();
    }

    public function indexAction()
    {

    }

}
