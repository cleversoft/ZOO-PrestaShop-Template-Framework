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

class ZooThemeConfig extends Module
{
    private $_html = '';
	public function __construct()
	{
		$this->name = 'zoothemeconfig';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'ZooExtension';
		$this->need_instance = 0;
        $this->configName = 'themeconf';
		$this->bootstrap = true;
		parent::__construct();

		$this->displayName = $this->l('Theme Config');
		$this->description = $this->l('Show config theme.');
        $this->defaults = array(
            'main_text_color' => '#333333',
            'main_link_color' => '#777777',
            'main_link_hover_color' => '#00a9c7',
            'main_button_bg_color' => '#dddddd',
            'main_button_color' => '#333333',
            'main_button_hover_bg_color' => '#5bd2ec',
            'main_button_hover_color' => '#333333',
            'main_button_active_bg_color' => '#333333',
            'main_button_active_color' => '#ffffff',
            'main_tool_icon_bg_color' => '#f5f5f5',
            'main_tool_icon_hover_bg_color' => '#333333',
            'main_tool_icon_active_bg_color' => '#e5e5e5',
            'main_icon_bg_color' => '#d52462',
            'main_icon_hover_bg_color' => '#5bd2ec',
            'main_social_icon_bg_color' => '#888888',
            'main_social_icon_hover_bg_color' => '#333333',
            'main_important_link_hover_color' => '#ffffff',
            'main_important_link_hover_bg_color' => '#333333',
            'main_product_label_new_bg_color' => '#5bd2ec',
            'main_product_label_new_color' => '#ffffff',
            'main_product_label_sale_bg_color' => '#f12b63',
            'main_product_label_sale_color' => '#ffffff',
            'main_product_price_color' => '#00a9c7',
            'font_font_size' => '12px',
            'font_primary_font_family_group' => 'google',
            'font_primary_font_family' => 'Bitter',
            'font_primary_char_latin_ext' => '0',
            'font_primary_font_family_custom' => 'Arial, "Helvetica Neue", Helvetica, sans-serif',
            'page_bg_color' => 'rgba(0, 0, 0, 0)',
            'page_bg_image' => '',
            'page_bg_repeat' => 'repeat',
            'page_bg_attachment' => 'scroll',
            'page_bg_positionx' => 'center',
            'page_bg_positiony' => 'center',
            'page_pattern' => 'none',
            'header_top_border_color' => '#000000',
            'header_bg_color' => '#FFF',
            'header_pattern' => 'none',
            'header_inner_bg_color' => '#FFF',
            'header_text_color' => '#FFF',
            'header_link_color' => '#FFF',
            'header_link_hover_color' => '#333',
            'header_logo' => '',
            'header_logo_retina' => '',
            'header_search_text_color' => '#BBB',
            'header_search_text_hover_color' => '#333',
            'header_search_border_color' => '#DDD',
            'header_search_border_hover_color' => '#888',
            'header_dropdown_bg_color' => '#FFF',
            'header_dropdown_text_color' => '#333',
            'header_dropdown_link_color' => '#333',
            'header_dropdown_link_hover_color' => '#00a9c7',
            'nav_inner_bg_color' => '',
            'nav_stretched' => '',
            'nav_border' => '1',
            'nav_font_size' => '16',
            'nav_font_uppercase' => '1',
            'nav_item_bg_color' => '#f5f5f5',
            'nav_item_text_color' => '#333333',
            'nav_hover_item_bg_color' => '#5bd2ec',
            'nav_hover_item_text_color' => '#ffffff',
            'nav_active_item_bg_color' => '#333333',
            'nav_active_item_text_color' => '#ffffff',
            'nav_dropdown_bg_color' => '#ffffff',
            'nav_dropdown_text_color' => '#333333',
            'nav_dropdown_link_color' => '#333333',
            'nav_dropdown_link_hover_color' => '#00a9c7',
            'main_wrapper_bg_color' => '',
            'main_wrapper_patterns' => 'none',
            'main_wrapper_inner_bg_color' => '#ffffff',
            'category_view_aspect_ratio' => '1',
            'category_view_aspect_ratio_size' => '3:4',
            'category_view_position_image' => '1',
            'category_view_alt_image_position_value' => '2',
            'category_view_image_width' => '280',
            'category_view_image_height' => '380',
            'category_view_cat_desc' => '1',
            'category_view_cat_desc_style' => '1',
            'category_view_sub_thumb' => '1',
            'category_view_default_list' => '1',
            'category_view_grid_column_count' => '4',
            'category_view_grid_column_count_768' => '3',
            'category_view_grid_column_count_640' => '2',
            'category_view_grid_column_count_480' => '2',
            'category_view_grid_equal_height' => '1',
            'category_view_grid_hover_effect' => '1',
            'category_view_grid_display_rating' => '1',
            'category_view_grid_display_addtocart' => '2',
            'category_view_grid_display_addtolinks' => '1',
            'category_view_grid_addtolinks_simple' => '1',
            'category_view_list_hover_effect' => '1',
            'category_view_list_addtolinks_simple' => '0',
            'product_page_layout' => 'default',
            'product_page_addto_icon_bg_color' => '#aaaaaa',
            'product_page_addto_icon_hover_bg_color' => '#333333',
            'product_page_tab_inner_bg_color' => '',
            'product_page_tab_item_bg_color' => '#eeeeee',
            'product_page_tab_item_text_color' => '#333333',
            'product_page_tab_item_hover_bg_color' => '#e5e5e5',
            'product_page_tab_item_hover_text_color' => '#333333',
            'product_page_tab_item_active_bg_color' => '#ffffff',
            'product_page_tab_item_active_text_color' => '#333333',
            'product_page_tab_panel_bg_color' => '#ffffff',
            'footer_bg_color' => '#f5f5f5',
            'footer_pattern' => 'none',
            'footer_inner_bg_color' => '',
            'footer_text_color' => '',
            'footer_link_color' => '',
            'footer_link_hover_color' => '',
            'footer_button_bg_color' => '',
            'footer_button_text_color' => '',
            'footer_button_hover_bg_color' => '',
            'footer_button_hover_text_color' => '',
        );
	}

	public function install()
	{
		if (parent::install() AND $this->registerHook('displayHeader') AND $this->registerHook('displayAdminHomeQuickLinks'))
        {
            $this->setThemeDefault();
			return true;
        }else{
            return false;
        }
	}

	public function uninstall()
	{
        if (parent::uninstall())
        {
            foreach ($this->defaults as $default => $value)
                Configuration::deleteByName($this->configName.'_'.$default);
            return true;
        }
        return false;
    }

    public function setThemeDefault()
    {
        foreach($this->defaults as $default => $value){
            Configuration::updateValue($this->configName.'_'.$default, $value);
        }
        Configuration::updateValue('PS_QUICK_VIEW', 1);
    }

	public function getContent()
	{
        $this->context->controller->addCSS(($this->_path).'css/admin/admin.css');

        if (Tools::isSubmit('save_editor')) {
            foreach ($this->defaults as $default => $value) {
                Configuration::updateValue($this->configName.'_'.$default, (Tools::getValue($default)));
            }
            Configuration::updateValue('PS_QUICK_VIEW', (int)(Tools::getValue('PS_QUICK_VIEW')));
            $this->generateCss();
            $this->_html .= $this -> displayConfirmation($this->l('Settings updated'));

        }
        elseif (Tools::isSubmit('reset_editor')) {

            $this->setThemeDefault();
            $this->generateCss();
            $this->_html .= $this -> displayConfirmation($this->l('Settings reset'));

        }
        elseif (Tools::isSubmit('exportConfiguration'))
        {

            $var =  array();

            foreach ($this->defaults as $default => $value) {
                $var[$default] = Configuration::get($this->configName.'_'.$default);
            }
            $var['PS_QUICK_VIEW'] = (int)Tools::getValue('PS_QUICK_VIEW', Configuration::get('PS_QUICK_VIEW'));
            $file_name = time().'.csv';
            $fd = fopen($this->getLocalPath().$file_name, 'w+');
            file_put_contents($this->getLocalPath().'export/'.$file_name, print_r(serialize($var), true));
            fclose($fd);
            Tools::redirect(_PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/export/'.$file_name);
        }
        elseif (Tools::isSubmit('importConfiguration'))
        {

            if(isset($_FILES['uploadConfig']) && isset($_FILES['uploadConfig']['tmp_name']))
            {
                $str = file_get_contents($_FILES['uploadConfig']['tmp_name']);
                $arr = unserialize($str);
                foreach ($arr as $default => $value) {
                    Configuration::updateValue($this->configName.'_'.$default, $value);
                }
                $this->generateCss();
                if (isset($errors) AND $errors!='')
                    $this->_html .= $this -> displayError($errors);
                else
                    $this->_html .= $this -> displayConfirmation($this->l('Configuration imported'));
            }
            else
                $this->_html .= $this -> displayError($this->l('No config file'));

        }
        $this->_html .= '
        <div class="panel clearfix">
            <form class="pull-left" id="importForm" method="post" enctype="multipart/form-data" action="'.$this->context->link->getAdminLink('AdminModules', false).'&importConfiguration&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'">
                <div style="display:inline-block;">
                    <input type="file" id="uploadConfig" name="uploadConfig" />
                </div>
                <button type="submit" class="btn btn-default btn-lg">
                    <span class="icon icon-upload"></span>
                    '.$this->l('Import configuration').'
                </button>
            </form>
		    <a href="'.$this->context->link->getAdminLink('AdminModules', false).'&exportConfiguration&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'">
		        <button class="btn btn-default btn-lg pull-right">
		            <span class="icon icon-share"></span>
		            '.$this->l('Export configuration(Export only saved settigns, save before export)').'
                </button>
		    </a>
		</div>';
        $this->_html .= $this->renderForm();
		return $this->_html;
	}

	public function hookHeader($params)
	{
        $id_shop = (int)$this->context->shop->id;
        $this -> context -> controller -> addJS($this->_path . 'js/plugins.js');
        $this -> context -> controller -> addCss($this->_path . 'css/plugins/carousel/owl.carousel.css');
        $this -> context -> controller -> addCss($this->_path . 'css/plugins/carousel/owl.theme.css');
        $theme_settings = array(
            "product_columns" => (Configuration::get($this->configName.'_category_view_grid_column_count')),
        );
        $this->context->smarty->assign('zootheme_vars', $theme_settings);
        if (Shop::getContext() == Shop::CONTEXT_GROUP)
            $this->context->controller->addCSS(($this->_path) . 'css/stylecf_'.(int)$this->context->shop->getContextShopGroupID().'.css', 'all');
        elseif (Shop::getContext() == Shop::CONTEXT_SHOP)
            $this->context->controller->addCSS(($this->_path) . 'css/stylecf_'.(int)$this->context->shop->getContextShopID().'.css', 'all');
        $this->context->controller->addCSS(($this->_path) . 'css/custom.css', 'all');
	}

	public function renderForm()
	{
		$fields_form_main = array(
			'form' => array(
                'tab_name' => 'main_tab',
				'legend' => array(
					'title' => $this->l('Main configuration'),
					'icon' => 'icon-edit'
				),
				'input' => array(
                    array(
                        'type' => 'color',
                        'label' => $this->l('Text Color'),
                        'name' => 'main_text_color',
                        'size' => 30,
                        'title' => $this->l('Basic Colors'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Link Color'),
                        'name' => 'main_link_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Link Hover Color'),
                        'name' => 'main_link_hover_color',
                        'separator' => true,
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Background Color'),
                        'name' => 'main_button_bg_color',
                        'size' => 30,
                        'title' => $this->l('Buttons'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Color'),
                        'name' => 'main_button_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Hover Background Color'),
                        'name' => 'main_button_hover_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Hover Color'),
                        'name' => 'main_button_hover_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Active Background Color'),
                        'name' => 'main_button_active_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Active Color'),
                        'name' => 'main_button_active_color',
                        'size' => 30,
                        'separator' => true,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Icon Interface Background Color'),
                        'name' => 'main_tool_icon_bg_color',
                        'size' => 30,
                        'title' => $this->l('Interface Icons'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Icon Interface Hover Background Color'),
                        'name' => 'main_tool_icon_hover_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Icon Interface Active Background Color'),
                        'name' => 'main_tool_icon_active_bg_color',
                        'size' => 30,
                        'separator' => true,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Icon Custom Background Color'),
                        'name' => 'main_icon_bg_color',
                        'size' => 30,
                        'title' => $this->l('Custom Icons'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Icon Custom Hover Background Color'),
                        'name' => 'main_icon_hover_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Icon Custom Social Background Color'),
                        'name' => 'main_social_icon_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Icon Custom Social Hover Background Color'),
                        'name' => 'main_social_icon_hover_bg_color',
                        'size' => 30,
                        'separator' => true,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Horizontal Link Hover Color'),
                        'name' => 'main_important_link_hover_color',
                        'size' => 30,
                        'title' => $this->l('Horizontal Links'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Horizontal Link Hover Background Color'),
                        'name' => 'main_important_link_hover_bg_color',
                        'size' => 30,
                        'separator' => true,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Product Label "New" Background Color'),
                        'name' => 'main_product_label_new_bg_color',
                        'size' => 30,
                        'title' => $this->l('Product Labels'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Product Label "New" Text Color'),
                        'name' => 'main_product_label_new_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Product Label "Sale" Background Color'),
                        'name' => 'main_product_label_sale_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Product Label "Sale" Text Color'),
                        'name' => 'main_product_label_sale_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Product Price Color'),
                        'name' => 'main_product_price_color',
                        'size' => 30,
                        'title' => $this->l('Other'),
                    ),
				)
			),
		);
        $fields_form_font = array(
            'form' => array(
                'tab_name' => 'zoo_font',
                'legend' => array(
                    'title' => $this->l('Font'),
                    'icon' => 'icon-edit'
                ),
                'input' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->l('Font size'),
                        'name' => 'font_font_size',
                        'desc' => $this->l('Size of the regular text. Font size of most of the other elements will be calculated relative to this value.'),
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '12px',
                                    'name' => $this->l('12px')
                                ),
                                array(
                                    'id_option' => '13px',
                                    'name' => $this->l('13px')
                                ),
                                array(
                                    'id_option' => '14px',
                                    'name' => $this->l('14px')
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Headings font type'),
                        'name' => 'font_primary_font_family_group',
                        'desc' => $this->l('Select predefined font stack, Google Fonts or type in your custom font stack.'),
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'custom',
                                    'name' => $this->l('Custom...')
                                ),
                                array(
                                    'id_option' => 'google',
                                    'name' => $this->l('Google Fonts...')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Headings Font Family - Google Fonts'),
                        'name' => 'font_primary_font_family',
                        'separator' => true,
                        'preffix_wrapper' => 'google_font_wrapper',
                        'wrapper_hidden' => true,
                        'options' => array(
                            'query' => $this->getGoogleFonts(),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Character Set: Latin Extended'),
                        'name' => 'font_primary_char_latin_ext',
                        'separator' => true,
                        'suffix_wrapper' => true,
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
                        'type' => 'text',
                        'label' => $this->l('Custom'),
                        'desc' => 'Type in your custom font stack, e.g.:<br><em>Arial, "Helvetica Neue", Helvetica, sans-serif</em></br><strong>Important</strong>: Do not add trailing semicolon.',
                        'name' => 'font_primary_font_family_custom',
                        'preffix_wrapper' => 'custom_font_wrapper',
                        'wrapper_hidden' => true,
                        'suffix_wrapper' => true,
                        'size' => 30,
                    ),
                )
            ),
        );
        $fields_form_page = array(
            'form' => array(
                'tab_name' => 'zoo_page',
                'legend' => array(
                    'title' => $this->l('Page'),
                    'icon' => 'icon-edit'
                ),
                'input' => array(
                    array(
                        'type' => 'color',
                        'label' => $this->l('Background Color'),
                        'name' => 'page_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'background_image',
                        'label' => $this->l('Background Image'),
                        'name' => 'page_bg_image',
                        'selector' => 'page',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Background Repeat'),
                        'name' => 'page_bg_repeat',
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'no-repeat',
                                    'name' => $this->l('no repeat')
                                ),
                                array(
                                    'id_option' => 'repeat',
                                    'name' => $this->l('repeat')
                                ),
                                array(
                                    'id_option' => 'repeat-x',
                                    'name' => $this->l('repeat-x')
                                ),
                                array(
                                    'id_option' => 'repeat-y',
                                    'name' => $this->l('repeat-y')
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Background Attachment'),
                        'name' => 'page_bg_attachment',
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'fixed',
                                    'name' => $this->l('fixed')
                                ),
                                array(
                                    'id_option' => 'scroll',
                                    'name' => $this->l('scroll')
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Background Position (x-axis)'),
                        'name' => 'page_bg_positionx',
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'left',
                                    'name' => $this->l('left')
                                ),
                                array(
                                    'id_option' => 'center',
                                    'name' => $this->l('center')
                                ),
                                array(
                                    'id_option' => 'right',
                                    'name' => $this->l('right')
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Background Position (y-axis)'),
                        'name' => 'page_bg_positiony',
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'top',
                                    'name' => $this->l('top')
                                ),
                                array(
                                    'id_option' => 'center',
                                    'name' => $this->l('center')
                                ),
                                array(
                                    'id_option' => 'bottom',
                                    'name' => $this->l('bottom')
                                )
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'page_patterns',
                        'label' => $this->l('Select patterns'),
                        'name' => 'page_pattern',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'file_upload',
                        'label' => $this->l('Upload patterns'),
                        'name' => 'upload_patterns',
                    ),
                )
            ),
        );
        $fields_form_header = array(
            'form' => array(
                'tab_name' => 'zoo_header',
                'legend' => array(
                    'title' => $this->l('Header'),
                    'icon' => 'icon-edit'
                ),
                'input' => array(
                    array(
                        'type' => 'color',
                        'label' => $this->l('Top Border Color'),
                        'name' => 'header_top_border_color',
                        'size' => 30,
                        'title' => $this->l('General'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Background Color'),
                        'name' => 'header_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'page_patterns',
                        'label' => $this->l('Background Pattern'),
                        'name' => 'header_pattern',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Inner Background Color'),
                        'name' => 'header_inner_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Text Color'),
                        'name' => 'header_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Link Color'),
                        'name' => 'header_link_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Link Hover Color'),
                        'name' => 'header_link_hover_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'background_image',
                        'label' => $this->l('Upload Default Logo'),
                        'name' => 'header_logo',
                        'selector' => 'header',
                        'size' => 30,
                        'title' => $this->l('Logo')
                    ),
                    array(
                        'type' => 'background_image',
                        'label' => $this->l('Upload Retina Logo'),
                        'name' => 'header_logo_retina',
                        'selector' => 'header',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Search Text Color'),
                        'name' => 'header_search_text_color',
                        'size' => 30,
                        'title' => $this->l('Search box')
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Search Text Hover Color'),
                        'name' => 'header_search_text_hover_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Search Border Color'),
                        'name' => 'header_search_border_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Search Border Hover Color'),
                        'name' => 'header_search_border_hover_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Drop-down Background Color'),
                        'name' => 'header_dropdown_bg_color',
                        'size' => 30,
                        'title' => $this->l('Drop-down boxes'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Drop-down Text Color'),
                        'name' => 'header_dropdown_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Drop-down Link Color'),
                        'name' => 'header_dropdown_link_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Drop-down Link Hover Color'),
                        'name' => 'header_dropdown_link_hover_color',
                        'size' => 30,
                    ),
                ),
            ),
        );
        $fields_form_nav = array(
            'form' => array(
                'tab_name' => 'zoo_nav',
                'legend' => array(
                    'title' => $this->l('MainMenu'),
                    'icon' => 'icon-edit'
                ),
                'input' => array(
                    array(
                        'type' => 'color',
                        'label' => $this->l('Background Color'),
                        'name' => 'nav_inner_bg_color',
                        'size' => 30,
                        'title' => $this->l('General'),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Stretched'),
                        'name' => 'nav_stretched',
                        'is_bool' => true,
                        'separator' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show Bottom Border'),
                        'name' => 'nav_border',
                        'is_bool' => true,
                        'separator' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Font Size'),
                        'name' => 'nav_font_size',
                        'suffix' => 'px',
                        'desc' => $this->l('Top-level items'),
                        'size' => 20,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Uppercase'),
                        'name' => 'nav_font_uppercase',
                        'is_bool' => true,
                        'separator' => true,
                        'desc' => $this->l('Top-level items'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Item Background Color'),
                        'name' => 'nav_item_bg_color',
                        'size' => 30,
                        'title' => $this->l('Colors'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Item Text Color'),
                        'name' => 'nav_item_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Hover Item Background Color'),
                        'name' => 'nav_item_hover_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Hover Item Text Color'),
                        'name' => 'nav_hover_item_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Active Item Background Color'),
                        'name' => 'nav_active_item_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Active Item Text Color'),
                        'name' => 'nav_active_item_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Drop-down Background Color'),
                        'name' => 'nav_dropdown_bg_color',
                        'size' => 30,
                        'title' => $this->l('Drop-down boxes'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Drop-down Text Color'),
                        'name' => 'nav_dropdown_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Drop-down Link Color'),
                        'name' => 'nav_dropdown_link_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Drop-down Link Hover Color'),
                        'name' => 'nav_dropdown_link_hover_color',
                        'size' => 30,
                    ),
                ),
            ),
        );
        $fields_form_wrapper = array(
            'form' => array(
                'tab_name' => 'main_wrapper',
                'legend' => array(
                    'title' => $this->l('Main wrapper'),
                    'icon' => 'icon-edit'
                ),
                'input' => array(
                    array(
                        'type' => 'color',
                        'label' => $this->l('Background Color'),
                        'name' => 'main_wrapper_bg_color',
                        'size' => 30,
                        'title' => $this->l('In this tab, you can configure the main section of the page (the section located between the header and the footer).'),
                    ),
                    array(
                        'type' => 'page_patterns',
                        'label' => $this->l('Background Pattern'),
                        'name' => 'main_wrapper_patterns',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Inner Background Color'),
                        'name' => 'main_wrapper_inner_bg_color',
                        'size' => 30,
                    ),
                ),
            ),
        );
        $fields_form_category_view = array(
            'form' => array(
                'tab_name' => 'category_view',
                'legend' => array(
                    'title' => $this->l('Category view'),
                    'icon' => 'icon-edit'
                ),
                'input' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->l('Keep Image Aspect Ratio'),
                        'name' => 'category_view_aspect_ratio',
                        'desc' => $this->l('Set "Yes", to keep aspect ratio of the product images (height of the images will be calculated Image aspect ratio size).'),
                        'separator' => true,
                        'title' => $this->l('Images Products'),
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('Yes')
                                ),
                                array(
                                    'id_option' => '0',
                                    'name' => $this->l('No')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Image aspect ratio size'),
                        'name' => 'category_view_aspect_ratio_size',
                        'separator' => true,
                        'preffix_wrapper' => 'image_ratio_size_wrapper',
                        'suffix_wrapper' => true,
                        'wrapper_hidden' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '1:1',
                                    'name' => $this->l('Square Rectangle')
                                ),
                                array(
                                    'id_option' => '3:4',
                                    'name' => $this->l('Horizontal Rectangle')
                                ),
                                array(
                                    'id_option' => '4:3',
                                    'name' => $this->l('Vertical Rectangle')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Position Image'),
                        'name' => 'category_view_position_image',
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('Enable')
                                ),
                                array(
                                    'id_option' => '0',
                                    'name' => $this->l('Disable')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Position Image Column Value'),
                        'name' => 'category_view_alt_image_position_value',
                        'desc' => '<span>Specify the value which will mark alternative images of your products. E.g.: if <strong>Select Position Image By Column</strong> is set to "Sort Order", specify the number which will mark (in "Sort Order" column of the product image gallery) alternative images, for example: "2".</span>',
                        'preffix_wrapper' => 'image_postion_value_wrapper',
                        'suffix_wrapper' => true,
                        'wrapper_hidden' => true,
                        'size' => 20,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Image Width'),
                        'name' => 'category_view_image_width',
                        'suffix' => 'px',
                        'size' => 20,
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Image Height'),
                        'name' => 'category_view_image_height',
                        'suffix' => 'px',
                        'preffix_wrapper' => 'image_height_wrapper',
                        'suffix_wrapper' => true,
                        'wrapper_hidden' => true,
                        'size' => 20,
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show description of category'),
                        'name' => 'category_view_cat_desc',
                        'is_bool' => true,
                        'separator' => true,
                        'title' => $this->l('Category View'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Category description style'),
                        'name' => 'category_view_cat_desc_style',
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('Description below image')
                                ),
                                array(
                                    'id_option' => '0',
                                    'name' => $this->l('Description inside image')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show subcategories thumbs'),
                        'name' => 'category_view_sub_thumb',
                        'is_bool' => true,
                        'separator' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Default product list view'),
                        'name' => 'category_view_default_list',
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('Grid mode')
                                ),
                                array(
                                    'id_option' => '0',
                                    'name' => $this->l('List mode')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        )
                    ),
                ),
            ),
        );
        $fields_form_category_list_grid = array(
            'form' => array(
                'tab_name' => 'category_view_grid',
                'legend' => array(
                    'title' => $this->l('Category View (Grid Mode)'),
                    'icon' => 'icon-edit',
                ),
                'input' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->l('Number of Columns'),
                        'name' => 'category_view_grid_column_count',
                        'desc' => $this->l('Number of products displayed in a single row.'),
                        'separator' => true,
                        'title' => $this->l('General'),
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('1')
                                ),
                                array(
                                    'id_option' => '2',
                                    'name' => $this->l('2')
                                ),
                                array(
                                    'id_option' => '3',
                                    'name' => $this->l('3')
                                ),
                                array(
                                    'id_option' => '4',
                                    'name' => $this->l('4')
                                ),
                                array(
                                    'id_option' => '5',
                                    'name' => $this->l('5')
                                ),
                                array(
                                    'id_option' => '6',
                                    'name' => $this->l('6')
                                ),
                                array(
                                    'id_option' => '7',
                                    'name' => $this->l('7')
                                ),
                                array(
                                    'id_option' => '8',
                                    'name' => $this->l('8')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Number of Columns Below 768px'),
                        'name' => 'category_view_grid_column_count_768',
                        'desc' => $this->l('Number of columns displayed if browser viewport width is between 640 px and 768 px.'),
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('1')
                                ),
                                array(
                                    'id_option' => '2',
                                    'name' => $this->l('2')
                                ),
                                array(
                                    'id_option' => '3',
                                    'name' => $this->l('3')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Number of Columns Below 640px'),
                        'name' => 'category_view_grid_column_count_640',
                        'desc' => $this->l('Number of columns displayed if browser viewport width is between 480px and 640 px.'),
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('1')
                                ),
                                array(
                                    'id_option' => '2',
                                    'name' => $this->l('2')
                                ),
                                array(
                                    'id_option' => '3',
                                    'name' => $this->l('3')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Number of Columns Below 480px'),
                        'name' => 'category_view_grid_column_count_480',
                        'desc' => $this->l('Number of columns displayed if browser viewport width is between 320 px and 480 px. Below that width products are displayed in a single column.'),
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('1')
                                ),
                                array(
                                    'id_option' => '2',
                                    'name' => $this->l('2')
                                ),
                                array(
                                    'id_option' => '3',
                                    'name' => $this->l('3')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Equal Height of Grid Items (Products)'),
                        'name' => 'category_view_grid_equal_height',
                        'is_bool' => true,
                        'separator' => true,
                        'desc' => $this->l('If enabled, all grid items have the same height and "Add to cart" button is displayed at the bottom edge of the item.'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Product Hover Effect'),
                        'name' => 'category_view_grid_hover_effect',
                        'is_bool' => true,
                        'separator' => true,
                        'desc' => '<span>Effect is visible on mouse hover over the product. <strong style="color:red;">Important:</strong> enable in order to use "Display On Hover" in <strong>Display Selected Elements</strong>.</span>',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Ratings'),
                        'name' => 'category_view_grid_display_rating',
                        'title' => $this->l('Display Selected Elements'),
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '0',
                                    'name' => $this->l('Don\'t Display')
                                ),
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('Display On Hover')
                                ),
                                array(
                                    'id_option' => '2',
                                    'name' => $this->l('Display')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('Add To Cart'),
                        'name' => 'category_view_grid_display_addtocart',
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '0',
                                    'name' => $this->l('Don\'t Display')
                                ),
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('Display On Hover')
                                ),
                                array(
                                    'id_option' => '2',
                                    'name' => $this->l('Display')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'select',
                        'label' => $this->l('"Add to" Links'),
                        'name' => 'category_view_grid_display_addtolinks',
                        'desc' => $this->l('"Add to wishlist" and "Add to compare" links.'),
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => '0',
                                    'name' => $this->l('Don\'t Display')
                                ),
                                array(
                                    'id_option' => '1',
                                    'name' => $this->l('Display On Hover')
                                ),
                                array(
                                    'id_option' => '2',
                                    'name' => $this->l('Display')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show "Add to" Links as Icons Above the Image'),
                        'name' => 'category_view_grid_addtolinks_simple',
                        'desc' => $this->l('If set to "No", "Add to wishlist" and "Add to compare" links will be displayed as text links.'),
                        'is_bool' => true,
                        'separator' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                ),
            ),
        );
        $fields_form_category_list_list = array(
            'form' => array(
                'tab_name' => 'category_view_list',
                'legend' => array(
                    'title' => $this->l('Category View (List Mode)'),
                    'icon' => 'icon-edit',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Product Hover Effect'),
                        'name' => 'category_view_list_hover_effect',
                        'is_bool' => true,
                        'separator' => true,
                        'desc' => 'Effect is visible on mouse hover over the product.',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show "Add to" Links as Simple Icons'),
                        'name' => 'category_view_list_addtolinks_simple',
                        'desc' => $this->l('If set to "No", "Add to wishlist" and "Add to compare" links will be displayed as text links with icons.'),
                        'is_bool' => true,
                        'separator' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                ),
            ),
        );
        $fields_form_product_page = array(
            'form' => array(
                'tab_name' => 'product_page',
                'legend' => array(
                    'title' => $this->l('Product Page'),
                    'icon' => 'icon-edit'
                ),
                'input' => array(
                    array(
                        'type' => 'select',
                        'label' => $this->l('Select Layout'),
                        'name' => 'product_page_layout',
                        'title' => $this->l('Page Layout'),
                        'separator' => true,
                        'options' => array(
                            'query' => array(
                                array(
                                    'id_option' => 'default',
                                    'name' => $this->l('Default')
                                ),
                                array(
                                    'id_option' => 'horizontal',
                                    'name' => $this->l('Horizontal')
                                ),
                                array(
                                    'id_option' => 'vertical',
                                    'name' => $this->l('Vertical')
                                ),
                                array(
                                    'id_option' => 'custom1',
                                    'name' => $this->l('Custom 1')
                                ),
                                array(
                                    'id_option' => 'custom2',
                                    'name' => $this->l('Custom 2')
                                ),
                            ),
                            'id' => 'id_option',
                            'name' => 'name'
                        ),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Add-to Icon Background Color'),
                        'name' => 'product_page_addto_icon_bg_color',
                        'size' => 30,
                        'title' => $this->l('Add-to... Icons'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Add-to Icon Hover Background Color'),
                        'name' => 'product_page_addto_icon_hover_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Background Color'),
                        'name' => 'product_page_tab_inner_bg_color',
                        'size' => 30,
                        'title' => $this->l('Tabs'),
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Item Background Color'),
                        'name' => 'product_page_tab_item_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Item Text Color'),
                        'name' => 'product_page_tab_item_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Hover Item Background Color'),
                        'name' => 'product_page_tab_item_hover_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Hover Item Text Color'),
                        'name' => 'product_page_tab_item_hover_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Active Item Background Color'),
                        'name' => 'product_page_tab_item_active_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Active Item Text Color'),
                        'name' => 'product_page_tab_item_active_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Panel Background Color'),
                        'name' => 'product_page_tab_panel_bg_color',
                        'size' => 30,
                    ),
                ),
            ),
        );
        $fields_form_footer = array(
            'form' => array(
                'tab_name' => 'zoo_footer',
                'legend' => array(
                    'title' => $this->l('Footer'),
                    'icon' => 'icon-edit'
                ),
                'input' => array(
                    array(
                        'type' => 'color',
                        'label' => $this->l('Background Color'),
                        'name' => 'footer_bg_color',
                        'size' => 30,
                        'title' => $this->l('In this tab, you can configure the entire footer of the page. Settings from this tab are inherited by all the other sub-sections of the footer. Some of the settings can be overridden in sub-sections.'),
                    ),
                    array(
                        'type' => 'page_patterns',
                        'label' => $this->l('Pattern'),
                        'name' => 'footer_pattern',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Inner Background Color'),
                        'name' => 'footer_inner_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Text Color'),
                        'name' => 'footer_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Link Color'),
                        'name' => 'footer_link_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Link Hover Color'),
                        'name' => 'footer_link_hover_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Background Color'),
                        'name' => 'footer_button_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Text Color'),
                        'name' => 'footer_button_text_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Hover Background Color'),
                        'name' => 'footer_button_hover_bg_color',
                        'size' => 30,
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Button Hover Text Color'),
                        'name' => 'footer_button_hover_text_color',
                        'size' => 30,
                    ),
                ),
            ),
        );
        $fields_form_save = array(
            'form' => array(
                'tab_name' => 'save_tab',
                'legend' => array(
                    'title' => $this->l('Save configuration'),
                    'icon' => 'icon-save'
                ),
                'submit' => array(
                    'name' => 'save_editor',
                    'class' => 'btn btn-default pull-right',
                    'title' => $this->l('Save')
                ),
                'buttons' => array(
                    'button' => array(
                        'name' => 'reset_editor',
                        'type' => 'submit',
                        'icon' => 'process-icon-refresh',
                        'class' => 'btn btn-default pull-left',
                        'title' => $this->l('Reset to default')
                    ),
                ),
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = true;
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
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'pattern_page' => $this->getPatternPage(),
            'id_language' => $this->context->language->id
        );

		return $helper->generateForm(
            array(
                $fields_form_main,
                $fields_form_font,
                $fields_form_page,
                $fields_form_header,
                $fields_form_nav,
                $fields_form_wrapper,
                $fields_form_category_view,
                $fields_form_category_list_grid,
                $fields_form_category_list_list,
                $fields_form_product_page,
                $fields_form_footer,
                $fields_form_save
            )
        );
	}

    public function getPatternPage()
    {
        $directry = _PS_ROOT_DIR_.'/modules/zoothemeconfig/images/patterns/';
        $images = array();
        if (is_dir($directry)) {
            if ($dh = opendir($directry)) {
                while (($file = readdir($dh)) !== false) {
                    if(is_file($directry.DS.$file)){
                        $filetype = substr($file, -3, 3);
                        switch ($filetype)
                        {
                            case 'jpg':
                            case 'png':
                            case 'gif':
                                $images[] = $file;
                                break;
                        }
                    }
                }
            }
        }
        return $images;
    }

    public function getConfigFieldsValues()
    {
        $var =  array();
        foreach ($this->defaults as $default => $value) {
            $var[$default] = Configuration::get($this->configName.'_'.$default);
        }
        $var['PS_QUICK_VIEW'] = (int)Tools::getValue('PS_QUICK_VIEW', Configuration::get('PS_QUICK_VIEW'));
        return $var;

    }

    public function getGoogleFonts()
    {
        $gfont = 'Abel,Abril Fatface,Aclonica,Acme,Actor,Adamina,Aguafina Script,Aladin,Aldrich,Alegreya,Alegreya SC,Alex Brush,Alfa Slab One,Alice,Alike,Alike Angular,Allan,Allerta,Allerta Stencil,Allura,Almendra,Almendra SC,Amaranth,Amatic SC,Amethysta,Andada,Andika,Annie Use Your Telescope,Anonymous Pro,Antic,Anton,Arapey,Arbutus,Architects Daughter,Arimo,Arizonia,Armata,Artifika,Arvo,Asap,Asset,Astloch,Asul,Atomic Age,Aubrey,Bad Script,Balthazar,Bangers,Basic,Baumans,Belgrano,Bentham,Bevan,Bigshot One,Bilbo,Bilbo Swash Caps,Bitter,Black Ops One,Bonbon,Boogaloo,Bowlby One,Bowlby One SC,Brawler,Bree Serif,Bubblegum Sans,Buda,Buenard,Butcherman,Butterfly Kids,Cabin,Cabin Condensed,Cabin Sketch,Caesar Dressing,Cagliostro,Calligraffitti,Cambo,Candal,Cantarell,Cardo,Carme,Carter One,Caudex,Cedarville Cursive,Ceviche One,Changa One,Chango,Chelsea Market,Cherry Cream Soda,Chewy,Chicle,Chivo,Coda,Coda Caption,Comfortaa,Coming Soon,Concert One,Condiment,Contrail One,Convergence,Cookie,Copse,Corben,Cousine,Coustard,Covered By Your Grace,Crafty Girls,Creepster,Crete Round,Crimson Text,Crushed,Cuprum,Damion,Dancing Script,Dawning of a New Day,Days One,Delius,Delius Swash Caps,Delius Unicase,Devonshire,Didact Gothic,Diplomata,Diplomata SC,Dorsa,Dr Sugiyama,Droid Sans,Droid Sans Mono,Droid Serif,Duru Sans,Dynalight,EB Garamond,Eater,Electrolize,Emblema One,Engagement,Enriqueta,Erica One,Esteban,Euphoria Script,Ewert,Exo,Expletus Sans,Fanwood Text,Fascinate,Fascinate Inline,Federant,Federo,Felipa,Fjord One,Flamenco,Flavors,Fondamento,Fontdiner Swanky,Forum,Francois One,Fredericka the Great,Fresca,Frijole,Fugaz One,Galdeano,Gentium Basic,Gentium Book Basic,Geo,Geostar,Geostar Fill,Germania One,Give You Glory,Glegoo,Gloria Hallelujah,Goblin One,Gochi Hand,Goudy Bookletter 1911,Gravitas One,Gruppo,Gudea,Habibi,Hammersmith One,Handlee,Herr Von Muellerhoff,Holtwood One SC,Homemade Apple,Homenaje,IM Fell DW Pica,IM Fell DW Pica SC,IM Fell Double Pica,IM Fell Double Pica SC,IM Fell English,IM Fell English SC,IM Fell French Canon,IM Fell French Canon SC,IM Fell Great Primer,IM Fell Great Primer SC,Iceberg,Iceland,Inconsolata,Inder,Indie Flower,Inika,Irish Grover,Istok Web,Italianno,Jim Nightshade,Jockey One,Josefin Sans,Josefin Slab,Judson,Julee,Junge,Jura,Just Another Hand,Just Me Again Down Here,Kameron,Kaushan Script,Kelly Slab,Kenia,Knewave,Kotta One,Kranky,Kreon,Kristi,La Belle Aurore,Lancelot,Lato,League Script,Leckerli One,Lekton,Lemon,Lilita One,Limelight,Linden Hill,Lobster,Lobster Two,Lora,Love Ya Like A Sister,Loved by the King,Luckiest Guy,Lusitana,Lustria,Macondo,Macondo Swash Caps,Magra,Maiden Orange,Mako,Marck Script,Marko One,Marmelad,Marvel,Mate,Mate SC,Maven Pro,Meddon,MedievalSharp,Medula One,Megrim,Merienda One,Merriweather,Metamorphous,Metrophobic,Michroma,Miltonian,Miltonian Tattoo,Miniver,Miss Fajardose,Modern Antiqua,Molengo,Monofett,Monoton,Monsieur La Doulaise,Montaga,Montez,Montserrat,Mountains of Christmas,Mr Bedfort,Mr Dafoe,Mr De Haviland,Mrs Saint Delafield,Mrs Sheppards,Muli,Neucha,Neuton,News Cycle,Niconne,Nixie One,Nobile,Norican,Nosifer,Nothing You Could Do,Noticia Text,Nova Cut,Nova Flat,Nova Mono,Nova Oval,Nova Round,Nova Script,Nova Slim,Nova Square,Numans,Nunito,Old Standard TT,Oldenburg,Open Sans,Open Sans Condensed,Orbitron,Original Surfer,Oswald,Over the Rainbow,Overlock,Overlock SC,Ovo,PT Sans,PT Sans Caption,PT Sans Narrow,PT Serif,PT Serif Caption,Pacifico,Parisienne,Passero One,Passion One,Patrick Hand,Patua One,Paytone One,Permanent Marker,Petrona,Philosopher,Piedra,Pinyon Script,Plaster,Play,Playball,Playfair Display,Podkova,Poller One,Poly,Pompiere,Port Lligat Sans,Port Lligat Slab,Prata,Princess Sofia,Prociono,Puritan,Quantico,Quattrocento,Quattrocento Sans,Questrial,Quicksand,Qwigley,Radley,Raleway,Rammetto One,Rancho,Rationale,Redressed,Reenie Beanie,Ribeye,Ribeye Marrow,Righteous,Rochester,Rock Salt,Rokkitt,Ropa Sans,Rosario,Rouge Script,Ruda,Ruge Boogie,Ruluko,Ruslan Display,Ruthie,Sail,Salsa,Sancreek,Sansita One,Sarina,Satisfy,Schoolbell,Shadows Into Light,Shanti,Share,Shojumaru,Short Stack,Sigmar One,Signika,Signika Negative,Sirin Stencil,Six Caps,Slackey,Smokum,Smythe,Sniglet,Snippet,Sofia,Sonsie One,Sorts Mill Goudy,Special Elite,Spicy Rice,Spinnaker,Spirax,Squada One,Stardos Stencil,Stint Ultra Condensed,Stint Ultra Expanded,Stoke,Sue Ellen Francisco,Sunshiney,Supermercado One,Swanky and Moo Moo,Syncopate,Tangerine,Telex,Tenor Sans,Terminal Dosis,The Girl Next Door,Tienne,Tinos,Titan One,Trade Winds,Trochut,Trykker,Tulpen One,Ubuntu,Ubuntu Condensed,Ubuntu Mono,Ultra,Uncial Antiqua,UnifrakturCook,UnifrakturMaguntia,Unkempt,Unlock,Unna,VT323,Varela,Varela Round,Vast Shadow,Vibur,Vidaloka,Viga,Volkhov,Vollkorn,Voltaire,Waiting for the Sunrise,Wallpoet,Walter Turncoat,Wellfleet,Wire One,Yanone Kaffeesatz,Yellowtail,Yeseva One,Yesteryear,Zeyada';
        $fontarray = explode(',',$gfont);
        $options = array();
        $options[] = array(
            'id_option' => '',
            'name' => $this->l('--Select--'),
        );
        foreach($fontarray as $font){
            $options[] = array(
                'id_option' => $font,
                'name' => $font,
            );
        }
        return $options;
    }

    public function getCssGridItem($columnCount)
    {
        $_itemWidth = array(
            "1" => 99,
            "2" => 49,
            "3" => 32,
            "4" => 23.499,
            "5" => 18.4,
            "6" => 15,
            "7" => 12.5555,
            "8" => 10.752,
        );

        $out = "\n";
        $out .= '.itemgrid.itemgrid-adaptive .item { width:' . $_itemWidth[$columnCount] . '%; clear:none !important; }' . "\n";

        if ($columnCount > 1)
        {
            $out .= '.itemgrid.itemgrid-adaptive .item:nth-child(' . $columnCount . 'n+1) { clear:left !important; }' . "\n";
        }

        return $out;
    }

    public function generateCss()
    {
        $css = '
/* 640px <= width < 768px */
@media only screen and (min-width: 640px) and (max-width: 767px) {

/* Item grid
-------------------------------------------------------------- */';

$css .= $this->getCssGridItem(Configuration::get($this->configName.'_category_view_grid_column_count_768'));

$css .='}
/* end: 640px <= width < 768px */

/* 480 <= width < 640px */
@media only screen and (min-width: 480px) and (max-width: 639px) {

/* Item grid
-------------------------------------------------------------- */';
$css .= $this->getCssGridItem(Configuration::get($this->configName.'_category_view_grid_column_count_640'));
$css .='}
/* end: 480 <= width < 640px */
/* 320px <= width < 480px */
@media only screen and (min-width: 320px) and (max-width: 479px) {
/* Item grid
-------------------------------------------------------------- */';
$css .= $this->getCssGridItem(Configuration::get($this->configName.'_category_view_grid_column_count_480'));
$css .='}
/* end: 320px <= width < 480px */

@media only screen and (max-width: 319px) {
    /* Always show 1 column */
    /* Important: added ".itemgrid" class to override other styles */
    .itemgrid.itemgrid-adaptive .item { width:98%; clear:none !important; }
}';
        if (Shop::getContext() == Shop::CONTEXT_GROUP)
            $myFile = $this->local_path . "css/stylecf_".(int)$this->context->shop->getContextShopGroupID().".css";
        elseif (Shop::getContext() == Shop::CONTEXT_SHOP)
            $myFile = $this->local_path . "css/stylecf_".(int)$this->context->shop->getContextShopID().".css";
        $fh = fopen($myFile, 'w') or die("can't open file");
        fwrite($fh, $css);
        fclose($fh);
    }

}
