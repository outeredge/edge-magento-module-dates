<?php

class Edge_Dates_Model_Dates extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('dates/dates');
    }
}
