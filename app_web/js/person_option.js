//动态设置person-option的高度
var per_opt = document.getElementById('person-option');
per_opt.style.height = window.screen.height +'px' || document.body.scrollHeight + 'px';

//设置每个选项的触摸效果
var p_options = document.querySelector('#p-options').children;
var pre_ele = null;
for(var i = 0;i<p_options.length;i++){
	p_options[i].ontouchstart=function(){
		if(pre_ele){
			pre_ele.style.backgroundColor='';
		}
		this.style.backgroundColor='#ccc';
		pre_ele = this;
	}
}
