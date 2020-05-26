<?php
namespace MageRakesh\Customer\Block;

use Magento\Customer\Model\ResourceModel\Group\Collection as CustomerGroup;
use Magento\Framework\View\Element\Template;

/**
 * Class CustomerGroups
 * @package MageRakesh\Customer\Block
 */
class CustomerGroups extends Template
{
    public $_customerGroup;

    /**
     * CustomerGroups constructor.
     * @param CustomerGroup $customerGroup
     */
    public function __construct(
        CustomerGroup $customerGroup
    ) {
        $this->_customerGroup = $customerGroup;
    }

    /**
     * @return array
     */
    public function getCustomerGroup()
    {
        return $this->_customerGroup->toOptionArray();
    }
}
