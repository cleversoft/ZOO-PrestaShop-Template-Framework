	<!-- MODULE Home Tabs Products -->
	<section id="zoohometabs_module" class="products_tabs_slider block clearfix">
		<ul class="nav nav-tabs">
			{if isset($fproducts) AND $fproducts}
			<li>
				<a href="#featured_products_tab" title="{l s='Featured products' mod='zoohometabs'}" data-toggle="tab">{l s='Featured products' mod='zoohometabs'}</a>
			</li>
			{/if}
			{if isset($nproducts) AND $nproducts}
			<li>
				<a href="#new_products_tab" title="{l s='New products' mod='zoohometabs'}" data-toggle="tab">{l s='New products' mod='zoohometabs'}</a>
			</li>
			{/if}
			{if isset($special) AND $special}
			<li>
				<a href="#special_products_tab"  title="{l s='Price drops' mod='zoohometabs'}" data-toggle="tab">{l s='Price drops' mod='zoohometabs'}</a>
			</li>
			{/if}
			{if isset($categories) AND $categories}
			{foreach from=$categories item=category}
			{if isset($category.products) AND $category.products}
			<li>
				<a href="#category_products_tab_{$category.id}" data-toggle="tab">{$category.name}</a>
			</li>
			{/if}
			{/foreach}
			{/if}
		</ul>
		<div class="tab-content">
			{if isset($fproducts) AND $fproducts}
			<div id="featured_products_tab"  class="tab-pane">
				{include file="$tpl_dir./product-slider.tpl" productimg=$fproducts_productimg products=$fproducts id='featured_products_tab_slider'}
			</div>
			{/if}

			{if isset($nproducts) AND $nproducts}
			<div id="new_products_tab"  class="tab-pane">
				{include file="$tpl_dir./product-slider.tpl" productimg=$nproducts_productimg products=$nproducts id='new_products_tab_slider'}
			</div>
			{/if}

			{if isset($special) AND $special}

			<div id="special_products_tab"  class="tab-pane">
				{include file="$tpl_dir./product-slider.tpl" productimg=$sproducts_productimg products=$special id='special_products_tab_slider'}
			</div>
			{/if}

			{if isset($categories) AND $categories}
			{foreach from=$categories item=category}

			{if isset($category.products) AND $category.products}

			<div id="category_products_tab_{$category.id}"  class="tab-pane">
				<script type="text/javascript"> createCategoryTabSlider('#category_tab_slider_slider_{$category.id}'); </script>
				{assign var='tmpCatSlider' value="category_tab_slider_slider_{$category.id}"}
				{include file="$tpl_dir./product-slider.tpl" products=$category.products productimg=$category.productimg id=$tmpCatSlider}
			</div>
			{/if}

			{/foreach}
			{/if}
		</div>
	</section>
	<!-- /MODULE Homepage tabs  Products -->
