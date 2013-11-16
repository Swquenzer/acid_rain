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

    for (var i = 0; i < recSet.length; i++) {
        var option = document.createElement("Option");
        var record = recSet[i];

        option.setAttribute("value", record.manufacturers);
        mfrs.appendChild(option);

        option = document.createElement("Option");
        option.setAttribute("value", record.chemicals);
        chemicals.appendChild(option);

        option = document.createElement("Option");
        option.setAttribute("value", record.rooms);
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
