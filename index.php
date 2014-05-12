<?php
/**
 * php curl登陆开源中国
 * @author yearnfar
 */
define(SELF_PATH, realpath(dirname(__FILE__)));

$useragent = $_SERVER['HTTP_USER_AGENT'];

$postdata = http_build_query(array(
	'email' => 'hongbo819@163.com',
	'pwd'=> sha1('hong526566') ,
	'save_login'=>1 ));
//exit($postdata);
//cookies保存路径
is_dir(SELF_PATH.'/cookies') or mkdir(SELF_PATH.'/cookies');
$cookiejar = tempnam(SELF_PATH."/cookies/", "cookie");

$url = array(
	0=>	'https://www.oschina.net/action/user/hash_login',
	1=>	'http://my.oschina.net/yearnfar',
	2=>	'https://www.oschina.net/home/login',
	);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url[0]);
curl_setopt($ch, CURLOPT_TIMEOUT , 10);	//curl执行最长时间（秒）
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_SSLVERSION,3); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_PORT , 80);		//连接端口
curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
curl_setopt($ch, CURLOPT_POST, true);	//提交的数据 
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);	//提交的数据
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiejar);	//保存cookie信息 

$data = curl_exec($ch);
curl_close($ch);
//print_r($data);
//exit();

$ch = curl_init($url[1]);
curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //https
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiejar);

$contents = curl_exec($ch);
curl_close($ch);
var_dump(file_get_contents($cookiejar));exit;
echo $contents;exit;
print_r($contents);  