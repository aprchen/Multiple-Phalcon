<?php
namespace Multiple\Backend\Controllers;

use Sl\Models\User;

class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('登陆/登出');
        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->tag->setDefault('phone', '手机号~');
            $this->tag->setDefault('password', '密码');
        }
    }


    private function _registerSession(User $user)
    {
        $this->session->set('auth', array(
            'id' => $user->id,
            'name' => $user->name
        ));
    }


    public function startAction()
    {
        if ($this->request->isPost()) {

            $phone = $this->request->getPost('phone');
            $password = $this->request->getPost('password');

            $user = User::findFirst(array(
                "phone = :phone: AND password = :password: AND is_validated = '1'",
                'bind' => array('phone' => $phone, 'password' => $this->crypt->encrypt($password))
            ));
            if ($user != false) {
                $this->_registerSession($user);

                return $this->dispatcher->forward(
                    [
                        "controller" => "invoices",
                        "action"     => "index",
                    ]
                );
            }

        }

        return $this->dispatcher->forward(
            [
                "controller" => "session",
                "action"     => "index",
            ]
        );
    }


    public function endAction()
    {
        $this->session->remove('auth');

        return $this->dispatcher->forward(
            [
                "controller" => "index",
                "action"     => "index",
            ]
        );
    }
}
