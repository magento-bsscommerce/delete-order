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
 * @category   BSS
 * @package    Bss_DeleteOrder
 * @author     Extension Team
 * @copyright  Copyright (c) 2019-2019 BSS Commerce Co. ( http://bsscommerce.com )
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
    /**
     * @var OrderManagementInterface
     */
    protected $orderManagement;

    /**
     * @var CollectionFactory
     */
    protected $orderCollectionFactory;

    /**
     * @var \Bss\DeleteOrder\Model\Order\Delete
     */
    protected $delete;

    /**
     * MassOrder constructor.
     * @param Context $context
     * @param Filter $filter
     * @param OrderManagementInterface $orderManagement
     * @param CollectionFactory $orderCollectionFactory
     * @param \Bss\DeleteOrder\Model\Order\Delete $delete
     */
    public function __construct(
        Context $context,
        Filter $filter,
        OrderManagementInterface $orderManagement,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Bss\DeleteOrder\Model\Order\Delete $delete
    ) {
        parent::__construct($context, $filter);
        $this->orderManagement = $orderManagement;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->delete = $delete;
    }

    /**
     * @param AbstractCollection $collection
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function massAction(AbstractCollection $collection)
    {
        $collectionInvoice = $this->filter->getCollection($this->orderCollectionFactory->create());

        foreach ($collectionInvoice as $order) {
            $orderId = $order->getId();
            $incrementId = $order->getIncrementId();
            try {
                $this->deleteOrder($orderId);
                $this->messageManager->addSuccessMessage(__('Successfully deleted order #%1.', $incrementId));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error delete order #%1.', $incrementId));
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('sales/order/');
        return $resultRedirect;
    }

    /*
     * Check permission via ACL resource
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_DeleteOrder::delete_order');
    }

    /**
     * @param $orderId
     * @throws \Exception
     */
    protected function deleteOrder($orderId)
    {
        $this->delete->deleteOrder($orderId);
    }
}
