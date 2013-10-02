<?php

class RegisterController extends Zend_Controller_Action
{

    public function init()
    {
       
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $register    = new Application_Form_Register();
        if ($this->getRequest()->isPost()) 
            {
            if ($register->isValid($request->getPost())) 
                {
                $sessionuserregister=new Zend_Session_Namespace('register');
                $userregistermodel = new Application_Model_User($register->getValues());
                $userregistermapper  = new Application_Model_Usermapper();
                $userregistermapper->save($userregistermodel);
                
                $sessionuserregister->user_id=$userregistermodel->getUser_id();
                $userpwsregistermodel=new Application_Model_Userpassword($register->getValues());
                $userpwsregistermapper= new Application_Model_Userpasswordmapper();
                $userpwsregistermapper->save($userpwsregistermodel);
                return $this->_helper->redirector('registersucess');
                }
            }
        $this->view->form = $register;
    }

    public function registersucessAction()
    {
        $request=  $this->getRequest();
        $registersucess=new Application_Form_Registersucess();
        if ($this->getRequest()->isPost()) 
            {
            if ($registersucess->isValid($request->getPost())) 
                {
                    if(isset($_POST['Home']))
                    {
                        $this->forward('index','index');
                    }
                }
            }
        $this->view->form=$registersucess;
    }


}



