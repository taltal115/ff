<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Simple Button</title>		

</head>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script>
stLight.options({
		publisher:'6beba854-ee6d-4ae1-a4f3-b69815c8ef63'
	});	
        
        
</script>

<body>

<div id="rclick" class="rclick">
Go ahead... right click
</div>

<div id="box"><span class="st_sharethis_button" displayText="ShareThis"></span></div>	
	
<script type="text/javascript">
	function rclick(e){
		var rightclick;
		if (!e) var e = window.event;
		if (e.which) rightclick = (e.which == 3);
		else if (e.button) rightclick = (e.button == 2);
	//	alert('Rightclick: ' + rightclick); // true or false
		if(rightclick==false){
			hideBox();
			return true;
		}
	//	console.log(e);
		var posx = 0;
			var posy = 0;
			if (e.pageX || e.pageY) 	{
				posx = e.pageX;
				posy = e.pageY;
			}
			else if (e.clientX || e.clientY) 	{
				posx = e.clientX + document.body.scrollLeft
					+ document.documentElement.scrollLeft;
				posy = e.clientY + document.body.scrollTop
					+ document.documentElement.scrollTop;
			}
	//		console.log(posx);
//			console.log(posy);
			var retVal=showBox(posx,posy);
			e.returnValue = retVal; 	// necessary for attachEvent, works with traditional
			
		return retVal;
	}
	
	function showBox(x,y){
		var box=document.getElementById("box");
		if(insideBox(document.getElementById("rclick"))){	
			box.style.display = 'block';
			box.style.top=y+"px";
			box.style.left=x+"px";
			return false;
		}else{
			return true;
		}
	}
	
	function hideBox(){
		document.getElementById("box").style.display="none";
	}
	
	function insideBox(box){
	//	console.log(box);
	//	console.log(getHW(box));
	return true;
	}

	function getHW(elem) {
	//	console.log(elem);
		var retH = 0;
		var retW = 0;
		while (elem != null) {
			retH += elem.offsetTop;
			retW += elem.offsetLeft;
			elem = elem.offsetParent;
		}
		return {
			height : retH,
			width : retW
		};
	}

	//document.oncontextmenu=function(event){return rclick(event);};
	//document.getElementById("rclick").onmousedown=function(event){rclick(event); return false;};

	
</script>	
	
	
<style>


	.rclick{
		margin-right:auto;
		margin-left:auto;
		width:500px;
		height:300px;
		border:1px solid red;
	}
	
	#box{
		display:none;
		height:100px;
		width:100px;
		position:absolute;
	}
</style>

</body>
</html>







