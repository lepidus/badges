<?php

/**
 * @file plugins/generic/badges/BadgesSettingsForm.inc.php
 *
 * Copyright 2019
 * Portal de Revistas de la Universidad Nacional de La Plata
 *  https://revistas.unlp.edu.ar
 *  https://sedici.unlp.edu.ar
 *
 * @author gonetil *
 * @class BadgesSettingsForm
 * @ingroup plugins_generic_badges
 *
 * @brief Form for journal managers to modify Almetric Badges plugin options
 */

import('lib.pkp.classes.form.Form');

class BadgesSettingsForm extends Form
{
    /** @var int */
    public $_journalId;

    /** @var object */
    public $_plugin;

    /**
     * Constructor
     * @param $plugin BadgesPlugin
     * @param $journalId int
     */
    public function __construct($plugin, $journalId)
    {
        $this->_journalId = $journalId;
        $this->_plugin = $plugin;

        parent::__construct($plugin->getTemplateResource('settingsForm.tpl'));

        $this->addCheck(new FormValidatorPost($this));
        $this->addCheck(new FormValidatorCSRF($this));
    }
    /**
     * Initialize form data.
     */
    public function initData()
    {
        $this->_data = array(
            'badgesShowDimensions' => $this->_plugin->getSetting($this->_journalId, 'badgesShowDimensions'),
            'badgesShowAltmetric' => $this->_plugin->getSetting($this->_journalId, 'badgesShowAltmetric'),
            'badgesShowPlumx' => $this->_plugin->getSetting($this->_journalId, 'badgesShowPlumx'),
            'badgesDimensionsHideWhenEmpty' => $this->_plugin->getSetting($this->_journalId, 'badgesDimensionsHideWhenEmpty'),
            'badgesAltmetricHideWhenEmpty' => $this->_plugin->getSetting($this->_journalId, 'badgesAltmetricHideWhenEmpty'),
            'badgesDimensionsStyle' => $this->_plugin->getSetting($this->_journalId, 'badgesDimensionsStyle'),
            'badgesAltmetricStyle' => $this->_plugin->getSetting($this->_journalId, 'badgesAltmetricStyle'),

        );
    }

    /**
     * Assign form data to user-submitted data.
     */
    public function readInputData()
    {
        $this->readUserVars(array('badgesShowDimensions'));
        $this->readUserVars(array('badgesShowAltmetric'));
        $this->readUserVars(array('badgesShowPlumx'));
        $this->readUserVars(array('badgesDimensionsHideWhenEmpty'));
        $this->readUserVars(array('badgesAltmetricHideWhenEmpty'));
        $this->readUserVars(array('badgesPlumxHideWhenEmpty'));
        $this->readUserVars(array('badgesDimensionsStyle'));
        $this->readUserVars(array('badgesAltmetricStyle'));
    }

    /**
     * Fetch the form.
     * @copydoc Form::fetch()
     */
    public function fetch($request, $template = null, $display = false)
    {
        $templateMgr = TemplateManager::getManager($request);
        $templateMgr->assign('pluginName', $this->_plugin->getName());
        return parent::fetch($request);
    }

    /**
     * Save settings.
     */
    /**
     * @copydoc Form::execute()
     */


    public function execute(...$functionArgs)
    {
        $plugin = & $this->_plugin;
        $contextId = $this->_journalId;

        $plugin->updateSetting($contextId, 'badgesShowDimensions', $this->getData('badgesShowDimensions'), 'string');
        $plugin->updateSetting($contextId, 'badgesShowAltmetric', $this->getData('badgesShowAltmetric'), 'string');
        $plugin->updateSetting($contextId, 'badgesShowPlumx', $this->getData('badgesShowPlumx'), 'string');
        $plugin->updateSetting($contextId, 'badgesDimensionsHideWhenEmpty', $this->getData('badgesDimensionsHideWhenEmpty'), 'string');
        $plugin->updateSetting($contextId, 'badgesAltmetricHideWhenEmpty', $this->getData('badgesAltmetricHideWhenEmpty'), 'string');
        $plugin->updateSetting($contextId, 'badgesPlumxHideWhenEmpty', $this->getData('badgesPlumxHideWhenEmpty'), 'string');
        $plugin->updateSetting($contextId, 'badgesDimensionsStyle', $this->getData('badgesDimensionsStyle'), 'string');
        $plugin->updateSetting($contextId, 'badgesAltmetricStyle', $this->getData('badgesAltmetricStyle'), 'string');

        parent::execute(...$functionArgs);

    }



}
