
/**
 * @msg string 提示错误信息
 * @time int   提示信息显示时间，默认为2秒
 */
function showError(msg, time, url){
	if(time == '' || time == undefined){
		time = 2;
	}
	var html = '<div class="dialog"><div class="dialogBody"><i class="close" onClick="dialogRemove()"></i><div class="dialogHead"><i class="icon-error"></i><p>错误信息</p></div><div class="dialogMsg">'+ msg +'</div><div class="closeTime">'+ time +'秒之后关闭窗口</div></div></div>';
	$('body').append(html);
	setTimeout(dialogRemove, time*1000);
	if(url != '' && url != undefined){
		setTimeout(function(){window.location.href=url;}, time*1000);
	}
}

/**
 * @msg string 提示信息
 * @url string 跳转链接，不填则不跳转
 * @time int   提示信息显示时间，默认为2秒
 */
function showDialog(msg, time, url){
	if(time == '' || time == undefined){
		time = 2;
	}
	var html = '<div class="dialog"><div class="dialogBody"><i class="close" onClick="dialogRemove()"></i><div class="dialogHead"><i class="icon-dialog"></i><p>系统提示信息</p></div><div class="dialogMsg">'+ msg +'</div><div class="closeTime">'+ time +'秒之后关闭窗口</div></div></div>';
	$('body').append(html);
	setTimeout(dialogRemove, time*1000);
	if(url != '' && url != undefined){
		setTimeout(function(){window.location.href=url;}, time*1000);
	}
}

function dialog_load(){
	var html = '<div class="dialog"><i class="icon-dialog-load"></i></div>';
	$('body').append(html);
}

function dialogRemove(){
	$('.dialog').remove();
}

function dialog_hide(){
	$('.dialog_html').addClass('hidden');
}
