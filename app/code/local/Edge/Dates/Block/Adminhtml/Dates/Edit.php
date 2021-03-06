<?php

class Edge_Dates_Block_Adminhtml_Dates_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'dates';
        $this->_controller = 'adminhtml_dates';

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('dates')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        return Mage::helper('dates')->__('Edit Date');
    }
}
