<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
        
        $this->setMethod('post');
        
        
        $this->addElement('text', 'email_id', array(
                                                    'label'      => 'EmailId',
                                                    'required'   => true,
                                                    'validators' => array(
                                                                            'EmailAddress',
                                                                          )
                                                   )
                         );
        $this->addElement('password', 'current_password', array(
                                                        'label'      => 'Password',
                                                        'required'   => true,
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                              )
                                                    )
                         );
         $this->addElement('submit', 'submit', array(
                                                        'ignore'   => true,
                                                        'label'    => 'Login',
                                                    )
                         );
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
                                                'ignore' => true,
                                                )
                         );
    }


}

