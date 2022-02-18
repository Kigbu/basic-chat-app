	/***********************************************************
	*   Filename: ajax.js                                                              
	*   Purpose: make Ajax Request                                                        
	*   (c) Thakares Infotech Pvt. Ltd.                                                     
	*   Website: http://www.thakares.com                                                   
	*   e-Mail: info@thakares.com                                                           
	*   (c) Copyright by Thakares Infotech Pvt. Ltd.                                      
	*   Released under GPL. But not for commercial purpose                                 
	***********************************************************/

var XmlHttp = false;

try  { // for IE 7.0/ firefox and other browsers etc
    XmlHttp = new XMLHttpRequest();
}  catch(e)  {
    // check Microsoft Ajax ActiveX Object
    var MicrosoftAjaxObject = new Array("MSXML2.XMLHTTP.6.0",
                                        "MSXML2.XMLHTTP.5.0",
                                        "MSXML2.XMLHTTP.4.0",
                                        "MSXML2.XMLHTTP.3.0",
                                        "MSXML2.XMLHTTP",
                                        "Microsoft.XMLHTTP");
                                    
    for (var i=0; i < MicrosoftAjaxObject.length && !XmlHttp; i++){
            try {
                // try to create the XMLHttpRequest object
                XmlHttp = new ActiveXObject(MicrosoftAjaxObject[i]);
            }
            catch(e){}
    }
}

function makeRequest(method, serverPage, objID) {      // Ajax server file request function 
    var obj = document.getElementById(objID);  // find Target TAG 
    obj.innerHTML = "Loading...";  // Print wait text while ajax gets a response  
    XmlHttp.open(method, serverPage, true);     // make a request using method 
    XmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
    
    XmlHttp.onreadystatechange = function() {
        if (XmlHttp.readyState == 4 && XmlHttp.status == 200) {   //4 - request complete, 200 - No error response OK
            obj.innerHTML = XmlHttp.responseText;  // Print to the target Tag
        }
    }
    
    XmlHttp.send(null);
} 

/****************************end of file ****************************************************/