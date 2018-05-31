<?php
/**
 * Copyright (c) 2018. Volodumur Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodumur@hryvinskyi.com>
 * @github: <https://github.com/scriptua>
 */

namespace Script\Deleteorder\Controller\Adminhtml\Deleteorder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Script\Deleteorder\Model\OrderFactory;

class MassDelete extends \Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction
{
    /**
     * @var OrderFactory
     */
    protected $_modelOrderFactory;

    /**
     * MassDelete constructor.
     *
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     * @param OrderFactory      $modelOrderFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        OrderFactory $modelOrderFactory
    ) {
        parent::__construct($context, $filter);
        $this->collectionFactory = $collectionFactory;
        $this->_modelOrderFactory = $modelOrderFactory;
    }

    /**
     * @param AbstractCollection $collection
     *
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    protected function massAction(AbstractCollection $collection)
    {
        $orderIds = [];

        foreach ($collection->getItems() as $order) {
            $orderIds[] = $order->getId();
        }

        if (empty($orderIds)) {
            $this->messageManager->addError(__('There is no order to process'));
            $this->_redirect('sales/order/index');
        }
        try {
            $count = 0;
            foreach ($orderIds as $orderId) {
                if ($this->_modelOrderFactory->create()->deleteOrder([$orderId])) $count++;
            }
            $this->messageManager->addSuccess(
                __('%1 order(s) successfully deleted', $count)
            );
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }

        $this->_redirect('sales/order/index');
    }
}
