var jshover = function() {
	var horizontalMultilevelMenu = document.getElementById("horizontal-multilevel-menu");
	if(horizontalMultilevelMenu){
		var sfEls = horizontalMultilevelMenu.getElementsByTagName("li");
		for (var i=0; i<sfEls.length; i++) 
		{
			sfEls[i].onmouseover=function()
			{
				this.className+=" jshover";
			}
			sfEls[i].onmouseout=function() 
			{
				this.className=this.className.replace(new RegExp(" jshover\\b"), "");
			}
		}
	}
}

if (window.attachEvent) 
	window.attachEvent("onload", jshover);