
var flag = false;
$('#menu').bind('click',function(){
	if(flag)
		$('#menu_display').css('transform','scale(0,0)');
	else
		$('#menu_display').css('transform','scale(1,1)');
	flag=!flag;
});