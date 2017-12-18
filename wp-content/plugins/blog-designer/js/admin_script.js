jQuery('document').ready(function () {
    jQuery("#content_fontsize,#template_postContentfontsizeInput,#template_titlefontsize,#template_postTitlefontsizeInput").slider({
        range: "min",
        value: 1,
        step: 1,
        min: 0,
        max: 100,
        slide: function (event, ui) {
            jQuery(this).parents('.bd-typography-content').find('input.range-slider__value').val(ui.value);
        }
    });

    var content_fontsize = jQuery('#content_fontsize').closest('tr').find('input.range-slider__value').val()
    jQuery("#content_fontsize").slider("value", content_fontsize);
    var author_title_fontsize = jQuery('#template_titlefontsize').parents('.bd-typography-content').find('input.range-slider__value').val()
    jQuery("#template_titlefontsize").slider("value", author_title_fontsize);

    jQuery(".range-slider__value").change(function () {
        var value = this.value;
        var max = 100;
        if (value > max) {
            jQuery(this).parents('.bd-typography-content').find('.range_slider_fontsize').slider("value", '100');
            jQuery(this).val('100');
        } else {
            jQuery(this).parents('.bd-typography-content').find('.range_slider_fontsize').slider("value", parseInt(value));
        }
    });
    var post_title_fontsize = jQuery('#template_postContentfontsizeInput').parents('.bd-typography-content').find('input.range-slider__value').val()
    jQuery("#template_postContentfontsizeInput").slider("value", post_title_fontsize);
    var post_title_fontsize = jQuery('#template_postTitlefontsizeInput').parents('.bd-typography-content').find('input.range-slider__value').val()
    jQuery("#template_postTitlefontsizeInput").slider("value", post_title_fontsize);

    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function () {
        var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

        btnUp.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

    });

    jQuery('#template_ftcolor,#template_fthovercolor,#template_bgcolor,#template_alterbgcolor,#template_titlecolor,#template_titlehovercolor,#template_titlebackcolor,#template_contentcolor,#template_readmorecolor,#template_readmorebackcolor,#template_color').wpColorPicker();

    if (jQuery("input[name='rss_use_excerpt']:checked").val() == 1) {
        jQuery('tr.excerpt_length').show();
        jQuery('tr.read_more_on').show();
        if (jQuery("input[name='readmore_on']:checked").val() == 0) {
            jQuery('tr.read_more_text').hide();
            jQuery('tr.read_more_text_color').hide();
            jQuery('tr.read_more_text_background').hide();
        } else if (jQuery("input[name='readmore_on']:checked").val() == 1) {
            jQuery('tr.read_more_text').show();
            jQuery('tr.read_more_text_color').show();
            jQuery('tr.read_more_text_background').hide();
        } else {
            jQuery('tr.read_more_text').show();
            jQuery('tr.read_more_text_color').show();
            jQuery('tr.read_more_text_background').show();
        }
    } else {
        jQuery('tr.excerpt_length').hide();
        jQuery('tr.read_more_on').hide();
        jQuery('tr.read_more_text').hide();
        jQuery('tr.read_more_text_color').hide();
        jQuery('tr.read_more_text_background').hide();
    }

    if (jQuery("input[name='readmore_on']").is(':visible')) {
        if (jQuery("input[name='readmore_on']:checked").val() == 0) {
            jQuery('tr.read_more_text').hide();
            jQuery('tr.read_more_text_color').hide();
            jQuery('tr.read_more_text_background').hide();
        } else if (jQuery("input[name='readmore_on']:checked").val() == 1) {
            jQuery('tr.read_more_text').show();
            jQuery('tr.read_more_text_color').show();
            jQuery('tr.read_more_text_background').hide();
        } else {
            jQuery('tr.read_more_text').show();
            jQuery('tr.read_more_text_color').show();
            jQuery('tr.read_more_text_background').show();
        }
    }


    jQuery("input[name='template_alternativebackground']").change(function () {
        if (jQuery(this).val() == 0) {
            jQuery('.alternative-color-tr').show();
        } else {
            jQuery('.alternative-color-tr').hide();
        }
    });

    if (jQuery('#template_name').val() == 'classical' || jQuery('#template_name').val() == 'spektrum' || jQuery('#template_name').val() == 'timeline' || jQuery('#template_name').val() == 'news') {
        jQuery('tr.blog-template-tr').hide();
        jQuery('tr.alternative-color-tr').hide();
    } else {
        jQuery('tr.blog-template-tr').show();
        if (jQuery("input[name='template_alternativebackground']:checked").val() == 0) {
            jQuery('.alternative-color-tr').show();
        } else {
            jQuery('.alternative-color-tr').hide();
        }
    }
    if (jQuery('#template_name').val() == 'timeline') {
        jQuery('tr.blog-template-tr').hide();
        jQuery('tr.alternative-color-tr').hide();
        jQuery('tr.blog-templatecolor-tr').show();
    } else {
        jQuery('tr.blog-templatecolor-tr').hide();
    }

    jQuery("input[name='rss_use_excerpt']").change(function () {

        if (jQuery(this).val() == 1) {
            jQuery('tr.excerpt_length').show();
            jQuery('tr.read_more_on').show();
            jQuery('tr.read_more_text').show();
            jQuery('tr.read_more_text_color').show();
            jQuery('tr.read_more_text_background').show();
        } else {
            jQuery('tr.excerpt_length').hide();
            jQuery('tr.read_more_on').hide();
            jQuery('tr.read_more_text').hide();
            jQuery('tr.read_more_text_color').hide();
            jQuery('tr.read_more_text_background').hide();
        }
    });

    jQuery("input[name='readmore_on']").change(function () {
        if (jQuery(this).val() == 0) {
            jQuery('tr.read_more_text').hide();
            jQuery('tr.read_more_text_color').hide();
            jQuery('tr.read_more_text_background').hide();
        } else if (jQuery(this).val() == 1) {
            jQuery('tr.read_more_text').show();
            jQuery('tr.read_more_text_color').show();
            jQuery('tr.read_more_text_background').hide();
        } else {
            jQuery('tr.read_more_text').show();
            jQuery('tr.read_more_text_color').show();
            jQuery('tr.read_more_text_background').show();
        }
    });

    jQuery('link').each(function () {
        var href = jQuery(this).attr('href');
        if (href.search('jquery-ui.css') !== -1 || href.search('jquery-ui.min.css') !== -1) {
            jQuery(this).remove('link');
        }
    });

    jQuery('.bd_theme_plugin li a').click(function (e) {
        e.preventDefault();
        jQuery('.bd_theme_plugin li').removeClass('active');
        var $name = jQuery(this).attr('data-toggle');
        jQuery(this).parent('li').addClass('active');
        jQuery('.bd-out-other-work .bd-info-content > div').hide();
        jQuery('#' + $name).show();
    });

    /*Set Default value for each template*/
    jQuery('.bd-form-class .bdp-restore-default').click(function () {
        if (confirm(bdlite_js.reset_data)) {
            var template = jQuery('#template_name').val();
            default_data(template);
            jQuery('form.bd-form-class')[0].submit();
        } else {
            return false;
        }
    });

});

jQuery(window).load(function () {
    jQuery('#subscribe_thickbox').trigger('click');
    jQuery("#TB_closeWindowButton").click(function () {
        jQuery.post(ajaxurl,
                {
                    'action': 'close_tab'
                });
    });

    // deactivation popup code
    var bd_plugin_admin = jQuery('.documentation_bd_plugin').closest('div').find('.deactivate').find('a');
    bd_plugin_admin.click(function (event) {
        event.preventDefault();
        jQuery('#deactivation_thickbox_bd').trigger('click');
        jQuery('#TB_window').removeClass('thickbox-loading');
        change_thickbox_size();
    });
    checkOtherDeactivate();
    jQuery('.sol_deactivation_reasons').click(function () {
        checkOtherDeactivate();
    });
    jQuery('#sbtDeactivationFormClosebd').click(function (event) {
        event.preventDefault();
        jQuery("#TB_closeWindowButton").trigger('click');
    })
    function checkOtherDeactivate() {
        var selected_option_de = jQuery('input[name=sol_deactivation_reasons_bd]:checked', '#frmDeactivationbd').val();
        if (selected_option_de == '9') {
            jQuery('.sol_deactivation_reason_other_bd').val('');
            jQuery('.sol_deactivation_reason_other_bd').show();
        }
        else {
            jQuery('.sol_deactivation_reason_other_bd').val('');
            jQuery('.sol_deactivation_reason_other_bd').hide();
        }
    }
    jQuery('#sbtDeactivationFormbd').click(function (event) {
        event.preventDefault();
        var selected_option_de = jQuery('input[name=sol_deactivation_reasons_bd]:checked', '#frmDeactivationbd').val();
        var selected_option_de_id = jQuery('input[name=sol_deactivation_reasons_bd]:checked', '#frmDeactivationbd').attr("id");
        var selected_option_de_text = jQuery("label[for='" + selected_option_de_id + "']").text();
        jQuery.ajax({
            url: ajaxurl,
            method: 'POST',
            data: {
                'action': 'bd_sbtDeactivationform',
                'deactivation_option': selected_option_de,
                'deactivation_option_text': selected_option_de_text,
                'deactivation_option_other': jQuery('.sol_deactivation_reason_other_bd').val()
            },
            complete: function () {
                window.location.href = bd_plugin_admin.attr('href');
            }
        });
    });
    function change_thickbox_size() {
        jQuery(document).find('#TB_window').width('700').height('400').css('margin-left', -700 / 2);
        jQuery(document).find('#TB_ajaxContent').width('640');
        var doc_height = jQuery(window).height();
        var doc_space = doc_height - 400;
        if (doc_space > 0) {
            jQuery(document).find('#TB_window').css('margin-top', doc_space / 2);
        }
    }
});



jQuery('.bd-form-class .bd-setting-handle > li').click(function (event) {
    var section = jQuery(this).data('show');
    jQuery('.bd-form-class .bd-setting-handle > li').removeClass('bd-active-tab');
    jQuery(this).addClass('bd-active-tab');
    jQuery('.bd-settings-wrappers .postbox').hide();
    jQuery('#' + section).show();
    jQuery.post(ajaxurl, {
        action: 'bd_closed_bdboxes',
        closed: section,
        page: 'designer_settings'
    });
});

jQuery(document).ready(function () {
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: bdlite_js.nothing_found},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        jQuery(selector).chosen(config[selector]);
    }

    jQuery('.select-cover select').chosen({no_results_text: bdlite_js.nothing_found});

    jQuery('.buttonset').buttonset();
    jQuery("#bd-submit-button").click(function () {
        jQuery(".save_blogdesign").trigger("click");
    });
    jQuery(".bd-settings-wrappers .postbox table tr td:first-child").hover(function () {
        var $parent_height = jQuery(this).height();
        var $height = jQuery(this).children('.bd-title-tooltip').height();
        jQuery(this).children('.bd-title-tooltip').css('top', 'calc(50% - 30px - ' + $height + 'px)');
    });
    jQuery('#blog_page_display').change(function () {
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'bd_get_page_link',
                page_id: jQuery(this).val(),
            },
            success: function (response) {
                jQuery('.page_link').html('');
                jQuery('.page_link').append(response);
            }
        });
    });

    // select template code

    jQuery("#bd_popupdiv div.bd-template-thumbnail .bd-popum-select a").live('click', function (e) {
        e.preventDefault();
        jQuery('#bd_popupdiv div.bd-template-thumbnail').removeClass('bd_selected_template');
        jQuery(this).parents('div.bd-template-thumbnail').addClass('bd_selected_template');
    });

    jQuery(".bd_select_template").live('click', function (e) {
        e.preventDefault();
        var template_name = jQuery('#template_name').val();
        jQuery("#bd_popupdiv").dialog({
            title: bdlite_js.choose_blog_template,
            dialogClass: 'bd_template_model',
            width: jQuery(window).width() - 216,
            height: jQuery(window).height() - 100,
            modal: true,
            draggable: false,
            resizable: false,
            create: function (e, ui) {
                var pane = jQuery(this).dialog("widget").find(".ui-dialog-buttonpane");
                jQuery("<div class='bp-div-default-style'><label><input id='bp-apply-default-style' class='bp-apply-default-style' type='checkbox'/>" + bdlite_js.default_style_template + "</label></div>").prependTo(pane);
            },
            buttons: [{
                    text: bdlite_js.set_blog_template,
                    id: "btnSetBlogTemplate",
                    click: function () {
                        var template_name = jQuery('#bd_popupdiv div.bd-template-thumbnail.bd_selected_template .bd-template-thumbnail-inner').children('img').attr('src');
                        if (typeof template_name === 'undefined' || template_name === null) {
                            jQuery("#bd_popupdiv").dialog('close');
                            return;
                        }
                        var template_value = jQuery('#bd_popupdiv div.bd-template-thumbnail.bd_selected_template .bd-template-thumbnail-inner').children('img').attr('data-value');
                        jQuery(".bd_selected_template_image > div").empty();
                        jQuery('#template_name').val(template_value);
                        jQuery(".bd_selected_template_image > div").append('<img src="' + template_name + '" alt="' + template_value.replace('_', '-') + ' Template" /><label id="bd_template_select_name">' + template_value.replace('_', '-') + ' Template</label>');

                        if (template_value == 'classical' || template_value == 'spektrum' || template_value == 'news') {
                            jQuery('tr.blog-template-tr').hide();
                            jQuery('tr.alternative-color-tr').hide();
                        } else {
                            jQuery('tr.blog-template-tr').show();
                            if (jQuery("input[name='template_alternativebackground']:checked").val() == 0) {
                                jQuery('.alternative-color-tr').show();
                            } else {
                                jQuery('.alternative-color-tr').hide();
                            }
                        }
                        if (template_value == 'timeline') {
                            jQuery('tr.blog-template-tr').hide();
                            jQuery('tr.alternative-color-tr').hide();
                            jQuery('tr.blog-templatecolor-tr').show();
                        } else {
                            jQuery('tr.blog-templatecolor-tr').hide();
                        }
                        if (jQuery("input[name='template_alternativebackground']:checked").val() == 0) {
                            jQuery('.alternative-color-tr').show();
                        } else {
                            jQuery('.alternative-color-tr').hide();
                        }
                        if (jQuery('#bp-apply-default-style').is(":checked")) {
                            default_data(template_value);
                        }
                        jQuery("#bd_popupdiv").dialog('close');

                    }
                },
                {
                    text: bdlite_js.close,
                    class: 'bd_template_close',
                    click: function () {
                        jQuery(this).dialog("close");
                    },
                }
            ],
            open: function (event, ui) {
                jQuery('#bd_popupdiv .bd-template-thumbnail').removeClass('bd_selected_template');
                jQuery('#bd_popupdiv .bd-template-thumbnail').each(function () {
                    if (jQuery(this).children('.bd-template-thumbnail-inner').children('img').attr('data-value') == template_name) {
                        jQuery(this).addClass('bd_selected_template');
                    }
                });
            }
        });
        return false;
    });

    jQuery('.bd_template_tab li a').click(function (e) {
        e.preventDefault();
        var all_template_hide = true;
        jQuery('.bd_template_tab li').removeClass('bd_current_tab');
        jQuery(this).parent('li').addClass('bd_current_tab');
        var href = jQuery(this).attr('href').replace('#', '');
        jQuery('.bd-template-thumbnail').hide();
        if (href == 'all') {
            jQuery('.bd-template-thumbnail').show();
        } else {
            jQuery('.' + href + '.bd-template-thumbnail').show();
        }
        jQuery('.bd-template-thumbnail').each(function () {
            if (jQuery(this).is(':visible')) {
                all_template_hide = false;
            }
        });
        if (all_template_hide) {
            jQuery('.no-template').show();
        } else {
            jQuery('.no-template').hide();
        }
    });

    jQuery('.pro-feature, .pro-feature ul, .pro-feature input, .pro-feature a, .pro-feature .bdp-upload_image_button, #bd-show-preview').on('click', function (e) {
        e.preventDefault();
        jQuery("#bd-advertisement-popup").dialog({
            resizable: false,
            draggable: false,
            modal: true,
            height: "auto",
            width: 'auto',
            maxWidth: '100%',
            dialogClass: 'bd-advertisement-ui-dialog',
            buttons: [
                {
                    text: 'x',
                    "class": 'bd-btn bd-btn-gray',
                    click: function () {
                        jQuery(this).dialog("close");
                    }
                }
            ],
            open: function (event, ui) {
                jQuery(this).parent().children('.ui-dialog-titlebar').hide();
            },
            hide: {
                effect: "fadeOut",
                duration: 500
            },
            close: function (event, ui) {
                jQuery('#bd-template-search').val('');
                jQuery("#bd-advertisement-popup").dialog('close');
            },
        });
    });

    jQuery('.ui-widget-overlay').live("click", function () {
        jQuery('#bd-template-search').val('');
        jQuery("#bd-advertisement-popup").dialog('close');
    });

    jQuery('#bd-template-search').keyup(function () {
        var $template_name = jQuery(this).val();
        templateSearch($template_name);
    });



    jQuery('.bd-template-search-clear').on('click', function () {
        jQuery('#bd-template-search').val('');
        var $template_name = '';
        templateSearch($template_name);
    });

});

function templateSearch($template_name) {
    var template_name = jQuery('#template_name').val();
    var $template_cat = jQuery('.bd_template_tab').find('.bd_current_tab a').attr('href');
    var $all_template_hide = true;

    if ($template_name.length < 3) {
        $template_name = '';
    }
    jQuery.ajax({
        url: ajaxurl,
        method: 'POST',
        data: {
            'action': 'bd_template_search_result',
            'temlate_name': $template_name,
        },
        success: function (response) {
            jQuery('.bd-template-cover').html(response);
            var $href = $template_cat.replace('#', '');
            jQuery('.bd-template-thumbnail').hide();
            if ($href == 'all') {
                jQuery('.bd-template-thumbnail').show();
            } else {
                jQuery('.' + $href + '.bd-template-thumbnail').show();
            }
            jQuery('.bd-template-thumbnail').each(function () {
                if (jQuery(this).is(':visible')) {
                    $all_template_hide = false;
                }
            });
            if ($all_template_hide) {
                jQuery('.no-template').show();
            } else {
                jQuery('.no-template').hide();
            }
            jQuery('#bd_popupdiv .bd-template-thumbnail').removeClass('bd_selected_template');
            jQuery('#bd_popupdiv .bd-template-thumbnail').each(function () {
                if (jQuery(this).children('.bd-template-thumbnail-inner').children('img').attr('data-value') == template_name) {
                    jQuery(this).addClass('bd_selected_template');
                }
            });
        }
    });

}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function default_data(template) {
    if (template == 'classical') {
        jQuery("#display_sticky_0").prop("checked", false);
        jQuery("#display_sticky_1").prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery("#display_html_tags_0").prop("checked", true);
        jQuery("#display_html_tags_1").prop("checked", false);
        jQuery('#template_ftcolor').iris('color', '#2a97ea');
        jQuery('#template_fthovercolor').iris('color', '#999999');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery('tr.excerpt_length').show();
        jQuery('tr.read_more_on').show();
        jQuery('tr.read_more_text').show();
        jQuery('tr.read_more_text_color').show();
        jQuery('tr.read_more_text_background').show();
        jQuery("#txtExcerptlength").val("50");
        jQuery("#content_fontsize").val("14");
        jQuery("#posts_per_page").val("5");
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery("#readmore_on_0").prop("checked", false);
        jQuery("#readmore_on_1").prop("checked", false);
        jQuery("#readmore_on_2").prop("checked", true);
        jQuery('#txtReadmoretext').val('Read More');
        jQuery('#template_readmorecolor').iris('color', '#cecece');
        jQuery('#template_readmorebackcolor').iris('color', '#2e93ea');
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#instagram_link_0").prop("checked", true);
        jQuery("#instagram_link_1").prop("checked", false);
        jQuery('.buttonset').buttonset();
    }
    if (template == 'lightbreeze') {
        jQuery("#display_sticky_0").prop("checked", false);
        jQuery("#display_sticky_1").prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery("#template_alternativebackground_0").prop("checked", false);
        jQuery("#template_alternativebackground_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#1eafa6');
        jQuery('#template_fthovercolor').iris('color', '#999999');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery("#display_html_tags_0").prop("checked", true);
        jQuery("#display_html_tags_1").prop("checked", false);
        jQuery('tr.excerpt_length').show();
        jQuery('tr.read_more_on').show();
        jQuery('tr.read_more_text').show();
        jQuery('tr.read_more_text_color').show();
        jQuery('tr.read_more_text_background').show();
        jQuery("#txtExcerptlength").val("50");
        jQuery("#content_fontsize").val("14");
        jQuery("#posts_per_page").val("5");
        jQuery('#template_contentcolor').iris('color', '#999999');
        jQuery("#readmore_on_0").prop("checked", false);
        jQuery("#readmore_on_1").prop("checked", false);
        jQuery("#readmore_on_2").prop("checked", true);
        jQuery('#txtReadmoretext').val('Continue Reading');
        jQuery('#template_readmorecolor').iris('color', '#f1f1f1');
        jQuery('#template_readmorebackcolor').iris('color', '#1eafa6');
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#instagram_link_0").prop("checked", true);
        jQuery("#instagram_link_1").prop("checked", false);
        jQuery('.buttonset').buttonset();
    }
    if (template == 'spektrum') {
        jQuery("#display_sticky_0").prop("checked", false);
        jQuery("#display_sticky_1").prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery('#template_ftcolor').iris('color', '#2d7fc1');
        jQuery('#template_fthovercolor').iris('color', '#444444');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery("#display_html_tags_0").prop("checked", true);
        jQuery("#display_html_tags_1").prop("checked", false);
        jQuery('tr.excerpt_length').show();
        jQuery('tr.read_more_on').show();
        jQuery('tr.read_more_text').show();
        jQuery('tr.read_more_text_color').show();
        jQuery('tr.read_more_text_background').show();
        jQuery("#txtExcerptlength").val("50");
        jQuery("#content_fontsize").val("14");
        jQuery("#posts_per_page").val("5");
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery("#readmore_on_0").prop("checked", false);
        jQuery("#readmore_on_1").prop("checked", false);
        jQuery("#readmore_on_2").prop("checked", true);
        jQuery('#txtReadmoretext').val('Go ahead');
        jQuery('#template_readmorecolor').iris('color', '#eaeaea');
        jQuery('#template_readmorebackcolor').iris('color', '#2d7fc1');
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#instagram_link_0").prop("checked", true);
        jQuery("#instagram_link_1").prop("checked", false);
        jQuery('.buttonset').buttonset();
    }
    if (template == 'evolution') {
        jQuery("#display_sticky_0").prop("checked", false);
        jQuery("#display_sticky_1").prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery("#template_alternativebackground_0").prop("checked", false);
        jQuery("#template_alternativebackground_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#2e6480');
        jQuery('#template_fthovercolor').iris('color', '#777777');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery("#display_html_tags_0").prop("checked", true);
        jQuery("#display_html_tags_1").prop("checked", false);
        jQuery('tr.excerpt_length').show();
        jQuery('tr.read_more_on').show();
        jQuery('tr.read_more_text').show();
        jQuery('tr.read_more_text_color').show();
        jQuery('tr.read_more_text_background').show();
        jQuery("#txtExcerptlength").val("50");
        jQuery("#content_fontsize").val("14");
        jQuery("#posts_per_page").val("5");
        jQuery('#template_contentcolor').iris('color', '#777777');
        jQuery("#readmore_on_0").prop("checked", false);
        jQuery("#readmore_on_1").prop("checked", false);
        jQuery("#readmore_on_2").prop("checked", true);
        jQuery('#txtReadmoretext').val('Read More');
        jQuery('#template_readmorecolor').iris('color', '#e5e5e5');
        jQuery('#template_readmorebackcolor').iris('color', '#2e6480');
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#instagram_link_0").prop("checked", true);
        jQuery("#instagram_link_1").prop("checked", false);
        jQuery('.buttonset').buttonset();
    }
    if (template == 'timeline') {
        jQuery("#display_sticky_0").prop("checked", false);
        jQuery("#display_sticky_1").prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery('#template_color').iris('color', '#db4c59');
        jQuery('#template_ftcolor').iris('color', '#db4c59');
        jQuery('#template_fthovercolor').iris('color', '#444444');
        jQuery('#template_titlecolor').iris('color', '#222222');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery("#display_html_tags_0").prop("checked", true);
        jQuery("#display_html_tags_1").prop("checked", false);
        jQuery('tr.excerpt_length').show();
        jQuery('tr.read_more_on').show();
        jQuery('tr.read_more_text').show();
        jQuery('tr.read_more_text_color').show();
        jQuery('tr.read_more_text_background').show();
        jQuery("#txtExcerptlength").val("50");
        jQuery("#content_fontsize").val("14");
        jQuery("#posts_per_page").val("5");
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery("#readmore_on_0").prop("checked", false);
        jQuery("#readmore_on_1").prop("checked", false);
        jQuery("#readmore_on_2").prop("checked", true);
        jQuery('#txtReadmoretext').val('Read More');
        jQuery('#template_readmorecolor').iris('color', '#f1f1f1');
        jQuery('#template_readmorebackcolor').iris('color', '#db4c59');
        jQuery("#social_icon_style_1").prop("checked", false);
        jQuery("#social_icon_style_0").prop("checked", true);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#instagram_link_0").prop("checked", true);
        jQuery("#instagram_link_1").prop("checked", false);
        jQuery('.buttonset').buttonset();
    }
    if (template == 'news') {
        jQuery("#display_sticky_0").prop("checked", false);
        jQuery("#display_sticky_1").prop("checked", true);
        jQuery("#display_category_0").prop("checked", true);
        jQuery("#display_category_1").prop("checked", false);
        jQuery("#display_tag_0").prop("checked", true);
        jQuery("#display_tag_1").prop("checked", false);
        jQuery("#display_author_0").prop("checked", true);
        jQuery("#display_author_1").prop("checked", false);
        jQuery("#display_date_0").prop("checked", true);
        jQuery("#display_date_1").prop("checked", false);
        jQuery("#display_comment_count_0").prop("checked", true);
        jQuery("#display_comment_count_1").prop("checked", false);
        jQuery('#template_bgcolor').iris('color', '#ffffff');
        jQuery("#template_alternativebackground_0").prop("checked", false);
        jQuery("#template_alternativebackground_1").prop("checked", true);
        jQuery('#template_ftcolor').iris('color', '#e84059');
        jQuery('#template_fthovercolor').iris('color', '#444444');
        jQuery('#template_titlecolor').iris('color', '#333333');
        jQuery('#template_titlebackcolor').iris('color', '#ffffff');
        jQuery("#template_titlefontsize").val("30");
        jQuery("#rss_use_excerpt_0").prop("checked", false);
        jQuery("#rss_use_excerpt_1").prop("checked", true);
        jQuery("#display_html_tags_0").prop("checked", true);
        jQuery("#display_html_tags_1").prop("checked", false);
        jQuery('tr.excerpt_length').show();
        jQuery('tr.read_more_on').show();
        jQuery('tr.read_more_text').show();
        jQuery('tr.read_more_text_color').show();
        jQuery('tr.read_more_text_background').show();
        jQuery("#txtExcerptlength").val("20");
        jQuery("#content_fontsize").val("14");
        jQuery("#posts_per_page").val("5");
        jQuery('#template_contentcolor').iris('color', '#444444');
        jQuery("#readmore_on_0").prop("checked", false);
        jQuery("#readmore_on_1").prop("checked", false);
        jQuery("#readmore_on_2").prop("checked", true);
        jQuery('#txtReadmoretext').val('Continue Reading');
        jQuery('#template_readmorecolor').iris('color', '#e84059');
        jQuery('#template_readmorebackcolor').iris('color', '#f1f1f1');
        jQuery("#social_icon_style_1").prop("checked", true);
        jQuery("#social_icon_style_0").prop("checked", false);
        jQuery("#facebook_link_0").prop("checked", true);
        jQuery("#facebook_link_1").prop("checked", false);
        jQuery("#twitter_link_0").prop("checked", true);
        jQuery("#twitter_link_1").prop("checked", false);
        jQuery("#google_link_0").prop("checked", true);
        jQuery("#google_link_1").prop("checked", false);
        jQuery("#linkedin_link_0").prop("checked", true);
        jQuery("#linkedin_link_1").prop("checked", false);
        jQuery("#pinterest_link_0").prop("checked", true);
        jQuery("#pinterest_link_1").prop("checked", false);
        jQuery("#instagram_link_0").prop("checked", true);
        jQuery("#instagram_link_1").prop("checked", false);
        jQuery('.buttonset').buttonset();
    }
    jQuery('.chosen-select option').prop('selected', false).trigger('chosen:updated');
}