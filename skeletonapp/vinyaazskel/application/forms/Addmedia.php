<?php

class Application_Form_Addmedia extends Zend_Form
{

    public function init()
    {
         $this->setAttrib('enctype', 'multipart/form-data');
         $this->setMethod('post');
         $this->addElement('text', 'type', array(
                                                        'label'      => 'File Type',
                                                        'required'   => true,
                                                        'filters'    => array('StringTrim'),
                                                        'validators' => array(
                                                                                array('validator' => 'StringLength', 'options' => array(0, 20))
                                                                              )
                                                      )
                         );

         $file = new Zend_Form_Element_File('file');
         $file->setLabel('File to upload:')
              ->setRequired(true)
              ->addValidator('NotEmpty')
              ->addValidator('Count', false, 1);
        $this->addElement($file);

        $this->addElement('submit', 'submit', array(
                                                    'label'    => 'Upload',
                                                    'ignore'   => true
                                                    )
                         );


    }


}

