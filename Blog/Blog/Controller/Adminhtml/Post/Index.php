<?php
namespace MageBuzz\Blog\Controller\Adminhtml\Post;
 
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
 
class Index extends \Magento\Backend\App\Action
{
  const ADMIN_RESOURCE = 'MageBuzz_Blog::post';
 
  /**
  * @var PageFactory
  */
  protected $resultPageFactory;
 
  /**
  * @param Context $context
  * @param PageFactory $resultPageFactory
  */
  public function __construct(Context $context,PageFactory $resultPageFactory) {
    parent::__construct($context);
    $this->resultPageFactory = $resultPageFactory;
  }
 
  /**
  * Index action
  *
  * @return \Magento\Backend\Model\View\Result\Page
  */
  public function execute()
  {
    /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
    $resultPage = $this->resultPageFactory->create();
    $resultPage->setActiveMenu('MageBuzz_Blog::post');
    $resultPage->addBreadcrumb(__('Posts'), __('Posts'));
    $resultPage->addBreadcrumb(__('Blog Post'), __('Blog Post'));
    $resultPage->getConfig()->getTitle()->prepend(__('Post'));
 
    return $resultPage;
  }
 
  /**
  * {@inheritdoc}
  */
  protected function _isAllowed()
  {
    return $this->_authorization->isAllowed(self::ADMIN_RESOURCE);
  }
}