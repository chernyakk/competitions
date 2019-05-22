document.addEventListener("DOMContentLoaded", sort);

function sort() {
    document.getElementById("sortId").click();
    $( document ).ready(function(){
        $('table td:last-child').each(function (i) {
            $(this).html(i+1);
        });
    });
}

const s = new Tablesort(document.getElementById('grid'), {
    descending: true
});
