<?php

class Application_Form_Register extends Zend_Form
{

    public function init()
    {
       
        $this->setMethod('post');

        // Add an email element
        $this->addElement('text', 'first_name', array(
                                                        'label'      => 'FirstName',
                                                        'required'   => true,
                                                        'filters'    => array('StringTrim'),
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                              )
                                                      )
                         );
        // Add the comment element
        $this->addElement('text', 'middle_name', array(
                                                        'label'      => 'MidleName',
                                                        'required'   => true,
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                             )
                                                       )
                         );
        $this->addElement('text', 'last_name', array(
                                                        'label'      => 'LastName',
                                                        'required'   => true,
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                              )
                                                    )
                         );
        $this->addElement('text', 'address1', array(
                                                        'label'      => 'Address1',
                                                        'required'   => true,
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                             )
                                                    )
                         );
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
        $this->addElement('text', 'phone', array(
                                                    'label'      => 'Phone',
                                                    'required'   => true,
                                                    'validators' => array(
                                                                             array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                         )
                                                 )
                          );
        $this->addElement('text', 'mobile', array(
                                                    'label'      => 'Mobile',
                                                    'required'   => true,
                                                    'validators' => array(
                                                                            array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                          )
                                                  )
                          );
        $this->addElement('text', 'home', array(
                                                'label'      => 'Home',
                                                'required'   => true,
                                                'validators' => array(
                                                                       array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                      )
                                                ));
        $this->addElement('text', 'fax', array(
                                                'label'      => 'Fax',
                                                'required'   => true,
                                                'validators' => array(
                                                                        array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                      )
                          ));
        // Add the submit button
        $this->addElement('submit', 'submit', array(
                                                        'ignore'   => true,
                                                        'label'    => 'Register',
                                                    )
                         );
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
                                                'ignore' => true,
                                                )
                         );
     }

 }

