
    //获取屏幕宽度高度
    var cWidth = window.screen.availHeight;
    var cHeight = window.screen.availHeight;

    //oninput事件
    (function(){
        var textInput = document.querySelector('[type=text]');
        var clearButton = document.querySelector('#clear');
        textInput.addEventListener('input',function(){
            clearButton.style.display='block';
        });
        clearButton.addEventListener('click',function(){
            textInput.value='';
            this.style.display='none';
        });
    })();

    //提交效果
    (function(){
        var sub = document.getElementById('submit');
        sub.addEventListener('touchstart',function(){
            this.style.opacity='0.3';
        });
        sub.addEventListener('touchend',function(){
            this.style.cssText=null;
        });
    })();

    //定位元素
    (function(){
        var topEle=document.getElementById('top');
        topEle.style.top=cHeight*0.06+'px';
        topEle.style.left=cWidth*0.04+'px';

        var login=document.getElementById('login');
        login.style.marginTop = cHeight*0.22+'px';
		/*var bg = document.getElementById('background');
		 bg.style.width = cWidth+'px';
		 bg.style.height = cHeight+'px';*/
    })();