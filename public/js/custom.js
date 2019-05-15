document.addEventListener("DOMContentLoaded", sort);

function sort() {
    document.getElementById("sortId").click();
}

const s = new Tablesort(document.getElementById('grid'), {
    descending: true
});
