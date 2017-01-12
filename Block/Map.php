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
use Magento\Framework\UrlInterface;
use Magento\MediaStorage\Helper\File\Storage\Database as StorageHelper;
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
     * @var \Magento\MediaStorage\Helper\File\Storage\Database
     */
    protected $_fileStorageHelper;
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\MediaStorage\Helper\File\Storage\Database $fileStorageHelper	 
     * @param \Faonni\ContactMap\Helper\Data $helper
     * @param array $data
     * 
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
		Context $context,
		StorageHelper $fileStorageHelper,
		ContactMapHelper $helper,
		array $data = []
	) {
        $this->_fileStorageHelper = $fileStorageHelper;
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
     * Retrieve marker icon
     *
     * @return string
     */
    public function getMarkerIcon()
    {
		return $this->_helper->getMarkerIcon();
    } 
    
    /**
     * Retrieve marker icon src
     *
     * @return string
     */
    public function getMarkerIconSrc()
    {
		if ($this->getMarkerIcon()) {
			$folderName = 'contact/map/marker';
			$path = $folderName . '/' . $this->getMarkerIcon();
			if ($this->_isFile($path)) {
				return $this->_urlBuilder
					->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . $path;				
			}
		}
		return null;
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
		$marker = $this->_helper->getMarkerPosition();
		$marker['icon'] = $this->getMarkerIconSrc() ?: null;
		
		return base64_encode(json_encode([$marker]));
    }
	
    /**
     * If DB file storage is on - find there, otherwise - just file_exists
     *
     * @param string $filename relative path
     * @return bool
     */
    protected function _isFile($filename)
    {
        if ($this->_fileStorageHelper->checkDbUsage() && 
				!$this->getMediaDirectory()->isFile($filename)) {
            $this->_fileStorageHelper->saveFileToFilesystem($filename);
        }
        return $this->getMediaDirectory()->isFile($filename);
    }	
}
