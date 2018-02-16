function afficherGroupe() {
    // le choix du groupe est affiché uniquement pour l'école de Rodez
    var aAfficher = document.getElementById("groupe3iL");
    if (document.getElementById("groupRodez").checked) {
        aAfficher.style.display = "block";
    } else {
        aAfficher.style.display = "none";
    }
}

$(window).on("load",function(){
    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function (i) {
                $(this).html(i + 1);
            });
        };


    $("#sort tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();
});