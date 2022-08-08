<?php
namespace Icube\Vendor\Controller\Adminhtml\Product;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Add extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
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
     * Render to form
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(__('Vendor'), __('Add New Product'));
        $resultPage->getConfig()->getTitle()->prepend((__('Add New Product')));

        return $resultPage;
    }
}
