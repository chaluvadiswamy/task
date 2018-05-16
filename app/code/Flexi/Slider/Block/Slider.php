<?php 


namespace Flexi\Slider\Block;

class Slider extends \Magento\Framework\View\Element\Template
{
	protected $_template = 'Flexi_Slider::flexislider.phtml';
	
	protected $_dataHelper;
	
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Flexi\Slider\Helper\Data $dataHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_dataHelper = $dataHelper;  
    }
	
	 protected function _toHtml()
    {
        $isEnabled = $this->_dataHelper->isModuleEnabled();
        if ($isEnabled) {
            return parent::_toHtml();
        }
        return '';
    }
}
