﻿//spreadSheet.js

///<reference path="main.js"/>

// declare an anonymous function to run once the page has loaded
window.onload = function () {
    getData("function/tbl.php", "returnTable", "page=1", true);
};

function returnTable(recSet) {
    ///<summary>Replaces the existing table body with one containing the contents of recSet</summary>

    var tbody = document.createElement("tbody");
    
    //retrieve the old tbody element
    var oBody = document.getElementById("chemicals");

    //assign the id to the new tbody element
    tbody.setAttribute("id", "chemicals")

    //retrieve the containing table to perform the swap or insert
    var table = document.getElementById("chemical_spreadsheet");

    if (oBody == null) {
        table.appendChild(tbody);
    } else {
        table.replaceChild(tbody, oBody);
    }
    for (var i = 0; i < recSet.length; i++) {
        var record = recSet[i];
        var contents = [record.Room, record.Location, record.Name, record.Size + " " + record.Units];
        tr = makeTableRow(contents);
        tbody.appendChild(tr);
    }

}
