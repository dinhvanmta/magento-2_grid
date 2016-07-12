<?php
/**
 * @copyright Copyright (c) 2016 www.magebuzz.com
 */
namespace Magebuzz\Helpdesk\Block\Ticket\Index;

/**
 * Sales ticket history block
 */
class Create extends \Magento\Framework\View\Element\Template
{
    protected $_helpdeskHelper;

    /**
     * @var string
     */
    protected $_template = 'ticket/index/create.phtml';

    /**
     * @var \Magebuzz\Helpdesk\Model\TicketFactory
     */
    protected $_ticketFactory;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    protected $_localeResolver;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magebuzz\Helpdesk\Model\TicketFactory $ticketFactory
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magebuzz\Helpdesk\Model\Ticket\Config $ticketConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Locale\ResolverInterface $localeResolver,
        \Magebuzz\Helpdesk\Model\TicketFactory $ticketFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magebuzz\Helpdesk\Helper\Data $heldeskHelper,
        array $data = []
    ) {
        $this->_ticketFactory = $ticketFactory;
        $this->_customerSession = $customerSession;
        $this->_helpdeskHelper = $heldeskHelper;
        $this->_localeResolver = $localeResolver;
        parent::__construct($context, $data);
    }

    public function isCustomerLoggedIn()
    {
        return (boolean)$this->_customerSession->isLoggedIn();
    }

    public function getCustomer()
    {
        return $this->_customerSession->getCustomer();
    }

    public function getPrioritySelection()
    {
        $collection = $this->_helpdeskHelper->getPriorityOptions();
        return $collection;
    }

    public function getDepartmentSelection()
    {
        $collection = $this->_helpdeskHelper->getDepartmentOptions(true, $this->isCustomerLoggedIn());
        return $collection;
    }

    public function getCustomerOrderSelection($customerId)
    {
        $collection = $this->_helpdeskHelper->getCustomerOrderOptions($customerId);
        return $collection;
    }

    public function getFormAction()
    {
        return $this->getUrl('helpdesk/ticket/createPost');
    }

    public function enableCaptcha()
    {
        return $this->_helpdeskHelper->enableCaptcha();
    }

    public function getPublicKey()
    {
        return $this->_helpdeskHelper->getPublicKey();
    }

    public function getPrivateKey()
    {
        return $this->_helpdeskHelper->getPrivateKey();
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->_localeResolver->getLocale();
    }

    public function _formatDate($dateString)
    {
        $date = new \DateTime($dateString);
        if ($date == new \DateTime('today')) {
            return $this->_localeDate->formatDateTime(
                $date,
                \IntlDateFormatter::NONE,
                \IntlDateFormatter::SHORT
            );
        }
        return $this->_localeDate->formatDateTime(
            $date,
            \IntlDateFormatter::MEDIUM,
            \IntlDateFormatter::MEDIUM
        );
    }
}
