{extends file="helpers/form/form.tpl"}
{block name="defaultForm"}
    <div class="row">
        <div class="col-lg-2">
            <div id="options_tab" class="">
                <ul class="list-group">
                    {foreach $fields as $tab}
                        {if $tab.form.tab_name != 'save_tab'}<li {if $tab.form.tab_name == 'main_tab'}class="active"{/if}><a class="list-group-item" href="#{$tab.form.tab_name}">{$tab.form.legend.title}</a></li>{/if}
                    {/foreach}
                <ul>
            </div>
        </div>
        <div class="col-lg-10 tab-content">
            {$smarty.block.parent}
        </div>
    </div>
{/block}
{block name="fieldset"}
    {if $fieldset.form.tab_name != 'save_tab'}<div class="tab-pane {if $fieldset.form.tab_name == 'main_tab'}active{/if}" id="{$fieldset.form.tab_name}">{/if}
    {$smarty.block.parent}
    {if $fieldset.form.tab_name != 'save_tab'}</div>{/if}
{/block}
{block name="input_row"}
    {if isset($input.title) && $input.title}
        <div class="form-group">
            <label for="main_text_color" class="group-control-label col-lg-12 ">
                {$input.title}
            </label>
        </div>
    {/if}
    {if isset($input.preffix_wrapper)}<div id="{$input.preffix_wrapper}" {if isset($input.wrapper_hidden) && $input.wrapper_hidden} class="hidden"{/if}>{/if}
    {$smarty.block.parent}
    {if isset($input.suffix_wrapper) && $input.suffix_wrapper}</div>{/if}
{/block}
{block name="input"}
    {if $input.type == 'background_image'}
        <p> <input id="{$input.name}" type="text" name="{$input.name}" value="{$fields_value[$input.name]|escape:'html':'UTF-8'}"> </p>
        <a href="filemanager/dialog.php?type=1&field_id={$input.name}" class="btn btn-default iframe-upload"  data-input-name="{$input.name}" type="button">{l s='Background image selector' mod='zoothemeconfig'} <i class="icon-angle-right"></i></a>
    {elseif $input.type == 'page_patterns'}
        <div class="list_pattern_{$input.name}">
            <input id="{$input.name}" type="hidden" name="{$input.name}" value="{$fields_value[$input.name]|escape:'html':'UTF-8'}">
            <span class="item">
                <span class="ptnone">None</span>
                <input type="radio" name="{$input.name}s" value="none" class="valpt"/>
            </span>
            {foreach $pattern_page as $pattern}
                <span class="item">
                    <img src="{$uri}images/patterns/{$pattern}" />
                    <input type="radio" name="{$input.name}s" value="{$pattern}" class="valpt"/>
                </span>
            {/foreach}
        </div>
        <script type="text/javascript">
            $(".list_pattern_{$input.name} input[type=radio]").click(function(){
                $("#{$input.name}").val($(this).val());
            });
            {$input.name}_active();
            function {$input.name}_active(){
                var ptnbody = $("#{$input.name}").val();
                $(".list_pattern_{$input.name} input[type=radio]").each(function(i,rad){
                    if(rad.value==ptnbody){
                        $(rad).attr("checked", true);
                    }
                });
            }
        </script>
        {elseif $input.type == "file_upload"}
        <div class="dummyfile input-group">
            <input id="{$input.name}" type="file" name="{$input.name}" class="hide" />
            <span class="input-group-addon"><i class="icon-file"></i></span>
            <input id="{$input.name}-name" type="text" class="disabled" name="filename" readonly />
            <span class="input-group-btn">
                <button id="{$input.name}-selectbutton" type="button" name="submitAddAttachments" class="btn btn-default">
                    <i class="icon-folder-open"></i> {l s='Choose a file'}
                </button>
            </span>
        </div>
        <script type="text/javascript">
            /***upload action**/
            $('#{$input.name}-selectbutton').click(function(e){
                $('#{$input.name}').trigger('click');
            });
            $('#{$input.name}').change(function(e){
                var val = $(this).val();
                var file = val.split(/[\\/]/);
                $('#{$input.name}-name').val(file[file.length-1]);
            });
        </script>
    {else}
        {$smarty.block.parent}
    {/if}
{/block}
{block name="script"}
    $(document).ready(function() {
        $(".fancybox").fancybox();
        $('.iframe-upload').fancybox({
            'width'		: 900,
            'height'	: 600,
            'type'		: 'iframe',
            'autoScale' : false,
            'autoDimensions': false,
            'fitToView' : false,
            'autoSize' : false,
            onUpdate : function(){
                $('.fancybox-iframe').contents().find('a.link').data('field_id', $(this.element).data("input-name"));
                $('.fancybox-iframe').contents().find('a.link').attr('data-field_id', $(this.element).data("input-name"));
            },
            afterShow: function(){
                $('.fancybox-iframe').contents().find('a.link').data('field_id', $(this.element).data("input-name"));
                $('.fancybox-iframe').contents().find('a.link').attr('data-field_id', $(this.element).data("input-name"));
            }
        });
        $('#options_tab a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        });
        var fontType = $('#font_primary_font_family_group');
        if(fontType.val() == 'custom'){
            $('#custom_font_wrapper').removeClass('hidden');
        }
        if(fontType.val() == 'google'){
            $('#google_font_wrapper').removeClass('hidden');
        }
        if(fontType.val() != 'google' && fontType.val() != 'custom'){
            $('#google_font_wrapper').addClass('hidden');
            $('#custom_font_wrapper').addClass('hidden');
        }
        $("#font_primary_font_family_group").change(function() {
            var val = $(this).val();
            if(val == 'google'){
                $('#google_font_wrapper').removeClass('hidden');
                $('#custom_font_wrapper').addClass('hidden');
            }
            if(val == 'custom'){
                $('#google_font_wrapper').addClass('hidden');
                $('#custom_font_wrapper').removeClass('hidden');
            }
            if(val != 'google' && val != 'custom'){
                $('#google_font_wrapper').addClass('hidden');
                $('#custom_font_wrapper').addClass('hidden');
            }
        });
        var ratioimg = $('#category_view_aspect_ratio');
        if(ratioimg.val() == 1){
            $('#image_ratio_size_wrapper').removeClass('hidden');
            $('#image_height_wrapper').addClass('hidden');
        }
        if(ratioimg.val() == 0){
            $('#image_ratio_size_wrapper').addClass('hidden');
            $('#image_height_wrapper').removeClass('hidden');
        }
        $('#category_view_aspect_ratio').change(function(){
            var val = $(this).val();
            if(val == 1){
                $('#image_ratio_size_wrapper').removeClass('hidden');
                $('#image_height_wrapper').addClass('hidden');
            }else{
                $('#image_ratio_size_wrapper').addClass('hidden');
                $('#image_height_wrapper').removeClass('hidden');
            }
        });
        var poval = $('#category_view_position_image');
        if(poval.val() == 1){
            $('#image_postion_value_wrapper').removeClass('hidden');
        }
        $('#category_view_position_image').change(function(){
            var val = $(this).val();
            if(val == 1){
                $('#image_postion_value_wrapper').removeClass('hidden');
            }else{
                $('#image_postion_value_wrapper').addClass('hidden');
            }
        });
    });
{/block}