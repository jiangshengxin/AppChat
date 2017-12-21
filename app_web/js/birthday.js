var year = document.getElementById('year');
var month = document.getElementById('month');
var day = document.getElementById('day');

var year_str = '';
var month_str = '';
var day_str = '';

for(var i = 1910;i<=2017;i++){
	if(i==2000){
		year_str += '<option selected="selected" value="'+i+'">'+i+'</option>';
	}else{
		year_str += '<option value="'+i+'">'+i+'</option>';
	}
}
for(var i = 1;i<=12;i++){
	month_str += '<option value="'+i+'">'+i+'</option>';
}

var yeared = year.value;
var days;
var monthed = month.value;

year.onchange=function(){
	yeared=parseInt(this.value);
	monthed=parseInt(month.value);
	if(((yeared%4)==0)&&((yeared%100)!=0) || ((yeared%400)==0)){
		switch(parseInt(monthed)){
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				days=31;
			break;
			case 2:
				days=29;
			break;
			default:
				days=30;
			break;
		}
	}else{
		switch(parseInt(monthed)){
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				days=31;
			break;
			case 2:
				days=28;
			break;
			default:
				days=30;
			break;
		}
	}

	day.innerHTML = '';
	day_str='';
	for(var a=1;a<=days;a++){
		day_str+= '<option selected="selected" value="'+a+'">'+a+'</option>';
	}
	day.innerHTML = day_str;
}

month.onchange=function(){
	monthed=parseInt(this.value);
	if(((yeared%4)==0)&&((yeared%100)!=0) || ((yeared%400)==0)){
		switch(parseInt(this.value)){
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				days=31;
			break;
			case 2:
				days=29;
			break;
			default:
				days=30;
			break;
		}
	}else{
		switch(parseInt(this.value)){
			case 1:
			case 3:
			case 5:
			case 7:
			case 8:
			case 10:
			case 12:
				days=31;
			break;
			case 2:
				days=28;
			break;
			default:
				days=30;
			break;
		}
	}

	day.innerHTML = '';
	day_str = '';
	for(var a=1;a<=days;a++){
		day_str+= '<option selected="selected" value="'+a+'">'+a+'</option>';
	}
	day.innerHTML = day_str;

}


year.innerHTML = year_str;
month.innerHTML = month_str;
