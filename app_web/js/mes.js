//判断当前是否移动端
var userAgentInfo = navigator.userAgent;
var checkAgent = /Windows/;
var is_mobile;
if(checkAgent.test(userAgentInfo)){
	is_mobile = false;
}else{
	is_mobile = true;
}

//获取消息页面每个信息条的元素 以及其子元素
var mblock = document.querySelectorAll('.m-block');
var zblock = document.querySelectorAll('.m-zblock');

//隐藏操作菜单的宽度
var handleWidth = parseInt(getComputedStyle(document.querySelector('.handle')).width);

//移动距离
var movingX=0;
var start = null;

//获取 置顶 - 删除 - 标记为未读
var delMes = document.querySelectorAll('.handle a:nth-of-type(3)');
var topMes = document.querySelectorAll('.handle a:nth-of-type(2)');
var everMes = document.querySelectorAll('.handle a:nth-of-type(1)');
var messa = document.querySelector('#message');

//电脑端的右键菜单
var cMenu = document.getElementById('context');

//循环绑定事件
for(var i = 0;i<zblock.length;i++){
	zblock[i].style.left='0px';
	if(is_mobile){
		(function(index){
		delMes[index].addEventListener('touchstart',function(){
			messa.removeChild(delMes[index].parentElement.parentElement);
		});

		zblock[index].addEventListener('touchstart',function(event){
			if(zblock[index].style.left=='-215px'){
				setTimeout(function(){
					zblock[index].style.cssText+='background-color:white;left:0px';
				},70);
			}else{
				start = event.touches[0].clientX;
				zblock[index].style.backgroundColor='#F5F5F5';
				zblock[index].ontouchmove=function(event){

					//移动的位置
					var x = event.touches[0].clientX;

					//x是移动的实时X位置 用开始的位置-this=移动的距离
					var mleft = start-x;
					movingX=mleft;

					//如果移动距离大于0 那么取倒数 给元素进行定位 实现拖动效果
					if(mleft>0){
						zblock[index].style.left = -mleft+'px';
					}

					//如果移动的距离大于操作菜单的4分之1 那么自动滑到最左边 显示出操作菜单
					if(mleft>handleWidth/4){
						zblock[index].style.transition='all 0.5s';
						zblock[index].style.left='-215px';
						zblock[index].removeEventListener('touchmove');
					}
				}
			}

			//解决过渡样式 样式是逐渐过渡 影响判断：设置计时器 等待一小段时间 再进行判断
			//判断
			setTimeout(function(){
				nState =true;
				for(var c = 0;c<zblock.length;c++){
					var j = parseInt(getComputedStyle(zblock[c]).left);
					if(j!=0){
						nState=false;
					}
				}
				if(nState){
					// 点击信息条后跳转的聊天页面
					location.href='chat.html'
				}

			},50);

			});

			zblock[index].ontouchend=function(event){

				//唯一操作 将其他的操作域关闭
				for(var v=0;v<zblock.length;v++){
					if(index!=v){
						if(zblock[v].style.left=='-215px'){
							zblock[v].style.left='0px'
						}
					}
				}
				zblock[index].style.backgroundColor='';

				//从开始到结束的距离
				var moveingX = cWidth - event.pageX;
				if(movingX<handleWidth/4){
						this.style.left='0px';
				}
			}
		})(i);
	}else{

		(function(index){

			zblock[index].addEventListener('click',function(){
				window.location.href='chat.html';
			});

			zblock[index].addEventListener('contextmenu',function(e){
				//必要
				e.stopPropagation();
				e.preventDefault();

				var x = e.clientX;
				var y = e.clientY;

				cMenu.style.left = x+'px';
				cMenu.style.top = y+'px';
				cMenu.style.display = 'block';
				cMenu.setAttribute('index',index);

			});

		})(i);
	}

}

if(!is_mobile){
	cMenu.addEventListener('click',function(e){
		nowEle = e.target;
		nowIndex = cMenu.getAttribute('index');
		switch(nowEle.innerHTML){
			case '置顶':
				alert('功能不可用，当前索引为'+nowIndex+' ，需要配合数据库...(mes.js 下139行)');
			break;
			case '标为未读':
				alert('功能不可用，当前索引为'+nowIndex+' ，需要配合数据库...(mes.js 下142行)');
			break;
			case '删除':
				zblock[nowIndex].parentElement.parentElement.removeChild(zblock[nowIndex].parentElement);
			break;
			case '取消操作':

			break;
		}
		cMenu.style.display='none';
	});
}



var photo = document.getElementById('head');
var person = document.getElementById('person-option');
// var center = document.getElementById('center');
photo.addEventListener('click',function(){
	var black_over = document.createElement('div');
	black_over.setAttribute('id','over');
	document.body.appendChild(black_over);
	person.style.left='0%';
	// center.style.left='80%';
	black_over.addEventListener('click',function(){
		person.style.left='-100%';
		// center.style.left='';
		this.parentElement.removeChild(black_over);
	});
});


//定位concat-block
var concat_block = document.querySelectorAll('.concat-block');
var jl = 0;
for(var i = 0;i<concat_block.length;i++){
	jl = i*100;
	concat_block[i].style.left=jl+'%';
}

//选择 好友/群分类时的下滑动边框
var bborder = document.getElementById('b-border');
var everySspan = document.querySelectorAll('#z-choose li span');
var everyLi = document.querySelectorAll('#z-choose li');
var bw = parseInt(getComputedStyle(everySspan[0]).width);
var nowTouchStart = 0;
bborder.style.width=bw+'px';
var fl = everySspan[0].offsetLeft;
bborder.style.left=fl+10+10+'px';
for(var i = 0;i<everyLi.length;i++){
	(function(index){
		everyLi[index].addEventListener('click',function(){
			//使用祖传算法 实现类似无缝轮播图的效果
			for(var v=0;v<concat_block.length;v++){
					concat_block[v].style.left = (v-index)*100+'%';
				}

			bw = parseInt(getComputedStyle(everySspan[index]).width);
			bborder.style.width=bw+'px';
			fl = everySspan[index].offsetLeft;
			bborder.style.left=fl+'px';

			nowTouchStart=index;
		});
	})(i);
}


// 每一个好友分组绑定触摸事件
var zTitle = document.querySelectorAll('.z-title');
var pEvery = document.querySelectorAll('.p-every');

for(var i = 0;i<zTitle.length;i++){
	(function(index){
		zTitle[index].addEventListener('click',function(){
			if(this.getAttribute('state')=='close'){
				this.children[0].children[0].style.cssText+='transform:rotate(90deg)';
				this.setAttribute('state','open');
				pEvery[index].style.maxHeight='3000px';
			}else{
				this.children[0].children[0].style.cssText+='transform:rotate(0deg)';
				this.setAttribute('state','close');
				pEvery[index].style.maxHeight='0px';
			}
		});
	})(i);
}

//每一个群分组绑定触摸事件
var gTitle = document.querySelectorAll('.g-title');
var gEvery = document.querySelectorAll('.g-every');

for(var i = 0;i<gTitle.length;i++){
	(function(index){
		gTitle[index].addEventListener('click',function(){
			if(this.getAttribute('state')=='close'){
				this.children[0].children[0].style.cssText+='transform:rotate(90deg)';
				this.setAttribute('state','open');
				gEvery[index].style.maxHeight='3000px';
			}else{
				this.children[0].children[0].style.cssText+='transform:rotate(0deg)';
				this.setAttribute('state','close');
				gEvery[index].style.maxHeight='0px';
			}
		});
	})(i);
}



