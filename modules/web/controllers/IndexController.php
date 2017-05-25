<?php
namespace Multiple\Web\Controllers;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
      echo "web";
    }

    public function route404Action(){
        exit('not find');
    }

}

