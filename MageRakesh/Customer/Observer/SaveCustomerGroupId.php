<?php
namespace MageRakesh\Customer\Observer;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\State\InputMismatchException;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class SaveCustomerGroupId
 * @package MageRakesh\Customer\Observer
 */
class SaveCustomerGroupId implements ObserverInterface
{
    protected $_customerRepositoryInterface;
    protected $_messageManager;

    /**
     * SaveCustomerGroupId constructor.
     * @param CustomerRepositoryInterface $customerRepositoryInterface
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepositoryInterface,
        ManagerInterface $messageManager
    ) {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->_messageManager = $messageManager;
    }

    /**
     * @param Observer $observer
     * @throws InputException
     * @throws LocalizedException
     * @throws NoSuchEntityException
     * @throws InputMismatchException
     */
    public function execute(Observer $observer)
    {
        $accountController = $observer->getAccountController();
        $request = $accountController->getRequest();
        $group_id = $request->getParam('group_id');

        try {
            $customerId = $observer->getCustomer()->getId();
            $customer = $this->_customerRepositoryInterface->getById($customerId);
            $customer->setGroupId($group_id);
            $this->_customerRepositoryInterface->save($customer);
        } catch (Exception $e) {
            $this->_messageManager->addErrorMessage(__('Something went wrong during customer gruop assign'));
        }
    }
}
