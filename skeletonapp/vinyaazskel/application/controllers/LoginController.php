<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $request = $this->getRequest();
        $login   = new Application_Form_Login();
        if ($this->getRequest()->isPost()) 
            {
            if ($login->isValid($request->getPost())) 
                {
                    $userloginmodel = new Application_Model_User($login->getValues());
                    $userloginmapper  = new Application_Model_Usermapper();
                    $userloginmapper->find($userloginmodel);
                    $sessionlogin = new Zend_Session_Namespace('login');
                    if($userloginmodel->getUser_id()!==0)
                        {
                            $sessionlogin->user_id =$userloginmodel->getUser_id() ;
                            $sessionlogin->email_id=$userloginmodel->getEmail_id();
                        }
                    else
                        {
                            return $this->_helper->redirector('index');   
                        }
                     $userpwsloginmodel=new Application_Model_Userpassword($login->getValues());
                     $userpwsloginmodel->setUser_id($userloginmodel->getUser_id());
                     $userpwsloginmapper= new Application_Model_Userpasswordmapper();
                     $userpwsloginmapper->find($userpwsloginmodel);
                     if($userpwsloginmodel->getCurrent_password()===$login->getValue(current_password))
                        {
                            $sessionlogin->password=$userpwsloginmodel->getCurrent_password();
                            return $this->_helper->redirector('loginsucess');
                        }
                    else 
                        {
                            $loginatmp=$userloginmodel->getLogin_attempts();
                            $loginatmp++;
                            $userloginmodel->setLogin_attempts($loginatmp);
                            $userloginmapper->save($userloginmodel);
                            return $this->_helper->redirector('index');
                    }
                
                }
            }
        $this->view->form = $login;

    }

    public function loginsucessAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Loginsucess();
       if ($this->getRequest()->isPost()) 
            {
            if ($form->isValid($request->getPost())) 
                {
                if (isset($_POST['update'])) 
                    {
                         return $this->_helper->redirector('updateuser');
   
                    } 
                else if (isset($_POST['change'])) 
                    {
                        return $this->_helper->redirector('updateuserpws');
                    } 
                else if(isset($_POST['create'])) 
                    {
                        return $this->_helper->redirector('organise');
                    }
                }
       
        
             }
              $this->view->form = $form;
    }

    public function updateuserAction()
    {
        $request = $this->getRequest();
        $updateuser=new Application_Form_Profileupdate();
        if ($this->getRequest()->isPost()) 
            {
            if ($updateuser->isValid($request->getPost())) 
                {
                    $sessionuserupdate = new Zend_Session_Namespace('login');
                    $userupdatemodel = new Application_Model_User($updateuser->getValues());
                    $userupdatemodel->setUser_id($sessionuserupdate->user_id)
                                    ->setEmail_id($sessionuserupdate->email_id);
                    $userupdatemapper  = new Application_Model_Usermapper();
                    $userupdatemapper->save($userupdatemodel);
                    return $this->_helper->redirector('updatesucess');
                }
            }
        $this->view->form=$updateuser;
    }

    public function organiseAction()
    {
        $request = $this->getRequest();
        $organize=new Application_Form_Organise();
        if ($this->getRequest()->isPost()) 
            {
            if ($organize->isValid($request->getPost())) 
                {
                if (isset($_POST['viewproduct'])) 
                    {
                         return $this->_helper->redirector('viewproduct');
   
                    } 
                else if (isset($_POST['addproduct'])) 
                    {
                        return $this->_helper->redirector('addproduct');
                    } 
                
                }
            }
         $this->view->form=$organize;
    }

    public function updateuserpwsAction()
    {
        $request = $this->getRequest();
        $updateuserpws=new Application_Form_Changepassword();
        if ($this->getRequest()->isPost()) 
            {
            if ($updateuserpws->isValid($request->getPost())) 
                {
                    $sessionuserpwsupdate = new Zend_Session_Namespace('login');
                    if($sessionuserpwsupdate->password===$updateuserpws->getValue('password'))
                        {
                            $userpwsupdatemodel=new Application_Model_Userpassword($updateuserpws->getValues());
                            $userpwsupdatemodel->setUser_id($sessionuserpwsupdate->user_id);
                            
                            $userpwsupdatemapper= new Application_Model_Userpasswordmapper();
                            $userpwsupdatemapper->save($userpwsupdatemodel);
                            return $this->_helper->redirector('changepasswordsucess');
                        }
                     return $this->_helper->redirector('updateuserpws');
                }
            }
        $this->view->form=$updateuserpws;
    }

    public function updatesucessAction()
    {
        $updateusersucess=new Application_Form_Updatesucess();
        $this->view->form=$updateusersucess;
    }

    public function changepasswordsucessAction()
    {
        $changepasswordsucess=new Application_Form_Updatesucess();
        $this->view->form=$changepasswordsucess;
        
    }

    public function productregistersucessAction()
    {   $request=$this->getRequest();
        $productregsus=new Application_Form_Productregistersucess();
        if ($this->getRequest()->isPost()) 
            {
            if ($productregsus->isValid($request->getPost())) 
                {
                if (isset($_POST['Addmedia'])) 
                    {
                        return $this->_helper->redirector('addmedia');
                    }
                 if(isset($_POST['Home']))
                    {
                        return $this->_helper->redirector('loginsucess');
                    }
                }
            }
       $this->view->form=$productregsus;
    }

    public function addproductAction()
    {
        $request=$this->getRequest();
        $addproduct=new Application_Form_Addproduct();
        if ($this->getRequest()->isPost()) 
            {
            if ($addproduct->isValid($request->getPost())) 
                {
                 if (isset($_POST['addproduct'])) 
                    {
                         $sessionaddproduct = new Zend_Session_Namespace('login');
                         $addproductmodel=new Application_Model_Product($addproduct->getValues());
                         $addproductmodel->setUser_id($sessionaddproduct->user_id);
                         $addproductmapper=new Application_Model_Productmapper();
                         $addproductmapper->save($addproductmodel);
                         $sessionaddproduct->product_id=$addproductmodel->getProduct_id();
                
                         $addproductprymodel=new Application_Model_Productproperty($addproduct->getValues());
                         $addproductprymodel->setProduct_id($addproductmodel->getProduct_id());
                         $addproductprymapper=new Application_Model_Productpropertymapper();
                         $addproductprymapper->save($addproductprymodel);
                
                         return $this->_helper->redirector('productregistersucess');
   
                    }
               }
            }
        $this->view->form=$addproduct;
    }

    public function viewproductAction()
    {
        $viewproduct=new Application_Form_Viewproduct();
        $this->view->form=$viewproduct;
        
    }

    public function addmediaAction()
    {
        $request=$this->getRequest();
        $sessionaddmedia=new Zend_Session_Namespace('login');
        $addmedia=new Application_Form_Addmedia();
        if ($this->getRequest()->isPost()) 
            {
            if ($addmedia->isValid($request->getPost())) 
                {
                    $addmedia->setAction($this->view->url());
                    try 
                      {
                             $addmedia->file->receive();
                            $location = $addmedia->file->getFileName();
                            //$file=$addmedia->file->getFileInfo();
                       } 
                    catch (Exception $exception) 
                      {
                            echo $exception;
                            $this->view->form = $addmedia;
                      }
                    $addproductprymdamodel=new Application_Model_Productpropertymedia($addmedia->getValues());
                    $addproductprymdamodel->setPath($location);
                    $addproductprymdamodel->setProduct_id($sessionaddmedia->product_id);
                    $addproductprymdamapper=new Application_Model_Productpropertymediamapper();
                    $addproductprymdamapper->save($addproductprymdamodel);
                    return $this->_helper->redirector('productregistersucess');
                }
            }
       $this->view->form=$addmedia;
        }
}























