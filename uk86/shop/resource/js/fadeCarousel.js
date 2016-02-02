$(document).ready(function(){
	setInterval(fadeNext,5000);
});

function fadeNext() {
	$(".fade-carousel .active").show();
	$(".fade-carousel .item:not(.active)").show().css('display', 'none');

	var itemList = $(".fade-carousel .item");
	var activeItem = $(".fade-carousel .active");
	var nextActiveIndex = (activeItem.prevAll(".item").length == itemList.length-1)? 0:activeItem.prevAll(".item").length+1;

	activeItem.fadeOut(1600,function(){
		$(this).removeClass('active');
	});
	
	$(itemList[nextActiveIndex]).fadeIn(1600,function(){
		$(this).addClass('active');
	});

}