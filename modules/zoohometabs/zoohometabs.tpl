<!-- MODULE Home Tabs Products -->
<section id="zoohometabs_module" class="product_tab_list block  clearfix">
    <ul class="nav nav-tabs">
        {if isset($fproducts) AND $fproducts}
        <li>
            <a href="#featured_products_tab" title="{l s='Featured products' mod='zoohometabs'}" data-toggle="tab">
                {l s='Featured products' mod='zoohometabs'}
            </a>
        </li>
        {/if}
        {if isset($nproducts) AND $nproducts}
        <li>
            <a href="#new_products_tab" title="{l s='New products' mod='zoohometabs'}" data-toggle="tab">
                {l s='New products' mod='zoohometabs'}
            </a>
        </li>
        {/if}
        {if isset($special) AND $special}
        <li>
            <a href="#special_products_tab"  title="{l s='Price drops' mod='zoohometabs'}" data-toggle="tab">
                {l s='Price drops' mod='zoohometabs'}
            </a>
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
            <div id="featured_products_tab"  class="tab-pane fade">
                {include file="$tpl_dir./product-list.tpl" productimg=$fproducts_productimg products=$fproducts}
            </div>
        {/if}
        {if isset($nproducts) AND $nproducts}
            <div id="new_products_tab"  class="tab-pane fade">
                {include file="$tpl_dir./product-list.tpl" productimg=$nproducts_productimg products=$nproducts}
            </div>
        {/if}
        {if isset($special) AND $special}
            <div id="special_products_tab"  class="tab-pane fade">
                {include file="$tpl_dir./product-list.tpl" productimg=$sproducts_productimg products=$special}
            </div>
        {/if}
        {if isset($categories) AND $categories}
            {foreach from=$categories item=category}
                {if isset($category.products) AND $category.products}
                <div id="category_products_tab_{$category.id}"  class="tab-pane fade">
                    {include file="$tpl_dir./product-list.tpl" products=$category.products productimg=$category.productimg}
                </div>
                {/if}
            {/foreach}
        {/if}
    </div>
</section>
<!-- /MODULE Home tabs products -->
