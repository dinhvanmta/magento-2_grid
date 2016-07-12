<?php
namespace MageBuzz\Blog\Model\Post\Source;
 
class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
  /**
  * @var \Magebuzz\Staff\Model\Grid
  */
  protected $_post;
 
  /**
  * Constructor
  *
  * @param \Magebuzz\Staff\Model\Grid $grid
  */
  public function __construct(\MageBuzz\Blog\Model\Post $post)
  {
      $this->_post = $post;
  }
 
  /**
  * Get options
  *
  * @return array
  */
  public function toOptionArray()
  {
      $options[] = ['label' => '', 'value' => ''];
      $availableOptions = $this->_post->getAvailableStatuses();
      foreach ($availableOptions as $key => $value) {
          $options[] = [
          'label' => $value,
          'value' => $key,
          ];
  }
  return $options;
  }
}