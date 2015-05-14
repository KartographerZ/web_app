/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function loadDatatablesIntl(locale) {
    var pathIntl;
    if (locale == 'en') {
        pathIntl = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
    }
    else {
        pathIntl = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json";
    }
    return pathIntl;
}


