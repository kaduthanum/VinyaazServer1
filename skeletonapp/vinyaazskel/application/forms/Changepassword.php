<?php

class Application_Form_Changepassword extends Zend_Form
{

    public function init()
    {
        
        $this->setMethod('post');
        // Add an email element
        $this->addElement('password','current_password', array(
                                                                'label'      => 'Your Currentpassword',
                                                                'required'   => true,
                                                                'filters'    => array('StringTrim'),
                                                               )
                         );
        $this->addElement('text','new_password', array(
                                                                'label'      => 'Your Newpassword',
                                                                'required'   => true,
                                                                'filters'    => array('StringTrim'),
                                                               )
                         );
        
        
        // Add a captcha
        $this->addElement('captcha', 'capcha', array(
                                                            'label'      => 'Please enter the 5 letters displayed below:',
                                                            'required'   => true,
                                                            'captcha'    => array(
                                                                                    'captcha' => 'Figlet',
                                                                                    'wordLen' => 5,
                                                                                     'timeout' => 300
                                                                                   )
                                                            )
                );
        // Add the submit button
        $this->addElement('submit', 'submit', array(
                                                    'ignore'   => true,
                                                    'label'    => 'Change Password',
                                                   )
                         );
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));

    }


}

