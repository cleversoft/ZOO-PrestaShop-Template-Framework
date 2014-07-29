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

{extends file="helpers/form/form.tpl"}

{block name="script"}
$(document).ready(function(){
    var enableSlide = $('#sliderenabled');
    if(enableSlide.val() == 0){
        $('#featured_slide_item_column').removeClass('hidden');
        $('#featured_slide_responsive').addClass('hidden');
    }
    if(enableSlide.val() == 1){
        $('#featured_slide_item_column').addClass('hidden');
        $('#featured_slide_responsive').removeClass('hidden');
    }
    $("#sliderenabled").change(function() {
        var val = $(this).val();
        if(val == 1){
            $('#featured_slide_item_column').addClass('hidden');
            $('#featured_slide_responsive').removeClass('hidden');
        }
        if(val == 0){
            $('#featured_slide_item_column').removeClass('hidden');
            $('#featured_slide_responsive').addClass('hidden');
        }
    });
    var slideresponsive = $('#slideresponsive');
    $('#res_item').parents('.form-group').addClass('hidden');
    $('#res_breakpoints').parents('.form-group').addClass('hidden');
    if(slideresponsive.val() == 1){
        $('#res_item').parents('.form-group').removeClass('hidden');
        $('#res_breakpoints').parents('.form-group').addClass('hidden');
    }
    if(slideresponsive.val() == 0){
        $('#res_item').parents('.form-group').addClass('hidden');
        $('#res_breakpoints').parents('.form-group').removeClass('hidden');
    }
    $("#slideresponsive").change(function() {
        var val = $(this).val();
        if(val == 1){
            $('#res_item').parents('.form-group').removeClass('hidden');
            $('#res_breakpoints').parents('.form-group').addClass('hidden');
        }
        if(val == 0){
            $('#res_item').parents('.form-group').addClass('hidden');
            $('#res_breakpoints').parents('.form-group').removeClass('hidden');
        }
    });
});
{/block}

{block name="input_row"}
    {if isset($input.preffix_wrapper)}<div id="{$input.preffix_wrapper}" {if isset($input.wrapper_hidden) && $input.wrapper_hidden} class="hidden"{/if}>{/if}
    {$smarty.block.parent}
    {if isset($input.suffix_wrapper) && $input.suffix_wrapper}</div>{/if}
{/block}
