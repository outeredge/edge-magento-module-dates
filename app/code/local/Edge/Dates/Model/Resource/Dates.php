<?php

class Edge_Dates_Model_Resource_Dates extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('dates/dates', 'id');
    }
}
