var timerid = 0;
var images = new Array(	"images/banner1.png",
			"images/banner2.png",
			"images/banner3.png");
var countimages = 0;
function startTime()
{
	if(timerid)
	{timerid = 0;}
	var tDate = new Date();
	if(countimages == images.length)
	{countimages = 0;}
	if(tDate.getSeconds() % 5 == 0)
	{document.getElementById("img1").src = images[countimages];
         countimages++;
	}
	timerid = setTimeout("startTime()", 1000);
}