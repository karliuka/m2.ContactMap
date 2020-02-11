<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
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
     * @var ContactMapHelper
     */
    protected $helper;

    /**
     * Locale Resolver
     *
     * @var ResolverInterface
     */
    protected $resolver;

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
        $this->helper = $helper;
        $this->resolver = $resolver;

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
        return $this->resolver->getLocale();
    }

    /**
     * Retrieve Script Src
     *
     * @return string
     */
    public function getSrc()
    {
        $src = 'https://maps.googleapis.com/maps/api/js?key=%s&language=%s';
        return sprintf($src, $this->getApiKey(), $this->getLocale());
    }
}
