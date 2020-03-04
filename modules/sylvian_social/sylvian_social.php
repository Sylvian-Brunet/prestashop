<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Sylvian_Social extends Module {
    public function __construct() {
        $this->name = 'sylvian_social';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Sylvian BRUNET';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.7',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Module Sylvian');
        $this->description = $this->l('Module for Prestashop course, by Sylvian BRUNET');
        $this->confirmUninstall = $this->l('Êtes-vous sûr de vouloir désinstaller ce module ?');

        if (!Configuration::get('sylvian_social_insta')) $this->warning = $this->l('Aucun lien instagram fourni');
        if (!Configuration::get('sylvian_social_facebook')) $this->warning = $this->l('Aucun lien instagram fourni');
        if (!Configuration::get('sylvian_social_twitter')) $this->warning = $this->l('Aucun lien instagram fourni');
    }

    Public function install() {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        if (!parent::install() ||
            !$this->registerHook('leftColumn') ||
            !$this->registerHook('header') ||
            !Configuration::updateValue('sylvian_social_insta', 'https://www.instagram.com/') ||
            !Configuration::updateValue('sylvian_social_facebook', 'https://www.facebook.com/') ||
            !Configuration::updateValue('sylvian_social_twitter', 'https://www.twitter.com/')
        ) {
            return false;
        }
        return true;
    }

    public function uninstall() {
        if (!parent::uninstall() ||
            !Configuration::deleteByName('sylvian_social_insta') ||
            !Configuration::deleteByName('sylvian_social_facebook') ||
            !Configuration::deleteByName('sylvian_social_twitter')
        ) {
            return false;
        }
        return true;
    }

    public function getContent() {

        $output = null;
        if (Tools::isSubmit('btnSubmit')) {

            $urlInstagram = strval(Tools::getValue('sylvian_social_insta'));
            $urlFacebook  = strval(Tools::getValue('sylvian_social_facebook'));
            $urlTwitter   = strval(Tools::getValue('sylvian_social_twitter'));

            if (!$urlInstagram|| empty($urlInstagram)) {
                $output .= $this->displayError($this->l('Invalid Instagram Link value'));
            } else if (!$urlFacebook|| empty($urlFacebook)) {
                $output .= $this->displayError($this->l('Invalid Facebook Link value'));
            } else if (!$urlTwitter|| empty($urlTwitter)) {
                $output .= $this->displayError($this->l('Invalid Twitter Link value'));
            } else {
                Configuration::updateValue('sylvian_social_insta', $urlInstagram);
                Configuration::updateValue('sylvian_social_facebook', $urlFacebook);
                Configuration::updateValue('sylvian_social_twitter', $urlTwitter);
                $output .= $this->displayConfirmation($this->l('Settings updated'));
            }
        }
        return $output.$this->displayForm();
    }

    public function displayForm()
    {
        // Récupère la langue par défaut
        $defaultLang = (int)Configuration::get('PS_LANG_DEFAULT');

        // Initialise les champs du formulaire dans un tableau
        $form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Configurer les liens des réseaux sociaux : '),
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Instagram'),
                        'name' => 'sylvian_social_insta',
                        'size' => 255,
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Facebook'),
                        'name' => 'sylvian_social_facebook',
                        'size' => 255,
                        'required' => true
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Twitter'),
                        'name' => 'sylvian_social_twitter',
                        'size' => 255,
                        'required' => true
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'name'  => 'btnSubmit'
                )
            ),
        );

        $helper = new HelperForm();

        // Module, token et currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        $helper->default_form_language = $defaultLang;

        $helper->fields_value['sylvian_social_insta']    = Configuration::get('sylvian_social_insta');
        $helper->fields_value['sylvian_social_facebook'] = Configuration::get('sylvian_social_facebook');
        $helper->fields_value['sylvian_social_twitter']  = Configuration::get('sylvian_social_twitter');

        return $helper->generateForm(array($form));
    }

    public function hookDisplayLeftColumn($params) {
        $this->context->smarty->assign([
            'sylvian_social_insta' => Configuration::get('sylvian_social_insta'),
            'sylvian_social_facebook' => Configuration::get('sylvian_social_facebook'),
            'sylvian_social_twitter' => Configuration::get('sylvian_social_twitter'),
        ]);

        return $this->display(__FILE__, 'sylvian_social.tpl');
    }

    public function hookDisplayHeader() {
        $this->context->controller->registerStylesheet(
            'sylvian_social',
            'modules/' .$this->name . '/views/css/sylvian_social.css',
            ['position' => 'head', 'priority' => 150]
        );
    }
}
