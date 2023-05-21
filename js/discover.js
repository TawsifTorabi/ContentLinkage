function fireentersearch(event){
	if (event.keyCode == 13) {
		searchAjax();
	}
}

function searchAjax(){
  var query = document.getElementById('queryInput').value;
 
  xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
	if(this.readyState == 4 && this.status == 200) {
		document.getElementById("dataTable").innerHTML = this.responseText;
	}
  }
  xmlhttp.open("GET","controller/ajax.php?data=discoverSearch&q="+query, true);
  xmlhttp.send();
}