<?php

class Application_Form_Registersucess extends Zend_Form
{

    public function init()
    {
        $this->addElement('submit','Home',array(
                                                        'lable'=>'Home',
                                                        'ignore'=>true,
                                                        
                                                   )
                         );        
    }


}

