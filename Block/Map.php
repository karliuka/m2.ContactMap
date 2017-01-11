<?php
/**
 * Faonni
 *  
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade module to newer
 * versions in the future.
 * 
 * @package     Faonni_ContactMap
 * @copyright   Copyright (c) 2016 Karliuka Vitalii(karliuka.vitalii@gmail.com) 
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Faonni\ContactMap\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Faonni\ContactMap\Helper\Data as ContactMapHelper;

/**
 * ContactMap Map Block
 */
class Map extends Template
{
    /**
     * Helper instance
     *
     * @var \Faonni\ContactMap\Helper\Data
     */
    protected $_helper; 
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Faonni\ContactMap\Helper\Data $helper
     * @param array $data
     * 
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
		Context $context, 
		ContactMapHelper $helper,
		array $data = []
	) {
        $this->_helper = $helper;
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
     * Retrieve map zoom
     *
     * @return string
     */
    public function getZoom()
    {
		return $this->_helper->getZoom();
    } 
            
    /**
     * Retrieve marker position
     *
     * @return array
     */
    public function getMarkerPosition()
    {
		$markers = [$this->_helper->getMarkerPosition()];		
		return base64_encode(json_encode($markers));
    }     
}
