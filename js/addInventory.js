//addInventory.js

///<reference path="main.js">
window.onload = function () {
    getData("function/tbl.php", "addInventoryLoad", "", false);
}

function addInventoryLoad(recSet) {
    ///<summary>Fills the datalist elements with info from the database</summary>

    // retrieve the datalist elements to be filled
    var mfrs = document.getElementById("manufacturers");
    var chemicals = document.getElementById("chemicals");
    var rooms = document.getElementById("rooms");
	
	// Creates separate arrays for each field
	var manArray = [];
	var chemArray = [];
	var roomArray = [];
	var record;
    for (var i = 0; i < recSet.length; i++) {
		record = recSet[i];
		manArray.push(record.manufacturers);
		chemArray.push(record.chemicals);
		roomArray.push(record.rooms);
	}
	
	// Reduce each array so that elements are distinct. Maintains order of elements 
	var manUnique = manArray.reverse().filter(function (e, i, manArray) {
		return manArray.indexOf(e, i+1) === -1;
		}).reverse();
	var chemUnique = roomArray.reverse().filter(function (e, i, chemArray) {
		return chemArray.indexOf(e, i+1) === -1;
		}).reverse();
	var roomUnique = roomArray.reverse().filter(function (e, i, roomArray) {
		return roomArray.indexOf(e, i+1) === -1;
		}).reverse();
		
	// Add elements in arrays as options
	for(var i=0; i<manUnique.length; i++) {
		var option = document.createElement("Option");
		option.setAttribute("value", manUnique[i]);
		mfrs.appendChild(option);
	}
	for(var i=0; i<chemUnique.length; i++) {
		var option = document.createElement("Option");
		option.setAttribute("value", chemUnique[i]);
		chemicals.appendChild(option);
	}
	for(var i=0; i<roomUnique.length; i++) {
		var option = document.createElement("Option");
		option.setAttribute("value", roomUnique[i]);
		rooms.appendChild(option);
	}
}
function suggMfrs() {
    $(function() {
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "Manufacterer Suggestion 1": function() {
                        $( this ).dialog( "close" ); //Run search query using inputed manufacturer
                    },
                "Try again": function() {
                    $( this ).dialog( "close" ); //Run search query using suggested manufacturer
                }
            }
        });
    });
}
