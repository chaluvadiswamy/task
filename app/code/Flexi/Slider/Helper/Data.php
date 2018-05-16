<?php

namespace Flexi\Slider\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
	const FLEXI_IS_MODULE_ENABLED = 'slider/slider/status';
	
	public function __construct(\Magento\Framework\App\Helper\Context $context)
	{
		parent::__construct($context);
	}
	
	/**
     * @return $storeScope
     */
	public function getStoreScope()
	{
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
		return $storeScope;
	}
	
	/**
     * @return module enabled;
     */
    public function isModuleEnabled()
    {
        $isEnabled = $this->scopeConfig->getValue(self::FLEXI_IS_MODULE_ENABLED, $this->getStoreScope());
        return $isEnabled;
    } 
}