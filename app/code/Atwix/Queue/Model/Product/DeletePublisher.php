<?php
/**
 * @author Atwix Team
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_Queue
 */

namespace Atwix\Queue\Model\Product;

class DeletePublisher
{
    const TOPIC_NAME = 'atwix.product.delete';

    /**
     * @var \Magento\Framework\MessageQueue\PublisherInterface
     */
    private $publisher;

    /**
     * @param \Magento\Framework\MessageQueue\PublisherInterface $publisher
     */
    public function __construct(\Magento\Framework\MessageQueue\PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(\Magento\Catalog\Api\Data\ProductInterface $product)
    {
        $this->publisher->publish(self::TOPIC_NAME, $product);
    }
}