function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      oldonload();
      func();
    }
  }
}

function getElementsByClassName(node,classname)
{
		if(node.getElementsByClassName)
		{
				return node.getElementsByClassName(classname);
		}
		else
		{
				var results = new Array();
				var elems = node.getElementsByTagName("*");
				for (var i=0; i<elems.length; i++)
				{
						if (elems[i].className.indexOf(classname) != -1)
						{
								results[results.length] = elems[i];
						}
				}
				return results;
		}
}

function highlightPage() {
  if (!document.getElementsByTagName) return false;
  if (!document.getElementById) return false;  
  var navs = document.getElementsByClassName('nav');
  if (navs.length == 0) return false;
  
  var links = navs[0].getElementsByTagName("a");
	var lis = navs[0].getElementsByTagName("li");
	var linkurl;
	for (var i=0; i<links.length;i++)
	{
			linkurl = links[i].getAttribute("href");
			if (window.location.href.indexOf(linkurl) != -1)
			{
					lis[i].className = "active";
			}
	}
}

// Load events
addLoadEvent(highlightPage);
