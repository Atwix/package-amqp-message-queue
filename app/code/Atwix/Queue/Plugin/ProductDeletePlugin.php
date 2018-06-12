<?php
/**
 * @author Atwix Team
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_Queue
 */

namespace Atwix\Queue\Plugin;

use Atwix\Queue\Model\Product\DeletePublisher;
use Magento\Catalog\Model\ResourceModel\Product as ProductResource;

class ProductDeletePlugin
{
    /**
     * @var \Magento\Quote\Model\Product\QuoteItemsCleanerInterface
     */
    private $productDeletePublisher;

    /**
     * @param \Magento\Quote\Model\Product\QuoteItemsCleanerInterface $quoteItemsCleaner
     */
    public function __construct(DeletePublisher $productDeletePublisher)
    {
        $this->productDeletePublisher = $productDeletePublisher;
    }

    /**
     * @param ProductResource $subject
     * @param ProductResource $result
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return ProductResource
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterDelete(
        ProductResource $subject,
        ProductResource $result,
        \Magento\Catalog\Api\Data\ProductInterface $product
    ) {
        $this->productDeletePublisher->execute($product);
        return $result;
    }
}
