<?php
namespace Icube\Vendor\Controller\Adminhtml\Product;

use Icube\Vendor\Model\ProductFactory;
use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action
{
    
    protected $pageFactory;
    protected $productFactory;

    public function __construct(
         Context $context,
         ProductFactory $productFactory
    ){
        parent::__construct($context);
        $this->productFactory = $productFactory;
    }

    /**
     * Determines whether current user is allowed to access Action
     *
     * @return bool
    */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Icube_Vendor::product');
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
                $model = $this->productFactory->create();
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
