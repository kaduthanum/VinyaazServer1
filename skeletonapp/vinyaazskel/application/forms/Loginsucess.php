<?php

class Application_Form_Loginsucess extends Zend_Form
{

    public function init()
    {
       $this->addElement('submit', 'update', array(
                                                        'ignore'   => true,
                                                        'label'    => 'Profile Update',
                                                  )
                         );
       $this->addElement('submit', 'change', array(
                                                        'ignore'   => true,
                                                        'label'    => 'Change Password',
                                                   )
                         );
       $this->addElement('submit', 'create', array(
                                                        'ignore'   => true,
                                                        'label'    => 'Organise',
                                                    )
                         );
    }


}

