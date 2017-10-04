<?php
/**
 * Copyright © 2011-2017 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
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
     * Marker image config path
     */
    const XML_CONTACTMAP_MARKER = 'contact/map/marker';
 	
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
     * Retrieve marker icon
     *
     * @return string
     */
    public function getMarkerIcon()
    {
		return $this->_getConfig(self::XML_CONTACTMAP_MARKER);
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
