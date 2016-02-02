<?php
/**
 * 支付入口
 *
 *
 *by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class mb_paymentControl extends BaseHomeControl{

    public function __construct() {
    	parent::__construct();
    }
	
    function indexOp() {
    	$model = Model('mb_payment');
    	$params = array('payment_id' => $_GET['pay_id']);
    	$pay = $model->get_payment_info($params);
        switch ($pay['payment_code']) {
        	case 'alipay' :
       			 if (empty($pay)) {
            		exit(json_encode(array('msg' => '没有开启支付宝支付', 'status' => '1')));
            	}
            	$conf = unserialize($pay['payment_config']);
                if (empty($conf)) {
                    exit(json_encode(array('msg' => '沒有配置支付宝支付参数', 'status' => '1')));
                }
        		$url = SHOP_SITE_URL.'/index.php?act=mb_payment&op=alipay&pay_sn='.$_GET['pay_sn'];
        		break;
            case 'wxpay':
            default:
            	if (empty($pay)) {
            		exit(json_encode(array('msg' => '没有开启微信支付', 'status' => '1')));
            	}
            	$conf = unserialize($pay['payment_config']);
                if (empty($conf)) {
                    exit(json_encode(array('msg' => '沒有配置微信支付参数', 'status' => '1')));
                }
                $url = SHOP_SITE_URL.'/index.php?act=mb_payment&op=wxpay&pay_sn='.$_GET['pay_sn'];
                break;
        }
        exit(json_encode(array('msg' => $url, 'status' => '0')));
    }
    
	function my_cus_substr($str, $len, $flag = true) {
		if (mb_strlen ( $str ) < $len)
			return $str;
		$i = 0;
		$tlen = 0;
		$tstr = '';
		while ( $tlen < $len ) {
			$tlen ++;
			$chr = mb_substr ( $str, $i, 1, 'utf8' );
			if ($tlen > $len)
				break;
			$tstr .= $chr;
			$i ++;
		}
		if ($tstr != $str && $flag) {
			$tstr .= '...';
        }
        return $tstr;
    }
    
    
    function wxpayOp() {
    	$model = Model('mb_payment');
    	$params = array('payment_code' => 'wxpay');
    	$pay = $model->get_payment_info($params);
    	$rt = unserialize($pay['payment_config']);
    	$payconf = array(
    		'appid' => $rt['wxpay_appid'],
    		'appsecret' => $rt['wxpay_appsecret'],
    		'apikey' => $rt['wxpay_key'],
    		'mch_id' => $rt['wxpay_mch_id']
    	); 
    	include_once(BASE_PATH.DS.'api'.DS."wxpay/WxPayApi.php");
		//使用jsapi接口
		$jsApi = new JsApi_pub($payconf);
	
		//=========步骤1：网页授权获取用户openid============
		//通过code获得openid
		if (isset($_SESSION['wx_openid']) && $_SESSION['wx_openid']) {
			$openid = trim($_SESSION['wx_openid']);
		}else{
			if (!isset($_GET['code'])) {
		    	$redirect_uri = SHOP_SITE_URL.'/index.php?act=mb_payment&op=wxpay&pay_sn='.$_GET['pay_sn'];
				//触发微信返回code码
				$url = $jsApi->createOauthUrlForCode(urlencode($redirect_uri));
				Header("Location: $url"); 
			} else {
				//获取code码，以获取openid
			    $code = $_GET['code'];
				$jsApi->setCode($code);
				$openid = $jsApi->getOpenId();
				$_SESSION['wx_openid'] =$openid;
			}
		}
		
		$notify_url = 'http://'.$_SERVER['SERVER_NAME'].'/wxnotify.php';
		//=========步骤2：使用统一支付接口，获取prepay_id============
		//使用统一支付接口
		$unifiedOrder = new UnifiedOrder_pub($payconf);
		
		 //get order info
		$model = Model('mb_payment');
		$condition['pay_sn'] = $_GET['pay_sn'];
        $condition['order_state'] = ORDER_STATE_NEW;
        $order_list = $model->get_order_detail($condition);
        
        $total_amount = 0;
        $shipping_fee = 0;
        $order_amount = 0;
        $goods_desc  = '';
        $order_sn  = '';
        foreach ($order_list as $row) {
        	$order_amount = $row['order_amount'];
        	$shipping_fee = $row['shipping_fee'];
        	$goods_desc .= $row['goods_name'];
        	$order_sn = $row['order_sn'];
        }
        $goods_desc = $this->my_cus_substr($goods_desc, 20);
		$total_amount =   	(int)($shipping_fee*100 + $order_amount*100);

		
		//设置统一支付接口参数
		//设置必填参数
		//appid已填,商户无需重复填写
		//mch_id已填,商户无需重复填写
		//noncestr已填,商户无需重复填写
		//spbill_create_ip已填,商户无需重复填写
		//sign已填,商户无需重复填写
		$unifiedOrder->setParameter("openid","$openid");//商品描述
		$unifiedOrder->setParameter("body","$goods_desc");//商品描述
		$unifiedOrder->setParameter("out_trade_no","$order_sn");//商户订单号 
		$unifiedOrder->setParameter("total_fee","$total_amount");//总金额
		$unifiedOrder->setParameter("notify_url", $notify_url);//通知地址 
		$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
		//非必填参数，商户可根据实际情况选填
		//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
		//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
		//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
		//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
		//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
		//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
		//$unifiedOrder->setParameter("openid","XXXX");//用户标识
		//$unifiedOrder->setParameter("product_id","XXXX");//商品ID
	
		$prepay_id = $unifiedOrder->getPrepayId();
		//=========步骤3：使用jsapi调起支付============
		$jsApi->setPrepayId($prepay_id);
	
		$jsApiParameters = $jsApi->getParameters();
		$redirect = SHOP_SITE_URL.'/index.php?act=wap_member_order';
		echo <<<EOF
			<html>
				<head>
				    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
				    <title>微信安全支付</title>
				
					<script type="text/javascript">
				
						//调用微信JS api 支付
						function jsApiCall()
						{
							WeixinJSBridge.invoke(
								'getBrandWCPayRequest',
								$jsApiParameters,
								function(res){
									//alert(res.err_msg);
									window.location.href = '$redirect';
								}
							);
						}
				
						function callpay()
						{
							if (typeof WeixinJSBridge == "undefined"){
							    if( document.addEventListener ){
							        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
							    }else if (document.attachEvent){
							        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
							        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
							    }
							}else{
							    jsApiCall();
							}
						}
					</script>
				</head>
				<body style="font-size:12px" onLoad="callpay()"></body>
				</html>
EOF;
    }
	
	function alipayOp() {
		$model = Model('mb_payment');
    	$params = array('payment_code' => 'alipay');
    	$pay = $model->get_payment_info($params);
    	$rt = unserialize($pay['payment_config']);
    	
    	$alipay_config = array(
    		'partner' => $rt['alipay_account'],
    		'seller_id' => $rt['alipay_account'],
    		'private_key_path' => BASE_PATH.DS.'api/alipaywap/key/rsa_private_key.pem',
    		'ali_public_key_path' => BASE_PATH.DS.'api/alipaywap/key/alipay_public_key.pem',
    		'sign_type' => strtoupper('RSA'),
    		'input_charset' => strtolower('utf-8'),
    		'cacert' => BASE_PATH.DS.'api/alipaywap/cacert.pem',
    		'transport' => 'http'
    	); 
		require_once (BASE_PATH.DS.'api/alipaywap/lib/alipay_submit.class.php');
		/**************************请求参数**************************/
		
		//get order info
		$model = Model('mb_payment');
		$condition['pay_sn'] = $_GET['pay_sn'];
        $condition['order_state'] = ORDER_STATE_NEW;
        $order_list = $model->get_order_detail($condition);
        
        $total_amount = 0;
        $shipping_fee = 0;
        $order_amount = 0;
        $goods_desc  = '';
        $order_sn  = '';
        foreach ($order_list as $row) {
        	$order_amount = $row['order_amount'];
        	$shipping_fee = $row['shipping_fee'];
        	$goods_desc .= $row['goods_name'];
        	$order_sn = $row['order_sn'];
        }
        $goods_desc = $this->my_cus_substr($goods_desc, 20);
		$total_amount =   $shipping_fee + $order_amount;
		
		//支付类型
		$payment_type = "1";
		//必填，不能修改
		//服务器异步通知页面路径
		$notify_url = SHOP_SITE_URL.'/api/alipaywap/notify_url.php';
		//需http://格式的完整路径，不能加?id=123这类自定义参数
		//页面跳转同步通知页面路径
		$return_url =  SHOP_SITE_URL.'/api/alipaywap/return_url.php';
		//需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
		//商户订单号
		$out_trade_no = $order_sn;
		//商户网站订单系统中唯一订单号，必填
		//订单名称
		$subject = $goods_desc;
		//必填
		//付款金额
		$total_fee = $total_amount;
		//必填
		//商品展示地址
		$show_url = '';
		//选填，需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html
		//订单描述
		$body = $goods_desc;
		 //选填
		 //超时时间
        $it_b_pay = '';
        //选填
        //钱包token
        $extern_token = '';
        //选填
		/************************************************************/
		//构造要请求的参数数组，无需改动
		$parameter = array ("service" => "alipay.wap.create.direct.pay.by.user", "partner" => trim ( $alipay_config ['partner'] ), "seller_id" => trim ( $alipay_config ['seller_id'] ), "payment_type" => $payment_type, "notify_url" => $notify_url, "return_url" => $return_url, "out_trade_no" => $out_trade_no, "subject" => $subject, "total_fee" => $total_fee, "show_url" => $show_url, "body" => $body, "it_b_pay" => $it_b_pay, "extern_token" => $extern_token, "_input_charset" => trim ( strtolower ( $alipay_config ['input_charset'] ) ) );
		//建立请求
		$alipaySubmit = new AlipaySubmit ( $alipay_config );
		$html_text = $alipaySubmit->buildRequestForm ( $parameter,"get", "");
		echo $html_text;
    }
    
}
