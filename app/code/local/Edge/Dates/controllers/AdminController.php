<?php

class Edge_Dates_AdminController extends Mage_Adminhtml_Controller_Action
{
    protected $model;
    
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/dates');
    }

    protected function _initAction()
    {
        $this->loadLayout()
            ->_title($this->__('outer/edge'))
            ->_title($this->__('Dates'))
            ->_setActiveMenu('edge');

        return $this;
    }

    protected function _initModel()
    {
        $this->model = Mage::getModel('dates/dates');

        $id = $this->getRequest()->getParam('id', false);
        if ($id !== false){
            $this->model->load($id);
        }

        Mage::register('dates', $this->model);
        return $this->model;
    }

    public function indexAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('dates/adminhtml_dates'))
            ->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initModel();

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $this->model->setData($data);
        }

        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('dates/adminhtml_dates_edit'))
            ->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('dates/dates');
            $model->setData($data)
                  ->setId($this->getRequest()->getParam('id'));

            try {
                
                if ($data['date'] !== null){
                    $date = Mage::app()->getLocale()->date($data['date'], Zend_Date::DATE_SHORT, null, false);
                    $model->setDate($date->toString('YYYY-MM-dd HH:mm:ss'));
                }
                
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('dates')->__('Item was successfully saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }

                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {

                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('dates')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0){
            try {
                $model = Mage::getModel('dates/dates');
                $model->setId($this->getRequest()->getParam('id'));
                $model->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('dates')->__('Date was successfully deleted.'));
                $this->_redirect('*/*/');

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
}
