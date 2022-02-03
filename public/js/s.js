$.each($("select"), function () {
    let s = $(this);
    $(this).on("select2:select", function (evt) {

        var element = evt.params.data.id;
        var $element = s.children('option[value="' + element + '"]');


        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
});

$.each($('select[type-select="tags"]'), function () {
    $("#"+this.id).select2({
        tags: true
    });
})
