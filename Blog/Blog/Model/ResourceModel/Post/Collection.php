<?php
/**
* Copyright © 2015 Magento. All rights reserved.
* See COPYING.txt for license details.
*/
namespace MageBuzz\Blog\Model\ResourceModel\Post;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
  /**
  * @param \Magento\Framework\Data\Collection\EntityFactory $entityFactory
  * @param \Psr\Log\LoggerInterface $logger
  * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
  * @param \Magento\Framework\Event\ManagerInterface $eventManager
  * @param mixed $connection
  * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource
  */
  public function __construct(
      \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
      \Psr\Log\LoggerInterface $logger,
      \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
      \Magento\Framework\Event\ManagerInterface $eventManager,
      \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
      \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
  ) {
      parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
  }
 
  /**
  * Define resource model
  *
  * @return void
  */
  protected function _construct()
  {
      $this->_init('MageBuzz\Blog\Model\Post', 'MageBuzz\Blog\Model\ResourceModel\Post');
      $this->_idFieldName = 'post_id';
  }
 
}