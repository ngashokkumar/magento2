<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Install
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Common database config installation block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Magento\Install\Block\Db;

class Type extends \Magento\View\Block\Template
{
    /**
     * Db title
     *
     * @var string
     */
    protected $_title;

    /**
     * Install installer config
     *
     * @var \Magento\Install\Model\Installer\Config
     */
    protected $_installerConfig = null;

    /**
     * Install installer config
     *
     * @var \Magento\Core\Model\Session\Generic
     */
    protected $_session;

    /**
     * @param \Magento\View\Block\Template\Context $context
     * @param \Magento\Core\Helper\Data $coreData
     * @param \Magento\Install\Model\Installer\Config $installerConfig
     * @param \Magento\Core\Model\Session\Generic $session
     * @param array $data
     */
    public function __construct(
        \Magento\View\Block\Template\Context $context,
        \Magento\Core\Helper\Data $coreData,
        \Magento\Install\Model\Installer\Config $installerConfig,
        \Magento\Core\Model\Session\Generic $session,
        array $data = array()
    ) {
        parent::__construct($context, $coreData, $data);
        $this->_installerConfig = $installerConfig;
        $this->_session = $session;
    }

    /**
     * Return Db title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Retrieve configuration form data object
     *
     * @return \Magento\Object
     */
    public function getFormData()
    {
        $data = $this->getData('form_data');
        if (is_null($data)) {
            $data = $this->_session->getConfigData(true);
            if (empty($data)) {
                $data = $this->_installerConfig->getFormData();
            } else {
                $data = new \Magento\Object($data);
            }
            $this->setFormData($data);
        }
        return $data;
    }
}
