<?php


class Sylvian_BlogPostModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();

        $id_blog_post = Tools::getValue('id_blog_post');
        if ($id_blog_post) {
            $this->context->smarty->assign([
                'base_url' => $this->context->shop->getBaseURL(),
                'post' => Db::getInstance()->executeS('SELECT * FROM ' . _DB_PREFIX_ . 'blog_post WHERE id_blog_post = ' . (int)$id_blog_post)
            ]);
            $this->setTemplate('module:sylvian_blog/views/templates/front/post.tpl');
        } else {
            $this->context->smarty->assign([
                'base_url' => $this->context->shop->getBaseURL(),
                'categories' => Db::getInstance()->executeS('SELECT * FROM ' . _DB_PREFIX_ . 'blog_category')
            ]);
            $this->setTemplate('module:sylvian_blog/views/templates/front/category.tpl');
        }
    }
}