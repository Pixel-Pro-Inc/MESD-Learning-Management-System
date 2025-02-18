(function($) {
    $(document).ready(function() {
    // Custom Select Search w/ Icons
        $("div[id$='loms_icon_class'], div[id^='loms_icon_class'], .loms_icon_class").each(function() {
            $(this).find(".custom-select").each(function() {
                $(this).wrap("<div class='ui_kit_select_search'></div>");
                $(this).find("option").each(function() {
                    var $lomsIcon = $(this).attr("value");
                    $(this).attr("data-tokens", $lomsIcon).attr("data-icon", $lomsIcon).attr("data-subtext", $lomsIcon);
                });
                $(this).addClass("selectpicker").attr("data-live-search", "true").attr("data-width", "100%").removeClass("custom-select");
            });
        });
    });

  }(jQuery));
