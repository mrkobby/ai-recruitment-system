function ajaxObj(math,url ) {
	var x = new XMLHttpRequest();
	x.open(math, url, true );
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){
	if(x.readyState == 4 && x.status == 200){
		return true;
	}
}