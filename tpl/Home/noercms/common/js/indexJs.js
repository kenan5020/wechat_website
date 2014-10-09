$(function(){
	//全屏背景切换
	jQuery(".fullSlide").slide({
		titCell:".hd ul",
		mainCell:".bd ul",
		effect:"fold",
		autoPlay:true,
		autoPage:true,
		trigger:"click",
		interTime:10000
	});
	
	$('.game-items-mod .bd dl').hover(function(){
		$(this).toggleClass('on')		
	});
	jQuery(".platform-info").slide({delayTime:0});
})



