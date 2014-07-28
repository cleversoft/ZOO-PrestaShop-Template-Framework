<?php
/*
 * 2007-2012 PrestaShop
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
 *  @copyright  2007-2012 PrestaShop SA
 *  @version  Release: $Revision: 7048 $
 *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

if (!defined('_PS_VERSION_'))
	exit ;

class ZooHomeTabs extends Module {
	private $_html = '';
	private $user_groups;
	private $pattern = '/^([A-Z_]*)[0-9]+/';
	private $page_name = '';
	private $spacer_size = '5';
	private $_postErrors = array();

	function __construct() {
		$this -> name = 'zoohometabs';
		$this -> tab = 'front_office_features';
		$this -> version = '1.0.0';
		$this -> author = 'ZooExtension';
		$this -> need_instance = 0;
		$this->bootstrap = true;

		parent::__construct();

		$this -> displayName = $this->l('Display products as tabs on hompage');
		$this -> description = $this->l('Displays Featured, special, bestseller, new and category,  Products in the middle of your homepage.');
	}

	function install() {
		$this -> _clearCache('zoohometabs.tpl');
		$this -> _clearCache('zoohometabs-slider.tpl');
		if (!Configuration::updateValue('ZOO_tab_count', 10)
            || !Configuration::updateValue('ZOO_tab_sliderenabled', 0)
            || !Configuration::updateValue('ZOO_tab_slideresponsive', 1)
            || !Configuration::updateValue('ZOO_tab_res_item', 250)
            || !Configuration::updateValue('ZOO_tab_res_breakpoints', '')
            || !Configuration::updateValue('ZOO_tab_slide_lazyload', 1)
            || !Configuration::updateValue('ZOO_tab_item_column', 4)
            || !Configuration::updateValue('ZOO_tab_showspecial', 1)
            || !Configuration::updateValue('ZOO_tab_showcategory', 1)
            || !Configuration::updateValue('ZOO_tab_showfeatured', 1)
            || !Configuration::updateValue('ZOO_tab_shownew', 1)
            || !Configuration::updateValue('category_ids', 3)
            || !parent::install()
            || !$this -> registerHook('displayHome')
            || !$this -> registerHook('displayHeader')
            || !$this -> registerHook('addproduct')
            || !$this -> registerHook('updateproduct')
            || !$this -> registerHook('deleteproduct'))
			return false;
		return true;
	}

	public function getContent() {

		if (Tools::isSubmit('submitModule')) {
			$count = (int)(Tools::getValue('count'));
			if (!$count OR $count <= 0 OR !Validate::isInt($count))
				$errors[] = $this->l('Invalid number of products');
			else
				Configuration::updateValue('ZOO_tab_count', (int)($count));
				$items = Tools::getValue('items');
			if (!(is_array($items) && Tools::getValue('showcategory')
                && count($items)
                && Configuration::updateValue('category_ids', (string)implode(',', $items))))
				$errors[] =$this->l('Unable to update settings.');
			
			Configuration::updateValue('ZOO_tab_sliderenabled', (int)(Tools::getValue('sliderenabled')));
			Configuration::updateValue('ZOO_tab_slideresponsive', (int)(Tools::getValue('slideresponsive')));
			Configuration::updateValue('ZOO_tab_res_item', (int)(Tools::getValue('res_item')));
			Configuration::updateValue('ZOO_tab_res_breakpoints', (Tools::getValue('res_breakpoints')));
			Configuration::updateValue('ZOO_tab_slide_lazyload', (Tools::getValue('slide_lazyload')));
			Configuration::updateValue('ZOO_tab_item_column', (int)(Tools::getValue('item_column')));
			Configuration::updateValue('ZOO_tab_showfeatured', (int)(Tools::getValue('showfeatured')));
			Configuration::updateValue('ZOO_tab_shownew', (int)(Tools::getValue('shownew')));
			Configuration::updateValue('ZOO_tab_showspecial', (int)(Tools::getValue('showspecial')));
			Configuration::updateValue('ZOO_tab_showcategory', (int)(Tools::getValue('showcategory')));

			if (isset($errors) AND sizeof($errors))
				$this->_html .= $this -> displayError(implode('<br />', $errors));
			else
				$this->_html .= $this -> displayConfirmation($this->l('Settings updated'));
			$this -> _clearCache('zoohometabs.tpl');
			$this -> _clearCache('zoohometabs-slider.tpl');
		}
		
		$this->_html .= $this->renderForm();

		return $this->_html;
	}


	public function renderForm()
	{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Menu Top Link'),
					'icon' => 'icon-link'
					),

				'input' => array(

					array(
						'type' => 'text',
						'label' => $this->l('Number of products'),
						'name' => 'count',
						'desc' => $this->l('Number of products to show'),
						),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Product sliders inside tab'),
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
                        'preffix_wrapper' => 'slide_responsive',
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
                        'preffix_wrapper' => 'slide_item_column',
                        'wrapper_hidden' => true,
                        'suffix_wrapper' => true,
                    ),
					array(
						'type' => 'switch',
						'label' => $this->l('Featured products'),
						'name' => 'showfeatured',
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
						),
					array(
						'type' => 'switch',
						'label' => $this->l('Special products'),
						'name' => 'showspecial',
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
						),
					array(
						'type' => 'switch',
						'label' => $this->l('New  products'),
						'name' => 'shownew',
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
						),
					array(
						'type' => 'switch',
						'label' => $this->l('Category products'),
						'name' => 'showcategory',
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
						),
					array(
						'type' => 'link_choice',
						'label' => '',
						'name' => 'link',
						'lang' => true,
						),	
					),
				'submit' => array(
					'name' => 'submitModule',
					'title' => $this->l('Save')
					)
				),
			);
		
		if (Shop::isFeatureActive())
			$fields_form['form']['description'] = $this->l('The modifications will be applied to').' '.(Shop::getContext() == Shop::CONTEXT_SHOP ? $this->l('shop').' '.$this->context->shop->name : $this->l('all shops'));
		
		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table =  $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();
		$helper->module = $this;
		$helper->identifier = $this->identifier;		
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id,
			'choices' => $this->renderChoicesSelect(),
			'selected_links' => $this->makeMenuOption(),
			);
		return $helper->generateForm(array($fields_form));
	}

	public function getConfigFieldsValues()
	{
		return array(
			'count' => Tools::getValue('ZOO_tab_count', Configuration::get('ZOO_tab_count')),
			'sliderenabled' => Tools::getValue('ZOO_tab_sliderenabled', Configuration::get('ZOO_tab_sliderenabled')),
			'slideresponsive' => Tools::getValue('ZOO_tab_slideresponsive', Configuration::get('ZOO_tab_slideresponsive')),
			'res_item' => Tools::getValue('ZOO_tab_res_item', Configuration::get('ZOO_tab_res_item')),
			'res_breakpoints' => Tools::getValue('ZOO_tab_res_breakpoints', Configuration::get('ZOO_tab_res_breakpoints')),
			'slide_lazyload' => Tools::getValue('ZOO_tab_slide_lazyload', Configuration::get('ZOO_tab_slide_lazyload')),
			'item_column' => Tools::getValue('ZOO_tab_item_column', Configuration::get('ZOO_tab_item_column')),
			'showfeatured' => Tools::getValue('ZOO_tab_showfeatured', Configuration::get('ZOO_tab_showfeatured')),
			'shownew' => Tools::getValue('ZOO_tab_shownew', Configuration::get('ZOO_tab_shownew')),
			'showspecial' => Tools::getValue('ZOO_tab_showspecial', Configuration::get('ZOO_tab_showspecial')),
			'showcategory' => Tools::getValue('ZOO_tab_showcategory', Configuration::get('ZOO_tab_showcategory')),
			);
	}


    public function renderChoicesSelect()
	{
		$spacer = str_repeat('&nbsp;', $this->spacer_size);
		$items = $this->getMenuItems();
		
		$html = '<select multiple="multiple" id="availableItems" style="width: 300px; height: 160px;">';
		$shop = new Shop((int)Shop::getContextShopID());
		$html .= '<optgroup label="'.$this->l('Categories').'">';	
		$html .= $this->generateCategoriesOption(
			Category::getNestedCategories(null, (int)$this->context->language->id, true), $items);
		$html .= '</optgroup>';
	
		$html .= '</select>';
		return $html;
	}



	private function getMenuItems()
	{
        $conf = Configuration::get('category_ids');
        if (strlen($conf))
            return explode(',', Configuration::get('category_ids'));
        else
            return array();
	}
	private function makeMenuOption()
	{
		$menu_item = $this->getMenuItems();
		$id_lang = (int)$this->context->language->id;
		$id_shop = (int)Shop::getContextShopID();
		$html = '<select multiple="multiple" name="items[]" id="items" style="width: 300px; height: 160px;">';
		foreach ($menu_item as $item)
		{
			if (!$item)
				continue;
			preg_match($this->pattern, $item, $values);
			$id = (int)substr($item, strlen($values[1]), strlen($item));
					$category = new Category((int)$id, (int)$id_lang);
					if (Validate::isLoadedObject($category))
						$html .= '<option selected="selected" value="'.$id.'">'.$category->name.'</option>'.PHP_EOL;
		
		}
		return $html.'</select>';
	}

	private function generateCategoriesOption($categories, $items_to_skip = null)
	{
		$html = '';
		foreach ($categories as $key => $category)
		{
			if (isset($items_to_skip) && !in_array('CAT'.(int)$category['id_category'], $items_to_skip))
			{
				$shop = (object) Shop::getShop((int)$category['id_shop']);
				$html .= '<option value="'.(int)$category['id_category'].'">'
					.str_repeat('&nbsp;', $this->spacer_size * (int)$category['level_depth']).$category['name'].' ('.$shop->name.')</option>';
			}

			if (isset($category['children']) && !empty($category['children']))
				$html .= $this->generateCategoriesOption($category['children'], $items_to_skip);

		}

		return $html;
	}


	public function hookDisplayHeader($params) {
		if (!isset($this->context->controller->php_self) || $this->context->controller->php_self != 'index')
			return;
		$this -> context -> controller -> addCss($this->_path . 'css/zoohometabs.css');
		$this -> context -> controller -> addJS($this->_path . 'js/zoohometabs.js');
        if((Configuration::get('ZOO_tab_sliderenabled')) == 1){
            $this -> context -> controller -> addCss($this->_path . 'css/owl.carousel.css');
            $this -> context -> controller -> addCss($this->_path . 'css/owl.theme.css');
            $this -> context -> controller -> addJS($this -> _path . 'js/owl.carousel.min.js');
            $this -> context -> controller -> addJS($this -> _path . 'js/zoohometabs-slider.js');
        }
        $module_settings = array(
            "enableslide" => (Configuration::get('ZOO_tab_sliderenabled')),
            "slideresponsive" => (Configuration::get('ZOO_tab_slideresponsive')),
            "res_item" => (Configuration::get('ZOO_tab_res_item')),
            "res_breakpoints" => (Configuration::get('ZOO_tab_res_breakpoints')),
            "slide_lazyload" => (Configuration::get('ZOO_tab_slide_lazyload')),
            "item_column" => (Configuration::get('ZOO_tab_item_column')),
        );
        $this->context->smarty->assign('module_vars', $module_settings);
	}

	public function hookDisplayHome($params) {
		
		if (  (!$this -> isCached('zoohometabs.tpl', $this -> getCacheId('zoohometabs')))
            || (!$this -> isCached('zoohometabs-slider.tpl', $this -> getCacheId('zoohometabs')))) {
			$count = (int)(Configuration::get('ZOO_tab_count'));
			$id_lang = $params['cookie'] -> id_lang;
            $this->smarty->assign(array('homeSize' => Image::getSize(ImageType::getFormatedName('home'))));
			/* Get featured */
			if (Configuration::get('ZOO_tab_showfeatured') == 1) {
				$fcategory = new Category(Context::getContext() -> shop -> getCategory(), Configuration::get('PS_LANG_DEFAULT'));
				$fproducts = $fcategory -> getProducts($id_lang, 1, ($count ? $count : 10));

				$image_array=array();
				for($i=0;$i<count($fproducts);$i++)
				{
					if(isset($fproducts[$i]['id_product']))
						$image_array[$fproducts[$i]['id_product']]= Product::getProductsImgs($fproducts[$i]['id_product']);
				}
				$this->smarty->assign('fproducts_productimg',(isset($image_array) AND $image_array) ? $image_array : NULL);
				$this->smarty->assign(array('fproducts' => $fproducts));
			}
			/* Get special */
			if (Configuration::get('ZOO_tab_showspecial') == 1) {
				if (!Configuration::get('PS_CATALOG_MODE')) {
					if ($sproducts = Product::getPricesDrop($id_lang, 0, $count)) {

						$image_array=array();
						for($i=0;$i<count($sproducts);$i++)
						{
							if(isset($sproducts[$i]['id_product']))
								$image_array[$sproducts[$i]['id_product']]= Product::getProductsImgs($sproducts[$i]['id_product']);				
						}

						$this->smarty->assign('sproducts_productimg',(isset($image_array) AND $image_array) ? $image_array : NULL);

						$this -> smarty -> assign(array('special' => $sproducts));
					}
				}
			}

			/* Get new products */
			if (Configuration::get('ZOO_tab_shownew') == 1) {
				$nproducts = Product::getNewProducts($id_lang, 0, $count);

				$image_array=array();
				for($i=0;$i<count($nproducts);$i++)
				{
					if(isset($nproducts[$i]['id_product']))
						$image_array[$nproducts[$i]['id_product']]= Product::getProductsImgs($nproducts[$i]['id_product']);				
				}

				$this->smarty->assign('nproducts_productimg',(isset($image_array) AND $image_array) ? $image_array : NULL);

				$this -> smarty -> assign(array('nproducts' => $nproducts));
			}
			/* Get category products  */
			if (Configuration::get('ZOO_tab_showcategory') == 1) {

				$menu_item = $this->getMenuItems();
				$id_lang = (int)$this->context->language->id;
				$id_shop = (int)Shop::getContextShopID();

				$categories = array();

				foreach ($menu_item as $item) {
					if (!$item)
						continue;

					preg_match($this->pattern, $item, $values);
					$id = (int)substr($item, strlen($values[1]), strlen($item));


					$category = new Category((int)$id, (int)$id_lang);
					if (Validate::isLoadedObject($category)) {
						$categories[$item]['id'] = $item;
						$categories[$item]['name'] = $category -> name;
						$categories[$item]['products'] = $category -> getProducts($id_lang, 1, ($count ? $count : 10));

						$image_array=array();
						for($i=0;$i<count($categories[$item]['products']);$i++)
						{
							if(isset($categories[$item]['products'][$i]['id_product']))
								$image_array[$categories[$item]['products'][$i]['id_product']]= Product::getProductsImgs($categories[$item]['products'][$i]['id_product']);				
						}

						$categories[$item]['productimg'] = (isset($image_array) AND $image_array) ? $image_array : NULL;

					}

				}
				$this -> smarty -> assign(array('categories' => $categories));


			}

			$this -> smarty -> assign(array('add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY')));


		}
		if((Configuration::get('ZOO_tab_sliderenabled')) == 1)
			return $this -> display(__FILE__, 'zoohometabs-slider.tpl', $this -> getCacheId('zoohometabs'));
		else
			return $this -> display(__FILE__, 'zoohometabs.tpl', $this -> getCacheId('zoohometabs'));
	}

	public function hookAddProduct($params) {
		$this -> _clearCache('zoohometabs.tpl');
		$this -> _clearCache('zoohometabs-slider.tpl');
	}

	public function hookUpdateProduct($params) {
		$this -> _clearCache('zoohometabs.tpl');
		$this -> _clearCache('zoohometabs-slider.tpl');
	}

	public function hookDeleteProduct($params) {
		$this -> _clearCache('zoohometabs.tpl');
		$this -> _clearCache('zoohometabs-slider.tpl');
	}

}
