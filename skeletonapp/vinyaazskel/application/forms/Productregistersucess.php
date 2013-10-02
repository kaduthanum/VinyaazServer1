<?php

class Application_Form_Productregistersucess extends Zend_Form
{

    public function init()
    {
       $this->addElement('submit','Addmedia',array(
                                                        'ignore'=>true,
                                                        'lable'=>'Add Media',
                                                   )
                         );
       $this->addElement('submit','Home',array(
                                                        'ignore'=>true,
                                                        'lable'=>'Home',
                                                   )
                         );
        
    }


}

