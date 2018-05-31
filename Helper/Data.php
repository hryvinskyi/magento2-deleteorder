<?php
/**
 * Copyright (c) 2018. Volodumur Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodumur@hryvinskyi.com>
 * @github: <https://github.com/scriptua>
 */

namespace Script\Deleteorder\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    /**
     * @return mixed
     */
    public function isEnabled()
	{
		return $this->scopeConfig->getValue('deleteorder/general/enable', ScopeInterface::SCOPE_STORE);
    }

    /**
     * @return mixed
     */
	public function getOrderButtonLabel()
	{
		return $this->scopeConfig->getValue('deleteorder/general/btnheading', ScopeInterface::SCOPE_STORE);
    }
}