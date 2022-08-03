<?php
namespace Icube\Vendor\Controller\Adminhtml\Vendor;

use Icube\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends \Magento\Backend\App\Action
{
    
    protected $pageFactory;
    protected $filter;
    protected $collectionFactory;

    public function __construct(
         Context $context,
         Filter $filter,
         CollectionFactory $collectionFactory
    ){
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
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
     * MassDelete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        foreach ($collection as $item) {
            $item->delete();
        }

        $this->messageManager->addSuccess(__('A total of %1 element(s) have been deleted.', $collectionSize));

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }
}
