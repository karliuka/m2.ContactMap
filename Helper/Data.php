<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 *
 * See COPYING.txt for license details.
 */
namespace Faonni\ContactMap\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

/**
 * ContactMap Helper
 */
class Data extends AbstractHelper
{
    /**
     * Enabled Config Path
     */
    const XML_CONTACTMAP_ENABLED = 'contact/map/enabled';

    /**
     * Latitude Config Path
     */
    const XML_CONTACTMAP_LATITUDE = 'contact/map/latitude';

    /**
     * Longitude Config Path
     */
    const XML_CONTACTMAP_LONGITUDE = 'contact/map/longitude';

    /**
     * Zoom Level Config Path
     */
    const XML_CONTACTMAP_ZOOM = 'contact/map/zoom';

    /**
     * Api Key Config Path
     */
    const XML_CONTACTMAP_API_KEY = 'contact/map/api_key';

    /**
     * Marker Image Config Path
     */
    const XML_CONTACTMAP_MARKER = 'contact/map/marker';

    /**
     * Check ContactMap Functionality Should Be Enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->_getConfig(self::XML_CONTACTMAP_ENABLED) && $this->getApiKey();
    }

    /**
     * Retrieve Marker Icon
     *
     * @return string
     */
    public function getMarkerIcon()
    {
        return (string)$this->_getConfig(self::XML_CONTACTMAP_MARKER);
    }

    /**
     * Retrieve Map Zoom
     *
     * @return string
     */
    public function getZoom()
    {
        return (string)$this->_getConfig(self::XML_CONTACTMAP_ZOOM);
    }

    /**
     * Retrieve Map Api Key
     *
     * @return string
     */
    public function getApiKey()
    {
        return (string)$this->_getConfig(self::XML_CONTACTMAP_API_KEY);
    }

    /**
     * Retrieve Marker Position
     *
     * @return mixed[]
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
     * Retrieve Store Configuration Data
     *
     * @param   string $path
     * @return  string|null
     */
    protected function _getConfig($path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }
}
