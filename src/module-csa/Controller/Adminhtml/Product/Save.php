<?php
namespace Icube\Vendor\Controller\Adminhtml\Product;

use Icube\Vendor\Model\ProductFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Session;

class Save extends \Magento\Backend\App\Action
{

    protected $productFactory;
    protected $adminsession;
    
    public function __construct(
        Context $context,
        Session $adminsession,
        ProductFactory $productFactory
    )
    {
        parent::__construct($context);
        $this->productFactory = $productFactory;
        $this->adminsession = $adminsession;
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
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
    */
    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($post) {
            $id = $this->getRequest()->getParam('id');

            if ($id) {
                $model = $this->productFactory->create()->load($id);                
                $model->setData($post);

                try {
	                $model->save();
	                $this->messageManager->addSuccess(__('The data has been updated.'));
	                $this->adminsession->setFormData(false);
	                if ($this->getRequest()->getParam('back')) {
	                    if ($this->getRequest()->getParam('back') == 'save') {
	                        return $resultRedirect->setPath('*/*/add');
	                    } else {
	                        return $resultRedirect->setPath(
	                            '*/*/add',
	                            [
	                                'id' => $this->productFactory->getId(),
	                                '_current' => true
	                            ]
	                        );
	                    }
	                }
	                return $resultRedirect->setPath('*/*/index');
	            } catch (\Magento\Framework\Exception\LocalizedException $e) {
	                $this->messageManager->addError($e->getMessage());
	            } catch (\RuntimeException $e) {
	                $this->messageManager->addError($e->getMessage());
	            } catch (\Exception $e) {
	                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
	            }
            }

            $model = $this->productFactory->create();
            $model->setVendorId($post['vendor_id']);
            $model->setSku($post['sku']);
            $model->setStock($post['stock']);
            $model->setPrice($post['price']);
            $model->setUpdatedAt(date('Y-m-d H:i:s'));
            $model->save();
            
            $this->messageManager->addSuccess(__('The data has been saved.'));
            return $resultRedirect->setPath('*/*/index');
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
