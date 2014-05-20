<?php

class Edge_Dates_Block_Adminhtml_Dates extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_dates';
        $this->_blockGroup = 'dates';
        $this->_headerText = Mage::helper('dates')->__('Dates');
        $this->_addButtonLabel = Mage::helper('dates')->__('Add Date');
        parent::__construct();
    }
}
