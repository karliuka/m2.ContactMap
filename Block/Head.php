<?php
/**
 * Copyright © 2011-2017 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\ContactMap\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Locale\ResolverInterface;
use Faonni\ContactMap\Helper\Data as ContactMapHelper;

/**
 * ContactMap Block Head
 */
class Head extends Template
{
    /**
     * Helper instance
     *
     * @var \Faonni\ContactMap\Helper\Data
     */
    protected $_helper; 
    
    /**
     * Resolver instance 
     * 
     * @var Magento\Framework\Locale\ResolverInterface
     */
    protected $_resolver;    
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Faonni\ContactMap\Helper\Data $helper
     * @param \Magento\Framework\Locale\ResolverInterface $resolver
     * @param array $data
     * 
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
		Context $context, 
		ContactMapHelper $helper,
		ResolverInterface $resolver,
		array $data = []
	) {
        $this->_helper = $helper;
        $this->_resolver = $resolver;
        parent::__construct($context, $data);
    }
    
    /**
     * Check ContactMap functionality should be enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->_helper->isEnabled();
    }
	
    /**
     * Retrieve map api key
     *
     * @return string
     */
    public function getApiKey()
    {
		return $this->_helper->getApiKey();
    } 
	
    /**
     * Return locale code
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->_resolver->getLocale();
    }    
}
