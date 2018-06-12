<?php
/**
 * @author Atwix Team
 * @copyright Copyright (c) 2018 Atwix (https://www.atwix.com/)
 * @package Atwix_Queue
 */

namespace Atwix\Queue\Model\Product;

class DeleteConsumer
{
    /**
     * @var \Zend\Log\Logger
     */
    private $logger;

    /**
     * @var string
     */
    private $logFileName = 'product-delete-consumer.log';

    /**
     * @var \Magento\Framework\App\Filesystem\DirectoryList
     */
    private $directoryList;

    /**
     * DeleteConsumer constructor.
     * @param \Magento\Framework\App\Filesystem\DirectoryList $directoryList
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        \Magento\Framework\App\Filesystem\DirectoryList $directoryList
    ) {
        $this->directoryList = $directoryList;
        $logDir = $directoryList->getPath('log');
        $writer = new \Zend\Log\Writer\Stream($logDir . DIRECTORY_SEPARATOR . $this->logFileName);
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @throws \Magento\Framework\Exception\LocalizedException
     * @return void
     */
    public function processMessage(\Magento\Catalog\Api\Data\ProductInterface $product)
    {
        $this->logger->info($product->getId() . ' ' . $product->getSku());
    }
}