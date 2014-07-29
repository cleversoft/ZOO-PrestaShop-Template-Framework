<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class ZooHomeFeatured extends Module
{
	protected static $cache_products;

	public function __construct()
	{
		$this->name = 'zoohomefeatured';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'ZooExtension';
		$this->need_instance = 0;
		$this->bootstrap = true;
		parent::__construct();
		$this->displayName = $this->l('Featured products on the homepage');
		$this->description = $this->l('Displays featured products in the central column of your homepage.');
	}

	public function install()
	{
		$this->_clearCache('*');
		Configuration::updateValue('HOME_FEATURED_NBR', 8);
		Configuration::updateValue('sliderenabled', 1);
		Configuration::updateValue('slideresponsive', 1);
		Configuration::updateValue('res_item', 5);
		Configuration::updateValue('res_breakpoints', '');
		Configuration::updateValue('slide_lazyload', 1);
		Configuration::updateValue('item_column', 4);
		if (!parent::install()
            || !$this->registerHook('displayHome')
            || !$this->registerHook('displayHeader' )
			|| !$this->registerHook('addproduct')
			|| !$this->registerHook('updateproduct')
			|| !$this->registerHook('deleteproduct')
		)
			return false;

		return true;
	}

	public function uninstall()
	{
		$this->_clearCache('*');

		return parent::uninstall();
	}

	public function getContent()
	{
		$output = '';
		$errors = array();
		if (Tools::isSubmit('submitModule'))
		{
			$nbr = (int)Tools::getValue('HOME_FEATURED_NBR');
			if (!$nbr || $nbr <= 0 || !Validate::isInt($nbr))
				$errors[] = $this->l('An invalid number of products has been specified.');
			else
			{
				Tools::clearCache(Context::getContext()->smarty, $this->getTemplatePath('zoohomefeatured.tpl'));
				Configuration::updateValue('HOME_FEATURED_NBR', (int)$nbr);
			}
            Configuration::updateValue('sliderenabled', (int)Tools::getValue('sliderenabled'));
            Configuration::updateValue('slideresponsive', (int)Tools::getValue('slideresponsive'));
            Configuration::updateValue('res_item', (int)Tools::getValue('res_item'));
            Configuration::updateValue('res_breakpoints', Tools::getValue('res_breakpoints'));
            Configuration::updateValue('slide_lazyload', Tools::getValue('slide_lazyload'));
            Configuration::updateValue('item_column', (int)Tools::getValue('item_column'));
			if (isset($errors) && count($errors))
				$output .= $this->displayError(implode('<br />', $errors));
			else
				$output .= $this->displayConfirmation($this->l('Your settings have been updated.'));
		}

		return $output.$this->renderForm();
	}

    public function getConfigFieldsValues()
    {
        return array(
            'HOME_FEATURED_NBR' => Tools::getValue('HOME_FEATURED_NBR', Configuration::get('HOME_FEATURED_NBR')),
            'sliderenabled' => Tools::getValue('sliderenabled', Configuration::get('sliderenabled')),
            'slideresponsive' => Tools::getValue('slideresponsive', Configuration::get('slideresponsive')),
            'res_item' => Tools::getValue('res_item', Configuration::get('res_item')),
            'res_breakpoints' => Tools::getValue('res_breakpoints', Configuration::get('res_breakpoints')),
            'slide_lazyload' => Tools::getValue('slide_lazyload', Configuration::get('slide_lazyload')),
            'item_column' => Tools::getValue('item_column', Configuration::get('item_column')),
        );
    }

    public function renderForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->l('Product sliders'),
                        'name' => 'sliderenabled',
                        'is_bool' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 1,
                                    'name' => $this->l('Enable')
                                ),
                                array(
                                    'id_option' => 0,
                                    'name' => $this->l('Disable')
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Responsive'),
                        'name' => 'slideresponsive',
                        'preffix_wrapper' => 'featured_slide_responsive',
                        'wrapper_hidden' => true,
                        'is_bool' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 1,
                                    'name' => $this->l('By items display')
                                ),
                                array(
                                    'id_option' => 0,
                                    'name' => $this->l('By Breakpoints')
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Responsive items display'),
                        'name' => 'res_item',
                        'desc' => $this->l('Box-model width of individual carousel items, including horizontal borders and padding'),
                        'wrapper_hidden' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Breakpoints'),
                        'name' => 'res_breakpoints',
                        'desc' => $this->l('Size:Column. Ex: [0, 2],[480, 2], [600, 3],[700, 3], [900, 4]'),
                        'wrapper_hidden' => true,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Enable lazyLoad'),
                        'name' => 'slide_lazyload',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            )
                        ),
                        'wrapper_hidden' => true,
                        'suffix_wrapper' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Column'),
                        'name' => 'item_column',
                        'desc' => $this->l('Limit number of items on row'),
                        'preffix_wrapper' => 'featured_slide_item_column',
                        'wrapper_hidden' => true,
                        'suffix_wrapper' => true,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Limit products'),
                        'name' => 'HOME_FEATURED_NBR',
                        'class' => 'fixed-width-xs',
                        'desc' => $this->l('Set the number of products that you would like to display on homepage (default: 8).'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );
        return $helper->generateForm(array($fields_form));

    }

	public function hookDisplayHeader($params)
	{
        if (isset($this->context->controller->php_self) && $this->context->controller->php_self == 'index')
            $this->context->controller->addCSS(($this->_path).'zoohomefeatured.css', 'all');
            if((Configuration::get('sliderenabled')) == 1){
                $this -> context -> controller -> addJS($this -> _path . 'js/zoohomefeatured.js');
            }
	}

	public function _cacheProducts()
	{
		if (!isset(ZooHomeFeatured::$cache_products))
		{
			$category = new Category(Context::getContext()->shop->getCategory(), (int)Context::getContext()->language->id);
			$nb = (int)Configuration::get('HOME_FEATURED_NBR');
			ZooHomeFeatured::$cache_products = $category->getProducts((int)Context::getContext()->language->id, 1, ($nb ? $nb : 8), 'position');
		}

		if (ZooHomeFeatured::$cache_products === false || empty(ZooHomeFeatured::$cache_products))
			return false;
	}

	public function hookDisplayHome($params)
	{
		if (!$this->isCached('zoohomefeatured.tpl', $this->getCacheId()) && !$this->isCached('zoohomefeatured-slider.tpl', $this->getCacheId()))
		{
			$this->_cacheProducts();
			$this->smarty->assign(
				array(
					'products' => ZooHomeFeatured::$cache_products,
					'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
					'homeSize' => Image::getSize(ImageType::getFormatedName('home')),
				)
			);
		}
        if((Configuration::get('sliderenabled')) == 1)
            return $this -> display(__FILE__, 'zoohomefeatured-slider.tpl', $this -> getCacheId());
        else
            return $this -> display(__FILE__, 'zoohomefeatured.tpl', $this -> getCacheId());
	}

	public function hookAddProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookUpdateProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookDeleteProduct($params)
	{
		$this->_clearCache('*');
	}

	public function _clearCache($template, $cache_id = NULL, $compile_id = NULL)
	{
		parent::_clearCache('zoohomefeatured-slider.tpl');
		parent::_clearCache('zoohomefeatured.tpl');
	}
}
