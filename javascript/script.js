//-----------------------------------------------------------------------------
// INTERFACE ADMINISTRATEUR

var GestionNotes = {'admin': {}, 'diretude': {}, 'etudiant': {}};

GestionNotes['admin']['etudiants_liste'] = function () {
    var promotions_cache = new Object();
    var students_cache = new Object();

    window.onload = function ()
    {
        var td = document.getElementsByTagName('td');
        for ( var i = 0; i < td.length; i++ ) {
            if ( td[i].hasAttribute("data-formation-id") ) {
                td[i].addEventListener('mouseover', show_formation);
                td[i].addEventListener('mouseout', hide_formation);
            }
            else if ( td[i].hasAttribute('data-student-id') ) {
                td[i].addEventListener('mouseover', show_student);
                td[i].addEventListener('mouseout', hide_student);
            }
        }
    };
    function show_formation() {
        var id = this.getAttribute('data-formation-id');

        var rechercher = document.getElementById('rechercherEtudiants');
        rechercher.style.display = 'none';
        rechercher.style.visibility = 'hidden';

        var infos = document.getElementById('informationFormation');
        infos.style.display = 'inline';
        infos.style.visibility = 'visible';

        if ( id in promotions_cache ) {
            document.getElementById('informationFormation').innerHTML = promotions_cache[id];
        } else {
            var xmlhttp = new XMLHttpRequest();
            var id = encodeURIComponent(this.getAttribute('data-formation-id'));
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    infos.innerHTML=xmlhttp.responseText;           
                    promotions_cache[id] = xmlhttp.responseText;
                }
            };
            xmlhttp.open('get', formations_infos_url+'&id='+id, true);
            xmlhttp.send();
        }
    };
    function hide_formation() {
        var rechercher = document.getElementById('rechercherEtudiants');
        rechercher.style.display = 'inline';
        rechercher.style.visibility = 'visible';

        var infos = document.getElementById('informationFormation');
        infos.style.display = 'none';
        infos.style.visibility = 'hidden';
    };

    function show_student () {
        var id = this.getAttribute('data-student-id');
        
        var rechercher = document.getElementById('rechercherEtudiants');
        rechercher.style.display = 'none';
        rechercher.style.visibility = 'hidden';

        var infos = document.getElementById('informationFormation');
        infos.style.display = 'inline';
        infos.style.visibility = 'visible';
        
        if ( id in students_cache ) {
            document.getElementById('informationFormation').innerHTML = students_cache[id];
        } else {
            var xmlhttp = new XMLHttpRequest();
            var id = encodeURIComponent(this.getAttribute('data-student-id'));
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    infos.innerHTML=xmlhttp.responseText;           
                    students_cache[id] = xmlhttp.responseText;
                }
            };
            xmlhttp.open('get', students_infos_url+'&id='+id, true);
            xmlhttp.send();
        }
    };
    function hide_student () {
        var rechercher = document.getElementById('rechercherEtudiants');
        rechercher.style.display = 'inline';
        rechercher.style.visibility = 'visible';

        var infos = document.getElementById('informationFormation');
        infos.style.display = 'none';
        infos.style.visibility = 'hidden';
    }
};