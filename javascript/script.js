$(document).ready(function () {
    // Liste des nodes
    var nodeLevels = ['Département','Formation','Semestre','UE / Parcours','Module','Matière','Examen'];
    //document.getElementById('coefficient_input').style.visibility = 'hidden';
    //document.getElementById('coefficient_input').style.display = 'none';
    $('#nodes_select').change(function () {
        var selected = $('select#nodes_select option:selected')[0];
        var nodeType = selected.getAttribute('data-type');
        document.getElementById('node_type_label').innerHTML  =
        document.getElementById('node_title_input').placeholder = nodeLevels[parseInt(nodeType)+1];
        if ( parseInt(nodeType) >= 5 ) { // 7: ID Epreuve
            document.getElementById('coefficient_input').style.visibility = 'visible';
            document.getElementById('coefficient_input').style.display = 'initial';
        } else {
            document.getElementById('coefficient_input').style.visibility = 'hidden';
            document.getElementById('coefficient_input').style.display = 'none';
        }
    });
    $('#nodes_select').change();
});