<?php

class Application_Form_Addproduct extends Zend_Form
{

    public function init()
    {
        
       $this->setMethod('post');

        // Add an email element
        $this->addElement('text', 'name', array(
                                                        'label'      => 'ProductName',
                                                        'required'   => true,
                                                        'filters'    => array('StringTrim'),
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                              )
                                                      )
                         );
        // Add the comment element
        $this->addElement('text', 'description', array(
                                                        'label'      => 'ProductDescription',
                                                        'required'   => true,
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0,100))
                                                                             )
                                                       )
                         );
        $this->addElement('text', 'category', array(
                                                        'label'      => 'Category',
                                                        'required'   => true,
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                              )
                                                    )
                         );
        $this->addElement('text', 'exclusive_indicatoy', array(
                                                                'label'      => 'Product Indicatoy',
                                                                'required'   => true,
                                                                'validators' => array(
                                                                                        array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                                      )
                                                               )
                         );
        $this->addElement('text', 'value', array(
                                                    'label'      => 'Property Value',
                                                    'required'   => true,
                                                     'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                             )
                                                    )
                                                    
                         );
        $this->addElement('text', 'prydescription', array(
                                                        'label'      => 'Property Description',
                                                        'required'   => true,
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0,100))
                                                                              )
                                                    )
                         );
        $this->addElement('text', 'long_description', array(
                                                    'label'      => 'Long Description',
                                                    'required'   => true,
                                                    'validators' => array(
                                                                             array('validator' => 'StringLength', 'options' => array(0,500))
                                                                         )
                                                            )
                          );
        
               // Add the submit button
        $this->addElement('submit', 'addproduct', array(
                                                        'ignore'   => true,
                                                        'label'    => 'Add Product',
                                                    )
                         );
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
                                                'ignore' => true,
                                                )
                         );
     }

}

