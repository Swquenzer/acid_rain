﻿//main.js
//this file is a repository for functions to be used across multiple pages


function getData(handler, callBkStr, paramStr, allowCache) {
    ///<summary>Creates and sends an injection style JSONP request.</summary>
    ///<param name="handler" type="string">The name of the php file that will be handling the request.</param>
    ///<param name="callBkStr" type="string">The name of the JS function that you be passing the data as parameters to</param>
    ///<param name="paramStr" type="string">A string containing any parameters that will need to be passed to the php file.</param>
    ///<param name="allowCache" type="boolean">Browser is allowed to cache the results of this request.</param>

    //deifine the base request url onto which we can append aditional parameters
    var url = "http://localhost/acid_rain/" + handler + "?callback=" + callBkStr;
    //add parameters to the request url
    if (!(paramStr == null || paramStr == undefined || paramStr == "")) {
        url += "&" + paramStr;
    }
    //if the browser is not allowed to cache the results of the request tack a random number onto the string
    if (allowCache == false) {
        url += "&random=" + Math.random();
    }

    //retrieve the old script tag (if it exists) and then create a tag with the new request url 
    var oScriptElement = document.getElementById("getData");
    var nScriptElement = document.createElement("script");
    nScriptElement.setAttribute("src", url);
    nScriptElement.setAttribute("id", "getData");

    var pHead = document.getElementsByTagName("head")[0];
    //insert or replace the new script element
    if (oScriptElement == null) {
        pHead.appendChild(nScriptElement);
    } else {
        pHead.replaceChild(nScriptElement, oScriptElement);
    }
}

function makeTableRow(contents) {
    ///<summary>Creates a tr element, with each item in contents[] in its own td element</summary>
    ///<param name="contents">An array containing each of the elements to be inserted into the tr</param>
    ///<returns type="HTMLElement">tr element</returns>

    var row = document.createElement("tr");
    for (var i = 0; i < contents.length; i++) {
        var td = document.createElement("td");
        td.innerHTML = contents[i];
		td.setAttribute('id', i.toString()); //Added by Stephen, each row now has id 0-(#rows)
        row.appendChild(td);
    }
    return row;
}