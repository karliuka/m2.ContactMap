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
namespace Faonni\ContactMap\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Faonni ContactMap Data helper
 */
class Data extends AbstractHelper
{
    /**
     * Enabled config path
     */
    const XML_CONTACTMAP_ENABLED = 'contact/map/enabled';
    	
    /**
     * Latitude config path
     */
    const XML_CONTACTMAP_LATITUDE = 'contact/map/latitude';

    /**
     * Longitude config path
     */
    const XML_CONTACTMAP_LONGITUDE = 'contact/map/longitude';

    /**
     * Zoom Level config path
     */
    const XML_CONTACTMAP_ZOOM = 'contact/map/zoom';
 
    /**
     * Api key config path
     */
    const XML_CONTACTMAP_API_KEY = 'contact/map/api_key';

 	
    /**
     * Check ContactMap functionality should be enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->_getConfig(self::XML_CONTACTMAP_ENABLED) && $this->getApiKey();
    } 
    
    /**
     * Retrieve map zoom
     *
     * @return string
     */
    public function getZoom()
    {
		return $this->_getConfig(self::XML_CONTACTMAP_ZOOM);
    } 
    
    /**
     * Retrieve map api key
     *
     * @return string
     */
    public function getApiKey()
    {
		return $this->_getConfig(self::XML_CONTACTMAP_API_KEY);
    } 
            
    /**
     * Retrieve marker position
     *
     * @return array
     */
    public function getMarkerPosition()
    {
		$config = [
			'lat' => $this->_getConfig(self::XML_CONTACTMAP_LATITUDE),
			'lng' => $this->_getConfig(self::XML_CONTACTMAP_LONGITUDE)
		];        
        return $config;
    } 
    
    /**
     * Retrieve store configuration data
     *
     * @param   string $path
     * @return  string|null
     */
    protected function _getConfig($path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }      
}
