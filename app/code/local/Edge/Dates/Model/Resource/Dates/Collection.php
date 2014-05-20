<?php

class Edge_Dates_Model_Resource_Dates_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	protected function _construct()
    {
        $this->_init('dates/dates');
    }
}