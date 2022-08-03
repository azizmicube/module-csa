<?php
namespace Icube\Vendor\Controller\Adminhtml\Vendor;

use Icube\Vendor\Model\VendorFactory;
use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action
{
    
    protected $pageFactory;
    protected $vendorFactory;

    public function __construct(
         Context $context,
         VendorFactory $vendorFactory
    ){
        parent::__construct($context);
        $this->vendorFactory = $vendorFactory;
    }

    /**
     * Determines whether current user is allowed to access Action
     *
     * @return bool
    */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Icube_Vendor::vendor');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id) {
            try {
                $model = $this->vendorFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Record deleted successfully.'));
                return $resultRedirect->setPath('*/*/index');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/add', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Record does not exist.'));
        return $resultRedirect->setPath('*/*/index');
    }
}
