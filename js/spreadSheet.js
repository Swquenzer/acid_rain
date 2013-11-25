//spreadSheet.js

///<reference path="main.js"/>

// declare an anonymous function to run once the page has loaded
window.onload = function () {
    getData("function/tbl.php", "returnTable", "page=1", true);
};

function returnTable(recSet) {
    ///<summary>Replaces the existing table body with one containing the contents of recSet</summary>

    var tbody = document.createElement("tbody");
    
    //retrieve the old tbody element
    var oBody = document.getElementById("chemical_spreadsheet_body");

    //assign the id to the new tbody element
    tbody.setAttribute("id", "chemical_spreadsheet_body");

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

	// Provides client-side table sorting. Must come after table loading
	$("#chemical_spreadsheet").tablesorter( {sortList: [[2,0]]} );
}

function loadError() {
    ///<summary>In the event that the database query does not execute correctly replaces the table with error text</summary>

    //create a paragraph element to display the message
    var errMsg = document.createElement("p");
    var errString = "<p id='spreadsheetError'>An error was encountered trying to load your data.</p>";
    errMsg.setAttribute("id", "loadErr");
    errMsg.innerHTML=errString;

    var parent = document.getElementById("main");
    var table = document.getElementById("chemical_spreadsheet");

    parent.removeChild(table);
    parent.appendChild(errMsg);
}
function addCheckboxes() {
///<summary>In the event that the database query does not execute correctly replaces the table with error text</summary>
//Adds checkboxes to all rows in spreadsheet
//Checkboxes are set with values cb0 through cb(#rows)
	var i=0;
	$("table td:first-child").each(function() {
		//Cycle through each row in the table
		var cb = document.createElement("input");
		cb.setAttribute("type", "checkbox");
		cb.setAttribute("value", "cb"+i); 
		cb.setAttribute("name", "delete");
		$(this).prepend(cb);
		i++;
	});
}
function createForm(main) {
	addCheckboxes();
	//var form = document.createElement("form");
	//form.setAttribute("action", ""); //update action
	//form.setAttribute("method", "post");
	var section = document.getElementById(main);
	$('#main').wrapInner("<form id='deleteForm' action='' method='post'></form>");
	$('#main').prepend("<h1>Delete records</h1>");
	$('#deleteForm').append("<input type='submit' name='submitDelete' value='Delete Records' class='inputField'>");
}
function deleteForm(formClass) {
	$("."+formClass).remove();
}