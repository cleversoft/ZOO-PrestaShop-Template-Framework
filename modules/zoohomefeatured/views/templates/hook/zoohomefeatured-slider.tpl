{*
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
*}

<!-- MODULE Home Featured Products -->
<div id="zoo_featured_products_block_center" class="products_block clearfix">
	<h3 class="title_block">{l s='Featured products' mod='zoohomefeatured'} slider</h3>
	{if isset($products) AND $products}
		<div class="product_block_content">
			<ul>
			{foreach from=$products item=product name=homeFeaturedProducts} 
				<li class="product_item">
					<a href="{$product.link|escape:'html'}" title="{$product.name|escape:html:'UTF-8'}" class="product_image">
                        <img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')|escape:'html'}" height="{$homeSize.height}" width="{$homeSize.width}" alt="{$product.name|escape:html:'UTF-8'}" />
                        {if isset($product.new) && $product.new == 1}<span class="new">{l s='New' mod='zoohomefeatured'}</span>{/if}
                    </a>
					<h3 class="s_title_block">
                        <a href="{$product.link|escape:'html'}" title="{$product.name|truncate:50:'...'|escape:'html':'UTF-8'}">
                            {$product.name|truncate:35:'...'|escape:'html':'UTF-8'}
                        </a>
                    </h3>
					<div class="product_desc">
                        <a href="{$product.link|escape:'html'}" title="{l s='More' mod='zoohomefeatured'}">
                            {$product.description_short|strip_tags|truncate:65:'...'}
                        </a>
                    </div>
					<div>
						<a class="lnk_more" href="{$product.link|escape:'html'}" title="{l s='View' mod='zoohomefeatured'}">
                            {l s='View' mod='zoohomefeatured'}
                        </a>
						{if $product.show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
                            <p class="price_container">
                                <span class="price">
                                {if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
                                </span>
                            </p>
                        {else}
                            <div style="height:21px;"></div>
                        {/if}
						
						{if ($product.id_product_attribute == 0 OR (isset($add_prod_display) AND ($add_prod_display == 1))) AND $product.available_for_order AND !isset($restricted_country_mode) AND $product.minimal_quantity == 1 AND $product.customizable != 2 AND !$PS_CATALOG_MODE}
							{if ($product.quantity > 0 OR $product.allow_oosp)}
							<a class="exclusive ajax_add_to_cart_button" rel="ajax_id_product_{$product.id_product}" href="{$link->getPageLink('cart')|escape:'html'}?qty=1&amp;id_product={$product.id_product}&amp;token={$static_token}&amp;add" title="{l s='Add to cart' mod='zoohomefeatured'}">{l s='Add to cart' mod='zoohomefeatured'}</a>
							{else}
							<span class="exclusive">{l s='Add to cart' mod='zoohomefeatured'}</span>
							{/if}
						{else}
							<div style="height:23px;"></div>
						{/if}
					</div>
				</li>
			{/foreach}
			</ul>
		</div>
	{else}
		<p>{l s='No featured products' mod='zoohomefeatured'}</p>
	{/if}
</div>
<!-- /MODULE Home Featured Products -->
