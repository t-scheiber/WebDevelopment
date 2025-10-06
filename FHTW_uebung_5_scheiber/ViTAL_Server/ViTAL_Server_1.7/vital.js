function postData() {	
	var req = getXMLHttpRequest();
	var uri = document.getElementById("target").value
	req.open("post", uri, true);
	console.log("posting data...");
	req.send("{\"id\":\"" + document.getElementById("itemID").value + "\", \"name\":\"" + document.getElementById("itemName").value + "\", \"diastolic_pressure\": \"" + document.getElementById("diastolic").value + "\", \"systolic_pressure\": \"" + document.getElementById("systolic").value + "\", \"heart_rate\": \"" + document.getElementById("heartRate").value + "\", \"pressure_unit\":\"mm Hg\", \"heart_rate_unit\":\"bpm\"}");
}

function onReadyStateChange() {
	if(this.readyState == 4){
		if(this.status == 200){
			console.log(this.responseText);
		}
		else{
			console.log(this.statusText);
		}
	}
}

function getXMLHttpRequest() {
	var httpReq = null;
	if (window.XMLHttpRequest) {
		httpReq= new XMLHttpRequest();
	} else if (typeof ActiveXObject != "undefined") {
		httpReq= new ActiveXObject("Microsoft.XMLHTTP");
	}
	httpReq.onreadystatechange = onReadyStateChange;
	
	return httpReq;
}
