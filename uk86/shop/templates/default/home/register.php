<?php defined('InUk86') or exit('Access Invalid!');?>
<style type="text/css">
.public-top-layout, .head-app, .head-search-bar, .head-user-menu, .public-nav-layout, .nch-breadcrumb-layout, #faq {
	display: none !important;
}
.public-head-layout {
	margin: 10px auto -10px auto;
}
.wrapper {
	width: 1000px;
}
.header-logo{
    display: none;
}
#footer {
	border-top: none!important;
	padding-top: 30px;
}
.get_nchash{display:block; min-width:80px; text-align:center !important; margin-left:10px; float:left; border:1px solid #AAA;
	background:#f6f6f6; padding:0 5px;
}
.get_nchash:hover{ text-decoration:none;}
.check_hover:hover{background:#EEEEEE;}
.not_click{cursor: not-allowed;}
</style>




<div class="container">
    <div class="register-left-img">
        <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/img/mall-100.jpg" />
    </div>
    <div class="register-right">
        <h3>用户注册</h3>
        <form id="register_form" method="post" action="<?php echo SHOP_SITE_URL;?>/index.php?act=login&op=usersave">
            <?php Uk86Security::uk86_getToken();?>
            <div class="box-01" style="margin-top:20px;">

                <div class="pt-box">
                    <div class="input-out">
                        <input autofocus placeholder="<?php echo $lang['login_register_username'];?>"  type="text"
                               id="user_name" name="user_name" class="input-01 tip" title="<?php echo
                        $lang['login_register_username_to_login'];?>"  />
                        <span class="ico-01"></span>
                    </div>
                </div>
                <div class="pt-box">
                    <div class="input-out">
                        <input placeholder="<?php echo $lang['login_register_pwd'];?>" type="password" id="password" name="password" class="input-01 tip"
                               title="<?php echo $lang['login_register_password_to_login'];?>" />
                        <span class="ico-02"></span>
                    </div>
                </div>

                <div class="pt-box">
                    <div class="input-out">
                        <input  placeholder="<?php echo $lang['login_register_ensure_password'];?>" type="password" id="password_confirm" name="password_confirm"
                                class="input-01  tip" title="<?php echo $lang['login_register_input_password_again'];?>"/>
                        <span class="ico-02"></span>
                    </div>
                </div>

                <div class="pt-box">
                    <div class="input-out">
                        <input  placeholder="<?php echo $lang['login_register_email'];?>" type="text" id="email"
                                name="email" class="input-01  tip" title="<?php echo $lang['login_register_input_valid_email'];?>" />
                        <span class="ico-02"></span>
                    </div>
                </div>


                <div class="pt-box">
                    <div class="input-out input-yz-out">
                        <input  placeholder="<?php echo $lang['login_register_code'];?>" type="text" id="captcha" name="captcha" class="input-01 w50 fl tip"
                                maxlength="4" size="10" title="<?php echo $lang['login_register_input_code'];?>" />
                    </div>
                    <a href="javascript:void(0);" class="yzm-a get_nchash check_hover">获取验证码</a>
                </div>
                <div class="protocol">
                    <input name="agree" type="checkbox" class="checkbox-01 vm ml10" id="clause" value="1"
                           checked="checked" />
                    阅读并同意<a href="#">服务协议</a>
                </div>
                <div class="text-box">
                    <input  style="margin-left:87px;"  type="submit" id="Submit" value="<?php echo $lang['login_register_regist_now'];?>"
                            class="login-a" title="<?php echo $lang['login_register_regist_now'];?>" />
                    <p class="p-01">我已经注册过账号，立即&nbsp;<a class="a-01" href="index.php?act=login&ref_url=<?php echo urlencode($output['ref_url']); ?>" >登录</a>
                        &nbsp;或是<a class="a-02"  href="index.php?act=login&op=forget_password">找回密码？</a></p>
                </div>
            </div>
        </form>
    </div>
</div>










<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js" charset="utf-8"></script>
<script>
//注册表单提示
$('.tip').poshytip({
	className: 'tip-yellowsimple',
	showOn: 'focus',
	alignTo: 'target',
	alignX: 'center',
	alignY: 'top',
	offsetX: 0,
	offsetY: 5,
	allowTipHover: false
});

//获取验证码
$('.get_nchash').click(function(){
	var email = $('#email').val();
	if(email == ''){return false;}
	if($(this).hasClass('not_click')){return false;}
	$.get('index.php?act=seccode&op=makecode_email', {email:email}, function(msg){
		if(msg != ''){
			$('#nchash').val(msg);
			showDialog('验证码已发送至您的邮件，请在30分钟内完成验证。');
			$('.get_nchash').removeClass('check_hover').addClass('not_click');
			var x = 60;
			var t = setInterval(function(){
				$('.get_nchash').html(x+'秒后重新发送');
				x--;
				if(x < 0){
					clearInterval(t);
					$('.get_nchash').html('获取验证码');
					$('.get_nchash').addClass('check_hover').removeClass('not_click');
				}
			},1000);
		}else{
			showError('你的邮箱地址不正确。');
		}
	});
});

//注册表单验证
$(function(){
		jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[^:%,'\*\"\s\<\>\&]+$/i.test(value);
		}, "Letters only please");
		jQuery.validator.addMethod("lettersmin", function(value, element) {
			return this.optional(element) || ($.trim(value.replace(/[^\u0000-\u00ff]/g,"aa")).length>=3);
		}, "Letters min please");
		jQuery.validator.addMethod("lettersmax", function(value, element) {
			return this.optional(element) || ($.trim(value.replace(/[^\u0000-\u00ff]/g,"aa")).length<=15);
		}, "Letters max please");
    $("#register_form").validate({
        errorPlacement: function(error, element){
            var error_td = element.parents('.pt-box');
            error_td.find('label').hide();
            error_td.append(error);
        },
        onkeyup: false,
        rules : {
            user_name : {
                required : true,
                lettersmin : true,
                lettersmax : true,
                lettersonly : true,
                remote   : {
                    url :'index.php?act=login&op=check_member&column=ok',
                    type:'get',
                    data:{
                        user_name : function(){
                            return $('#user_name').val();
                        }
                    }
                }
            },
            password : {
                required : true,
                minlength: 6,
				maxlength: 20
            },
            password_confirm : {
                required : true,
                equalTo  : '#password'
            },
            email : {
                required : true,
                email    : true,
                remote   : {
                    url : 'index.php?act=login&op=check_email',
                    type: 'get',
                    data:{
                        email : function(){
                            return $('#email').val();
                        }
                    }
                }
            },
/*			<?php if(C('captcha_status_register') == '1') { ?>
           captcha : {
                required : true,
                remote   : {
                    url : 'index.php?act=seccode&op=check&nchash=<?php echo uk86_getNchash();?>',
                    type: 'get',
                    data:{
                        captcha : function(){
                            return $('#captcha').val();
                        }
                    },
                   complete: function(data) {
                        if(data.responseText == 'false') {
                       	document.getElementById('codeimage').src='<?php echo SHOP_SITE_URL?>/index.php?act=seccode&op=makecode&nchash=<?php echo uk86_getNchash();?>&t=' + Math.random();
                       }
                   }
               }
           },
			<?php } ?> */
            agree : {
                required : true
            }
        },
        messages : {
            user_name : {
                required : '<?php echo $lang['login_register_input_username'];?>',
                lettersmin : '<?php echo $lang['login_register_username_range'];?>',
                lettersmax : '<?php echo $lang['login_register_username_range'];?>',
				lettersonly: '<?php echo $lang['login_register_username_lettersonly'];?>',
				remote	 : '<?php echo $lang['login_register_username_exists'];?>'
            },
            password  : {
                required : '<?php echo $lang['login_register_input_password'];?>',
                minlength: '<?php echo $lang['login_register_password_range'];?>',
				maxlength: '<?php echo $lang['login_register_password_range'];?>'
            },
            password_confirm : {
                required : '<?php echo $lang['login_register_input_password_again'];?>',
                equalTo  : '<?php echo $lang['login_register_password_not_same'];?>'
            },
            email : {
                required : '<?php echo $lang['login_register_input_email'];?>',
                email    : '<?php echo $lang['login_register_invalid_email'];?>',
				remote	 : '<?php echo $lang['login_register_email_exists'];?>'
            },
/*			<?php if(C('captcha_status_register') == '1') { ?>
	            captcha : {
                required : '<?php echo $lang['login_register_input_text_in_image'];?>',
				remote	 : '<?php echo $lang['login_register_code_wrong'];?>'
            },
			<?php } ?>  */
            agree : {
                required : '<?php echo $lang['login_register_must_agree'];?>'
            }
        }
    });
});
</script>