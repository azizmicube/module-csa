<?php
namespace Icube\Vendor\Controller\Adminhtml\Vendor;

use Icube\Vendor\Model\VendorFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Session;

class Save extends \Magento\Backend\App\Action
{

    protected $icubeVendorFactory;
    protected $adminsession;
    
    public function __construct(
        Context $context,
        Session $adminsession,
        VendorFactory $icubeVendorFactory
    )
    {
        parent::__construct($context);
        $this->icubeVendorFactory = $icubeVendorFactory;
        $this->adminsession = $adminsession;
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
                $model = $this->icubeVendorFactory->create()->load($id);                
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
	                                'id' => $this->icubeVendorFactory->getId(),
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

            $model = $this->icubeVendorFactory->create();
            $model->setVendorName($post['vendor_name']);
            $model->setAddress($post['address']);
            $model->setVendorCode($post['vendor_code']);
            $model->setKecamatanCode($post['kecamatan_code']);
            $model->setLongitude($post['longitude']);
            $model->setLatitude($post['latitude']);
            $model->setStatus($post['status']);
            $model->save();
            
            $this->messageManager->addSuccess(__('The data has been saved.'));
            return $resultRedirect->setPath('*/*/index');
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
