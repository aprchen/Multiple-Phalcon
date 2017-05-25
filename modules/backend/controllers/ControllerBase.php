<?php
namespace Multiple\Backend\Controllers;
use Multiple\Backend\Auth\AjaxBj;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        $this->tag->prependTitle('你的网站 | ');
    }

}
