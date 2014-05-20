<?php

class Edge_Dates_Block_Adminhtml_Dates_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
    {
        parent::__construct();
        $this->setId('datesGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('dates/dates')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header'    => Mage::helper('dates')->__('ID'),
            'width'     => '50',
            'index'     => 'id'
        ));
        
        $this->addColumn('name', array(
            'header'    => Mage::helper('dates')->__('Name'),
            'index'     => 'name'
        ));
        
        $this->addColumn('date', array(
            'header'    => Mage::helper('dates')->__('Date'),
            'align'     => 'left',
            'index'     => 'date',
            'type'      => 'date'
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}