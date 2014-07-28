$(document).ready(function(){
    var slideOptions = {
        slideSpeed : 400,
        paginationSpeed : 500,
        rewindSpeed : 400,
        autoPlay : false,
        stopOnHover : false,
        navigation : true,
        pagination : false,
    };
    if(data_slide_hometabs.slideresponsive == 1) {
        slideOptions.items = data_slide_hometabs.res_item;
    }
    if(data_slide_hometabs.slideresponsive == 0) {
        slideOptions.itemsCustom = data_slide_hometabs.res_breakpoints;
    }
    if(data_slide_hometabs.slide_lazyload == 1) {
        slideOptions.lazyLoad = true;
    }
    $('#featured_products_tab_slider').owlCarousel(slideOptions);
    $('#new_products_tab_slider').owlCarousel(slideOptions);
    $('#special_products_tab_slider').owlCarousel(slideOptions);
});
function createCategoryTabSlider(selector)
{
    $(window).load(function() {
        var slideOptions = {
            slideSpeed : 400,
            paginationSpeed : 500,
            rewindSpeed : 400,
            autoPlay : false,
            stopOnHover : false,
            navigation : true,
            pagination : false,
        };
        if(data_slide_hometabs.slideresponsive == 1) {
            slideOptions.items = data_slide_hometabs.res_item;
        }
        if(data_slide_hometabs.slideresponsive == 0) {
            slideOptions.itemsCustom = data_slide_hometabs.res_breakpoints;
        }
        if(data_slide_hometabs.slide_lazyload == 1) {
            slideOptions.lazyLoad = true;
        }
        $(selector).owlCarousel(slideOptions);
    });
}