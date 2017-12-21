/* chat.html 对应js文件 */

/* 发送按钮绑定事件 */
var send_bt = document.querySelector('#send_bt');
send_bt.addEventListener('mousedown',function(){
	this.style.opacity='0.6';
	// setTimeout(function(){
	// 	this.style.opacity='0.9';
	// }.bind(this),150);
});
send_bt.addEventListener('mouseup',function(){
	this.style.opacity='';
});


/* 输入框绑定键盘按下事件 - 回车键 */
var send_inp = document.getElementById('send').children[0];
send_inp.addEventListener('keypress',function(e){
	//回车键输入键代码 13
	var enterCode = 13;
	//判断是否同时按下ctrl与回车键
	if(e.ctrlKey && e.keyCode===parseInt(enterCode)){
		alert('触发：ctrl + enter 事件 chat.js on line 22');
	}
});

