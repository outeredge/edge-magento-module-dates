<?php

class Edge_Dates_Block_Adminhtml_Dates_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('dates');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post',
            'enctype'	=> 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'=>Mage::helper('dates')->__('General Information'),
            'class' => 'fieldset-wide'
        ));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array('name' => 'id'));
        }
        
        $fieldset->addField('title', 'text', array(
            'label'     => Mage::helper('dates')->__('Title'),
            'name'      => 'title',
            'required'  => false
        ));
                
        $dateFormat = Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT);
        $dateImage = $this->getSkinUrl('images/grid-cal.gif');
        
        $fieldset->addField('date', 'date', array(
            'label'     => Mage::helper('dates')->__('Date'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'date',
            'image'     => $dateImage,
            'format'    => $dateFormat
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }
}