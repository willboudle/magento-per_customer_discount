<?php
/**
 * User: WibWeb
 * Date: 1/12/14
 * Time: 1:35 PM

 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');

$entityTypeId     = $setup->getEntityTypeId('customer');
$attributeSetId   = $setup->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $setup->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);

$setup->addAttribute('customer', 'per_cust_discount', array(
    'input'         => 'text',
    'type'          => 'int',
    'label'         => 'Customer Specific Discount',
    'visible'       => 1,
    'required'      => 0,
    'user_defined' => 1,
    'note'      => 'Only use whole a number',
));

$setup->addAttributeToGroup(
    $entityTypeId,
    $attributeSetId,
    $attributeGroupId,
    'per_cust_discount',
    '999'  //sort_order
);

$oAttribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'per_cust_discount');
$oAttribute->setData('used_in_forms', array('adminhtml_customer'));
$oAttribute->save();

$setup->endSetup();