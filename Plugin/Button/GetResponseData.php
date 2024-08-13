<?php
declare(strict_types=1);

namespace Amwal\Discount\Plugin\Button;

use Amwal\Payments\Model\Checkout\GetQuote;
use Magento\Quote\Api\Data\CartInterface;
use Magento\SalesRule\Model\ResourceModel\Rule\CollectionFactory as RuleCollectionFactory;
use Magento\SalesRule\Model\Rule;

class GetResponseData
{
    /**
     * @var RuleCollectionFactory
     */
    private $ruleCollectionFactory;

    /**
     * Constructor
     *
     * @param RuleCollectionFactory $ruleCollectionFactory
     */
    public function __construct(RuleCollectionFactory $ruleCollectionFactory)
    {
        $this->ruleCollectionFactory = $ruleCollectionFactory;
    }

    /**
     * Before plugin for getResponseData method
     *
     * @param GetQuote $subject
     * @param CartInterface $quote
     * @param array $availableRates
     * @return array
     */
    public function beforeGetResponseData(
        GetQuote $subject,
        CartInterface $quote,
        array $availableRates
    ): array {
        $amwalDiscountRule = $this->getActiveAmwalDiscountRule();
        if ($amwalDiscountRule && $amwalDiscountRule->getCode() && !$quote->getCouponCode()) {
            // Apply the coupon code associated with the discount rule
            $quote->setCouponCode($amwalDiscountRule->getCode());
            $quote->setTotalsCollectedFlag(false);
            $quote->collectTotals(); // Avoid using if not necessary at this stage
            $quote->save(); // Save only when necessary
        }

        // Return the modified arguments
        return [$quote, $availableRates];
    }

    /**
     * Get the active Amwal-specific discount rule
     *
     * @return Rule|null
     */
    protected function getActiveAmwalDiscountRule(): ?Rule
    {
        $ruleCollection = $this->ruleCollectionFactory->create()
            ->addFieldToFilter('is_active', 1)
            ->addFieldToFilter('conditions_serialized', ['like' => '%amwal_payments%']);

        $ruleCollection->getSelect()->order('sort_order ASC');

        // Check if the collection has any items before loading the first item
        if ($ruleCollection->getSize() > 0) {
            return $ruleCollection->getFirstItem();
        }

        return null;
    }
}
