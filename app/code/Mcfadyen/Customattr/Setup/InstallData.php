<?php

namespace Mcfadyen\Customattr\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
	private $eavSetupFactory;
	
	private $customerSetupFactory;
	
	private $eavConfig;

	 
	public function __construct(
	   CustomerSetupFactory $customerSetupFactory,
	   Config $eavConfig,
	   EavSetupFactory $eavSetupFactory
	   )
    {
        $this->customerSetupFactory = $customerSetupFactory;
		$this->eavSetupFactory = $eavSetupFactory;
		$this->eavConfig = $eavConfig;
    }
	
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
		
		$eavSetup->removeAttribute('customer_address', 'address_type');
		
		$eavSetup->addAttribute('customer_address','address_type', 
		[
			'type' => 'static',
			'label' => 'Address Type',
			'input' => 'select',
			'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Table',
			'required' => false,
			'sort_order' => 150,
			'visible' => true,
			'position' => 150,
			'option' => ['values' => ['Residential', 'Business']],
		]);
		
		$customerAttribute = $this->eavConfig->getAttribute('customer_address','address_type');
        $customerAttribute->setData('used_in_forms', ['adminhtml_customer_address','customer_account_edit','customer_account_create','customer_register_address','customer_address_edit'])
            ->setData("is_system", 0)
            ->setData("is_visible", 1)
            ->setData("sort_order", 150);
        $customerAttribute->save();
	  }
	
	
 }	

