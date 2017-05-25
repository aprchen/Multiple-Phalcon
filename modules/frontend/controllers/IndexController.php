<?php
namespace Multiple\Frontend\Controllers;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->flash->error('frontend');
        $this->flash->success('asdasd');
        $this->flash->warning('asdasd');
        $this->flash->notice('asdasd');
    }

}

