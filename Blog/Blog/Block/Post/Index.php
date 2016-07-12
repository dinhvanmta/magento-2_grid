<?php
/**
 * @copyright Copyright (c) 2016 www.magebuzz.com
 */
namespace Magebuzz\Helpdesk\Block\Ticket;

/**
 * Sales ticket history block
 */
class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @var string
     */
    protected $_template = 'ticket/index.phtml';

    /**
     * @var \Magebuzz\Helpdesk\Model\ResourceModel\Ticket\CollectionFactory
     */
    protected $_ticketCollectionFactory;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /** @var \Magebuzz\Helpdesk\Model\ResourceModel\Ticket\Collection */
    protected $tickets;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magebuzz\Helpdesk\Model\ResourceModel\Ticket\CollectionFactory $ticketCollectionFactory
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magebuzz\Helpdesk\Model\Ticket\Config $ticketConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magebuzz\Helpdesk\Model\ResourceModel\Ticket\CollectionFactory $ticketCollectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->_ticketCollectionFactory = $ticketCollectionFactory;
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->pageConfig->getTitle()->set(__('My Tickets'));
    }

    public function isCustomerLoggedIn()
    {
        return (boolean)$this->_customerSession->isLoggedIn();
    }

    public function getCustomer()
    {
        return $this->_customerSession->getCustomer();
    }

    /**
     * @return bool|\Magebuzz\Helpdesk\Model\ResourceModel\Ticket\Collection
     */
    public function getTickets()
    {
        if (!($customerId = $this->_customerSession->getCustomerId())) {
            return false;
        }
        if (!$this->tickets) {
            $this->tickets = $this->_ticketCollectionFactory->create()->addFieldToSelect(
                '*'
            )->addFieldToFilter(
                'customer_id',
                $customerId
            )->setOrder(
                'update_time',
                'desc'
            );
        }
        return $this->tickets;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getTickets()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'helpdesk.ticket.index.pager'
            )->setCollection(
                $this->getTickets()
            );
            $this->setChild('pager', $pager);
            $this->getTickets()->load();
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return string
     */
    public function getCreateHtml()
    {
        return $this->getChildHtml('helpdesk.ticket.index.create');
    }

    /**
     * @param object $ticket
     * @return string
     */
    public function getViewUrl($ticket)
    {
        return $this->getUrl('helpdesk/ticket/view', ['ticket_id' => $ticket->getMaskId()]);
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('customer/account/');
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
