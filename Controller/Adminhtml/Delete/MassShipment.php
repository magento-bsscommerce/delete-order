<?php
/**
* BSS Commerce Co.
*
* NOTICE OF LICENSE
*
* This source file is subject to the EULA
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://bsscommerce.com/Bss-Commerce-License.txt
*
* =================================================================
*                 MAGENTO EDITION USAGE NOTICE
* =================================================================
* This package designed for Magento COMMUNITY edition
* BSS Commerce does not guarantee correct work of this extension
* on any other Magento edition except Magento COMMUNITY edition.
* BSS Commerce does not provide extension support in case of
* incorrect edition usage.
* =================================================================
*
* @category   BSS
* @package    Bss_DeleteOrder
* @author     Extension Team
* @copyright  Copyright (c) 2015-2016 BSS Commerce Co. ( http://bsscommerce.com )
* @license    http://bsscommerce.com/Bss-Commerce-License.txt
*/
namespace Bss\DeleteOrder\Controller\Adminhtml\Delete;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Sales\Api\OrderManagementInterface;

class MassShipment extends \Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction
{
	protected $orderManagement;
	protected $_shipmentCollectionFactory;

	public function __construct(
		Context $context,
		Filter $filter,
		CollectionFactory $collectionFactory,
		OrderManagementInterface $orderManagement,
		\Magento\Sales\Model\ResourceModel\Order\Shipment\CollectionFactory $shipmentCollectionFactory
	) {
		parent::__construct($context, $filter);
		$this->collectionFactory = $collectionFactory;
		$this->orderManagement = $orderManagement;
		$this->_shipmentCollectionFactory = $shipmentCollectionFactory;
	}

	protected function massAction(AbstractCollection $collection)
	{
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $params = $this->getRequest()->getParams();
        $shipmentCollections = $this->_shipmentCollectionFactory->create();
		$selected = array();
		if(isset($params['excluded']) && $params['excluded'] == "false"){
        	if($params['namespace'] == 'sales_order_view_shipment_grid'){
				$_order = $objectManager->create('Magento\Sales\Model\Order')->load($params['order_id']);
		        foreach ($_order->getShipmentsCollection() as $_shipment) {
		            if($_shipment) 
		            	array_push($selected, $_shipment->getId());
		        }
			}else{
	        	foreach ($shipmentCollections as $shipmentCollection){
	        		if($shipmentCollection) 
	        			array_push($selected, $shipmentCollection->getId());
	        	}
	        }
        }else{
        	$selected = $params['selected'];
        }
        if($selected){
            foreach ($selected as $shipmentId) {
				$shipment = $objectManager->create('Magento\Sales\Model\Order\Shipment')->load($shipmentId);
				try {
					$order = $objectManager->create('Bss\DeleteOrder\Model\Shipment\Delete')->deleteShipment($shipmentId);
					$this->messageManager->addSuccess(__('Successfully deleted shipment #%1.', $shipment->getIncrementId()));
				}catch(\Exception $e) {
					$this->messageManager->addError(__('Error delete shipment #%1.', $shipment->getIncrementId()));
				}
			}
        }

		$resultRedirect = $this->resultRedirectFactory->create();
		$resultRedirect->setPath('sales/shipment/');
		if($params['namespace'] == 'sales_order_view_shipment_grid') 
			$resultRedirect->setPath('sales/order/view', ['order_id' => $order->getId()]);
		else $resultRedirect->setPath('sales/shipment/');
		return $resultRedirect;
	}

	/*
     * Check permission via ACL resource
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_DeleteOrder::delete_order');
    }
}
