<?php
/**
 * Copyright (c) 2018. Volodumur Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodumur@hryvinskyi.com>
 * @github: <https://github.com/scriptua>
 */

namespace Script\Deleteorder\Controller\Adminhtml\Deleteorder;

use Script\Deleteorder\Model\OrderFactory;
use Magento\Backend\App\Action\Context;

class Deleteorder extends AbstractDeleteorder
{
    /**
     * @var OrderFactory
     */
    protected $_modelOrderFactory;

    /**
     * Deleteorder constructor.
     *
     * @param Context      $context
     * @param OrderFactory $modelOrderFactory
     */
    public function __construct(
        Context $context,
        OrderFactory $modelOrderFactory
    ) {
        $this->_modelOrderFactory = $modelOrderFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $orderId = $this->getRequest()->getParam('order_id');
        if (empty($orderId)) {
            $this->messageManager->addError(__('There is no order to process'));
            $this->_redirect('sales/order/index');
        }

        try {
            $this->_modelOrderFactory->create()->deleteOrder([$orderId]);
            $this->messageManager->addSuccess(__('Order successfully deleted'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }

        $this->_redirect('sales/order/index');
    }
}
