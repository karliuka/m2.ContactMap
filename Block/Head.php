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
 * Head Block
 */
class Head extends Template
{
    /**
     * Helper
     *
     * @var \Faonni\ContactMap\Helper\Data
     */
    protected $_helper; 
    
    /**
     * Resolver Instance 
     * 
     * @var Magento\Framework\Locale\ResolverInterface
     */
    protected $_resolver;    
    
    /**
     * Initialize Block
     *
     * @param Context $context
     * @param ContactMapHelper $helper
     * @param ResolverInterface $resolver
     * @param array $data
     */
    public function __construct(
		Context $context, 
		ContactMapHelper $helper,
		ResolverInterface $resolver,
		array $data = []
	) {
        $this->_helper = $helper;
        $this->_resolver = $resolver;
        
        parent::__construct(
			$context, 
			$data
		);
    }
    
    /**
     * Check ContactMap Functionality Should Be Enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->_helper->isEnabled();
    }
	
    /**
     * Retrieve Map Api Key
     *
     * @return string
     */
    public function getApiKey()
    {
		return $this->_helper->getApiKey();
    } 
	
    /**
     * Return Locale Code
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->_resolver->getLocale();
    }    
}
