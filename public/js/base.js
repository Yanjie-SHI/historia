$(document).ready(function () {
    $(".controlgroup").controlgroup();
    $("#menu").menu();
    $("#centre").selectize({
        hideSelected: true,
        selectOnTab: true
    });
    $("input").button();
});
