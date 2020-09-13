$(document).ready(function () {
    $(".selectmenu").selectmenu();
    $(".menu").menu();
    $(".selectize").selectize({
        hideSelected: true,
        selectOnTab: true
    });
    $("input, button").button();
    $(".wysiwyg").ckeditor();
    $(".description").hide();
    $(".show").on("click", function () {
        $(".description").show();
    });
    $(".hide").on("click", function () {
        $(".description").hide();
    });
});
