<?php
/**
* Copyright © 2015 Magento. All rights reserved.
* See COPYING.txt for license details.
*/
namespace MageBuzz\Blog\Model;
 
/**
* @author Magebuzz Team
*/
  class Post extends \Magento\Framework\Model\AbstractModel
  {
 
  /**#@+
  * Post's Statuses
  */
  const STATUS_ENABLED = 1;
  const STATUS_DISABLED = 0;
  /**#@-*/
 
  /**
  * CMS page cache tag
  */
  const CACHE_TAG = 'blog_post';
 
  /**
  * @var string
  */
  protected $_cacheTag = 'blog_post';
 
  /**
  * Prefix of model events names
  *
  * @var string
  */
  protected $_eventPrefix = 'blog_post';
 
  /**
  * @param \Magento\Framework\Model\Context $context
  * @param \Magento\Framework\Registry $registry
  * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
  * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
  * @param array $data
  */
  function __construct(
      \Magento\Framework\Model\Context $context,
      \Magento\Framework\Registry $registry,
      \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
      \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
      array $data = [])
  {
      parent::__construct($context, $registry, $resource, $resourceCollection, $data);
  }
 
  /**
  * Initialize resource model
  *
  * @return void
  */
  protected function _construct()
  {
      $this->_init('MageBuzz\Blog\Model\ResourceModel\Post');
  }
 
  /**
  * Prepare grid's statuses.
  * Available event staff_grid_get_available_statuses to customize statuses.
  *
  * @return array
  */
  public function getAvailableStatuses()
  {
      return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
  }
}