<?php

require _PS_MODULE_DIR_ . 'sylvian_blog/classes/BlogCategory.php';
require _PS_MODULE_DIR_ . 'sylvian_blog/classes/BlogPost.php';

if (!defined('_PS_VERSION_')) {
    exit;
}

class Sylvian_Blog extends Module {
    public function __construct() {
        $this->name = 'sylvian_blog';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Sylvian BRUNET';
        $this->need_instance = true;
        $this->ps_versions_compliancy = [
            'min' => '1.7',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;
        parent::__construct();


        $this->displayName = $this->l('Blog');
        $this->description = $this->l('Mon blog');
        $this->confirmUninstall = $this->l('Êtes-vous sûr de vouloir désinstaller ce module ?');
    }

    public function install() {
        $bdd = Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'blog_category (id_blog_category INT(11) NOT NULL AUTO_INCREMENT, title VARCHAR(255), description VARCHAR(255), PRIMARY KEY (id_blog_category))');
        $bdd = Db::getInstance()->execute('CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'blog_post (id_blog_post INT(11) NOT NULL AUTO_INCREMENT, id_blog_category INT(11), title VARCHAR(255), excerpt VARCHAR(100), content VARCHAR(255), PRIMARY KEY (id_blog_post))');

        $this->addTab('AdminBlogCategory', 'Blog category');
        $this->addTab('AdminBlogPost', 'Blog post');
        return parent::install() && $bdd;
    }

    public function uninstall() {
        $tabCategory = Tab::getInstanceFromClassName('AdminBlogCategory');
        $tabCategory->delete();
        $tabPost = Tab::getInstanceFromClassName('AdminBlogPost');
        $tabPost->delete();
        return parent::uninstall();
    }

    public function getContent() {
        /*
        $blogCategory = new BlogCategory();
        $blogCategory->title = 'Ma catégorie';
        $blogCategory->description = 'Description de ma catégorie';
        $blogCategory->save();
        */

        return '<a href="' . Context::getContext()->link->getAdminLink('AdminBlogCategory') . '">Admin Blog Category</a><br>' .
               '<a href="' . Context::getContext()->link->getAdminLink('AdminBlogPost') . '">Admin Blog Post</a>';
    }

    public function addTab($controller, $tabName) {
        $tab = new Tab();
        $tab->active = true;
        $tab->class_name = $controller;
        $tab->name = array();

        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = $tabName;
        }
        $tab->id_parent = -1;
        $tab->module = $this->name;
        $tab->add();
    }
}