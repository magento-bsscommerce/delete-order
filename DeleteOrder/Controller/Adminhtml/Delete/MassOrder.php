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

class MassOrder extends \Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction
{
	protected $orderManagement;

	public function __construct(
		Context $context,
		Filter $filter,
		CollectionFactory $collectionFactory,
		OrderManagementInterface $orderManagement
		) {
		parent::__construct($context, $filter);
		$this->collectionFactory = $collectionFactory;
		$this->orderManagement = $orderManagement;
	}

	protected function massAction(AbstractCollection $collection)
	{
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		foreach ($collection->getItems() as $order) {
			$orderId = $order->getId();
			$incrementId = $order->getIncrementId();
			try {
				$objectManager->create('Bss\DeleteOrder\Model\Order\Delete')->deleteOrder($orderId);
				$this->messageManager->addSuccess(__('Successfully deleted order #%1.', $incrementId));
			}catch(\Exception $e) {
				$this->messageManager->addError(__('Error delete order #%1.', $incrementId));
			}
		}
		$resultRedirect = $this->resultRedirectFactory->create();
		$resultRedirect->setPath('sales/order/');
		return $resultRedirect;
	}
}
