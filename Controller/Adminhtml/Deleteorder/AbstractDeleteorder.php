<?php
/**
 * Copyright (c) 2018. Volodumur Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodumur@hryvinskyi.com>
 * @github: <https://github.com/scriptua>
 */

namespace Script\Deleteorder\Controller\Adminhtml\Deleteorder;

abstract class AbstractDeleteorder extends \Magento\Backend\App\Action
{
    /**
     * @return bool
     */
	protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('deleteorder');
    }
}