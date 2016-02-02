<?php
defined('InUk86') or exit('Access Invalid!');
define('NODE_SITE_URL','http://'.$_SERVER['SERVER_NAME'].':8090');
define('CHAT_SITE_URL','http://'.$_SERVER['SERVER_NAME'].'/uk86/chat');

define('CHAT_TEMPLATES_URL',CHAT_SITE_URL.'/templates/default');
define('CHAT_RESOURCE_URL',CHAT_SITE_URL.'/resource');