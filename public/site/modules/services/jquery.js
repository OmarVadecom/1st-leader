// Pricing page Document
var sections_selected = 0;

var sselection = [];
var vselection = [];

$(function () {
    // ************************* Pricing Service Checkbox ************************ //
    $('.pricing-services .pricing-service').each(function (){
        $(this).click(function(){
            $(this).find('input').trigger('click');
        });
    });

    $(".service-selected").hide();

    /*
     * If initially checked
     */
    $('.pricing-services .pricing-service input:checked').each(function() { serviceWrapperManager($(this)); });

    $('.pricing-services .pricing-service input').click(function() {
        serviceWrapperManager($(this));
    });

    submitButtonDisplayManager(sections_selected);

    $("section.service-selected .close-btn").click(function() {
        var id = $(this).closest("[data-service-id-wrapper]").attr("data-service-id-wrapper");
        $('.pricing-services .pricing-service input[data-service-id="' + id + '"]').trigger("click");
    });
    // ************************* Pricing Service Checkbox ************************ //


    // ************************* Logo Choose Radio ************************ //
    $(".logo-options input[name=logo_concepts]").change(function() {

        $('.logo-options .total-check').removeClass("logo-total-checked");

        if ($(this).is(":checked")) {
            $(this).closest(".logo-options").children(".total-check").addClass("logo-total-checked");
        }
    });
    $(".logo-options").click(function() {
        $("input", this).prop("checked", true).trigger("change");
    });
    // ************************* Logo Choose Radio ************************ //


    // ************* Checkbox / Radio Button Label *************** //
    $(window).resize(function() {
        $(".top-servicebox-checkbox .service-checkbox label").css('width',$(".top-servicebox-checkbox .service-checkbox").width() - $(".top-servicebox-checkbox .service-checkbox > span").width() - 5);

        $(".pricing-choose .service-checkbox label").removeAttr("style").css('width', $(".pricing-choose .service-checkbox:visible").width() - $(".pricing-choose .service-checkbox:visible > span").width() - 5);

        $(".pricing-choose .service-checkbox > label").each(function() {
            if($(this).height() > 48){
                $(this).find('br').remove()
            }
        });
    }).trigger("resize");
    // ************* Checkbox / Radio Button Label *************** //



    // *********** Calculating Amount *********** //
    var calcTimeout;
    $("input[type='radio'], input[type='checkbox'], select").click(function() {
        if (calcTimeout != undefined) clearTimeout(calcTimeout);
        calcTimeout = setTimeout(calcPrice, 1000);
    }).change(function() {
        if (calcTimeout != undefined) clearTimeout(calcTimeout);
        calcTimeout = setTimeout(calcPrice, 1000);
    });
    // *********** Calculating Amount *********** //



    // *********** Social Media *********** //
    $("select[name='social_media_pri']").change(function() {
        pri_id = $("select[name='social_media_pri']").val();

        $("input[name='social_media_sec[]']").closest(".service-checkbox").show();
        $("#social_media_sec_" + pri_id ).closest(".service-checkbox").hide();

        if ($("#social_media_sec_" + pri_id ).is(":checked"))
            $("#social_media_sec_" + pri_id ).trigger("click");

    }).trigger("change");
    // *********** Social Media *********** //



    // *********** Pricing Widget *********** //
    setPricingWidget();
    $('body').on('click', '.pricing-widget .pw-toggle', function() {
        if ($('.pricing-widget').hasClass('pricing-widget-full'))
            $('.pricing-widget').removeClass('pricing-widget-full');
        else
            $('.pricing-widget').addClass('pricing-widget-full');
    });
    // *********** Pricing Widget *********** //



    // *************** URL Maker **************** //
    $("input[type=checkbox][data-service-id]").change(function() {
        var _this = $(this);

        if ($(this).is(":checked")) {
            sselection.push(_this.attr("data-service-id"));
        } else {
            sselection = $.grep(sselection, function( n, i ) {
                return ( n != _this.attr("data-service-id") );
            });
        }

        makeURL();
    });
    $("[data-cbtype='vselection']").change(function() {
        vselection = [];

        $("[data-price]:not([data-service-id])").each(function(index, element) {
            if ($(this).closest("[data-service-id-wrapper]").css("display") != 'none')
                if ($(this).is(":checked") || $(this).is(":selected"))
                    vselection.push($(this).val());
        });

        makeURL();
    });
    // *************** URL Maker **************** //



    $("#orderform-new").submit(function() {
        return sections_selected > 0;
    });



    $("a.question").uitooltip({
        content: function() {
            return $("div.tooltip-ans[data-id='" + $(this).attr("data-ans-id") + "']").html();
        },
        position: {
            my: "center bottom-5",
            at: "center top"
        }
    });

    var $viewport = $('html, body');
    $viewport.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function(e){
        $('.package-select').click(function(){
            $viewport.stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup'); // This identifies the scroll as a user action, stops the animation, then unbinds the event straight after (optional)
        });
    });
});


function makeURL() {
    url = "https://www.fuelmybrand.com/pricing-package.php?sselection=" + sselection.join(",") + "&vselection=" + vselection.join(",");


    var obj = { Title: "Pricing - FuelMyBrand", Url: url };
    history.pushState(obj, obj.Title, obj.Url);
}

function social_media_handler()
{
    pri_id = $("select[name='social_media_pri']").val();

    $("input[name='social_media_sec[]']").closest(".service-checkbox").show();
    $("#social_media_sec_" + pri_id ).closest(".service-checkbox").hide();

    if ($("#social_media_sec_" + pri_id ).is(":checked"))
        $("#social_media_sec_" + pri_id ).trigger("click");
}

var curr_xhr = null;
function calcPrice()
{
    var amount = 0;

    $("[data-price]").each(function(index, element) {
        if ($(this).closest("[data-service-id-wrapper]").css("display") != 'none')
            if ($(this).is(":checked") || $(this).is(":selected"))
                amount += parseInt($(this).attr("data-price"));
    });

    $(".pricing-widget h2").html("$" + amount);
    $(".pricing-initial span, .bank_initial_amt").html("$" + Math.ceil(amount / 2));
    $(".bank-detail-btn.pricing strong").html(Math.ceil(amount / 2));


    /* ********************* Selected Services ********************* */
    var selected_services = '';

    $(".pricing-services input:checked").each(function() {
        selected_services += '<li><i class="fa fa-check"></i>' + $(this).closest(".pricing-service").find("p").html() +  ' Selected</li>'
    });

    $(".pricing-widget ul").html(selected_services);
    setPricingWidget();
    /* ********************* Selected Services ********************* */

    /*
    $(".pricing-approx span").html('...');

    if (curr_xhr != null)
        curr_xhr.abort();

    curr_xhr = $.get("ajax_currency_convert.php", {amount: amount}, function(data) {
        $(".pricing-approx span").html(data + " AED");
        $(".bank_initial_amt_aed").html(parseFloat(data / 2) + " AED");
    });*/
}

function setPricingWidget(){
    if($('.pricing-widget ul').length)
        $('.pricing-widget').css('height',198+$('.pricing-widget ul').height());
    if($('.rtl .pricing-widget ul').length)
        $('.pricing-widget').css('height',203+$('.pricing-widget ul').height());
}

function submitButtonDisplayManager(section_count) {
    if (section_count > 0) {
        $("#submit_main, .heading-service-selected, .heading-selected-services, .bank-detail-btn.pricing").show();
        $(".heading-no-service-selected").hide();
    }
    else {
        $("#submit_main, .heading-service-selected, .heading-selected-services, .bank-detail-btn.pricing").hide();
        $(".heading-no-service-selected").show();
    }
}

function serviceWrapperManager(_this)
{
    var section_wrapper = $("[data-service-id-wrapper=" + _this.attr('data-service-id') + "]");
    if (_this.is(":checked")) {
        section_wrapper.slideDown();
        _this.closest(".pricing-service").fadeOut();
        $('.pricing-widget').addClass('pricing-widget-full');

        $('html, body').animate({
            scrollTop: section_wrapper.offset().top
        }, 1000);

        submitButtonDisplayManager(++sections_selected);

    } else {
        section_wrapper.slideUp();
        _this.closest(".pricing-service").fadeIn();
        $('.pricing-widget').addClass('pricing-widget-full');

        submitButtonDisplayManager(--sections_selected);
    }
}

function clearSelection()
{
    $('.pricing-services .pricing-service input:checked').each(function() {
        $(this).trigger('click');
    });

    $("input[data-cbtype='vselection'][type='checkbox']:checked").each(function() {
        $(this).trigger('click');
    });
}