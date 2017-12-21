//获取c-content元素
var c_ctt = document.getElementsByClassName('b-content');

//声明样式之前的样式 与 点击之后的样式 的一个json数组
var css_obj = [
	{src1:'mes1.png',src2:'mes2.png',color:'#34B5E8'},
	{src1:'user1.png',src2:'user2.png',color:'#34B5E8'},
	{src1:'star1.png',src2:'star2.png',color:'#34B5E7'}
];


var message = document.getElementById('message');
var contacts = document.getElementById('contacts');

c_ctt[0].children[0].src='./icon/'+css_obj[0].src2;
c_ctt[0].children[1].style.color=css_obj[0].color;

//一波操作
var firstSelect = 0;
for(var i = 0;i<c_ctt.length;i++){
	(function(index){
		c_ctt[index].addEventListener('click',function(){
			c_ctt[firstSelect].children[0].src='./icon/'+css_obj[firstSelect].src1;
			c_ctt[firstSelect].children[1].style.color='';
			c_ctt[firstSelect].style.animation='';

			c_ctt[index].children[0].src='./icon/'+css_obj[index].src2;
			c_ctt[index].children[1].style.color=css_obj[index].color;
			c_ctt[index].style.animation='choose linear 0.2s';

			switch(index){
				case 0:
					message.style.display='block';
					contacts.style.display='none';
				break;
				case 1:
					message.style.display='none';
					contacts.style.display='block';
				break;
				case 2:

				break;
			}

			firstSelect = index;
		});
	})(i);
}
