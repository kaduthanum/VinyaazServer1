<?php

class Application_Form_Organise extends Zend_Form
{

    public function init()
    {
       $this->addElement('submit', 'viewproduct', array(
                                                        'ignore'   => true,
                                                        'label'    => 'View Product',
                                                    )
                         );
       $this->addElement('submit', 'addproduct', array(
                                                        'ignore'   => true,
                                                        'label'    => 'Add Product',
                                                    )
                         );
    }


}

