<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 *
 * See COPYING.txt for license details.
 */
namespace Faonni\ContactMap\Block;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Locale\ResolverInterface as LocalResolverInterface;
use Magento\MediaStorage\Helper\File\Storage\Database as StorageHelper;
use Faonni\ContactMap\Helper\Data as ContactMapHelper;

/**
 * Map Block
 */
class Map extends Template
{
    /**
     * @var ContactMapHelper
     */
    private $helper;

    /**
     * @var LocalResolverInterface
     */
    private $localeResolver;

    /**
     * @var StorageHelper
     */
    private $fileStorageHelper;

    /**
     * Initialize Block
     *
     * @param Context $context
     * @param StorageHelper $fileStorageHelper
     * @param LocalResolverInterface $localeResolver
     * @param ContactMapHelper $helper
     * @param mixed[] $data
     */
    public function __construct(
        Context $context,
        StorageHelper $fileStorageHelper,
        LocalResolverInterface $localeResolver,
        ContactMapHelper $helper,
        array $data = []
    ) {
        $this->fileStorageHelper = $fileStorageHelper;
        $this->localeResolver = $localeResolver;
        $this->helper = $helper;

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
        return $this->helper->isEnabled();
    }

    /**
     * Retrieve Map Api Key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->helper->getApiKey();
    }

    /**
     * Retrieve Locale Code
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->localeResolver->getLocale();
    }

    /**
     * Retrieve Marker Icon
     *
     * @return string
     */
    public function getMarkerIcon()
    {
        return $this->helper->getMarkerIcon();
    }

    /**
     * Retrieve Marker Icon Url
     *
     * @return string|null
     */
    public function getMarkerIconSrc()
    {
        if ($this->getMarkerIcon()) {
            $folderName = 'contact/map/marker';
            $path = $folderName . '/' . $this->getMarkerIcon();
            if ($this->isFile($path)) {
                return $this->_urlBuilder
                    ->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . $path;
            }
        }
        return null;
    }

    /**
     * Retrieve Map Zoom
     *
     * @return string
     */
    public function getZoom()
    {
        return $this->helper->getZoom();
    }

    /**
     * Retrieve Marker Position
     *
     * @return string
     */
    public function getMarkerPosition()
    {
        $marker = $this->helper->getMarkerPosition();
        $marker['icon'] = $this->getMarkerIconSrc() ?: null;

        return base64_encode((string)json_encode([$marker]));
    }

    /**
     * If Db File Storage Is On - Find There, Otherwise - Just file_exists
     *
     * @param string $filename
     * @return bool
     */
    private function isFile($filename)
    {
        if ($this->fileStorageHelper->checkDbUsage() &&
                !$this->getMediaDirectory()->isFile($filename)) {
            $this->fileStorageHelper->saveFileToFilesystem($filename);
        }
        return $this->getMediaDirectory()->isFile($filename);
    }
}
