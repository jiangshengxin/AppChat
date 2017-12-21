<?php
header("content-type:text/html;charset=utf-8");

#判断是否是IS_POST请求
defined('IS_POST') OR define('IS_POST',strtoupper($_SERVER['REQUEST_METHOD']=='POST')?TRUE:FALSE);

#判断是否是IS_AJAX请求
defined('IS_AJAX') OR define('IS_AJAX',isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'?true:false);

#判断是否是IS_GET请求
defined("IS_GET") OR define('IS_GET',strtoupper($_SERVER['REQUEST_METHOD']=='GET')?TRUE:FALSE);

class XIN
{

    /*
     * 字符串加密
     * @$data 要加密的字符串
     * @$key 密钥
     * 返回加密后的字符串
     * */
    static public function encode($DATA, $KEY = 'JiangShengXin'){
        /*
         * 加密数据
         * @$str 要加密的字符串
         * @method 有效密码方式
         * @password 密钥
         * @options 默认0
         * @$iv 非 NULL 的初始化向量(长度为16)
         * */
        $IV = 'abcjiangshengxin';
        $openssl_encrypt = openssl_encrypt(json_encode($DATA),'AES-128-CBC',$KEY,0,$IV);
        return str_replace(array('=', '+', '/'), array('O0O0O', 'i000l', 'ooiio'),$openssl_encrypt);

        /*$key= md5($key);
        $x= 0;
        $len =strlen($data);
        $l= strlen($key);
        $char = '';
        $str = '';
        for($i = 0; $i < $len; $i++) {
            if ($x == $l){
                $x = 0;
            }
            $char .= $key{$x};
            $x++;
        }
        for ($i = 0; $i < $len; $i++){
            $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
        }
        return str_replace(array('=', '+', '/'), array('O0O0O', 'i000l', 'ooiio'), base64_encode($str));*/
    }

    /*
     * 字符串解密
     * @$data 要解密的字符串
     * @$ket 解密钥匙
     * 返回 解密后的字符串
     * */
    static public function decode($DATA, $KEY= 'JiangShengXin') {

        /*
         * 解密数据
         * @$encrypt_str 要解密的字符串
         * @method 有效密码方式
         * @password 密钥
         * @options 默认0
         * @$iv 非 NULL 的初始化向量(长度为16)
         * */
        $IV = 'abcjiangshengxin';
        $DATA = str_replace(array('O0O0O', 'i000l', 'ooiio'),array('=', '+', '/'),$DATA);
        $decrypt_str = openssl_decrypt($DATA,'AES-128-CBC',$KEY,0,$IV);
        return json_decode($decrypt_str,true);

        /*$data = str_replace(array('O0O0O', 'i000l', 'ooiio'), array('=', '+', '/'), $data);
        $key = md5($key);
        $x = 0;
        $data = base64_decode($data);
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        $str = '';
        for ($i = 0; $i < $len; $i++){
            if ($x == $l){
                $x = 0;
            }
            $char .= substr($key, $x, 1);
            $x++;
        }
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))){
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
            }else {
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
            }
        }
        return $str;*/
    }

    /*
     * #将Xml强制性转化为数组
     * @$xml 是一个xml格式的字符串
     * 返回一个数组
     * */
    static public function xmlToArray($xml){
        if(is_string($xml))
        {
            //XML 字符串载入对象中
            $sim = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        }
        $arr = (array) $sim;
        foreach ($arr as $k => $v) {
            if($v instanceof SimpleXMLElement || is_array($v)){
                $arr[$k] = self::xmlToArray($v);
            }
        }
        return $arr;
    }


    /*
     * xml递归创建方法
     * @$array 是一个数据
     * @$sim_obj 自定义xml头,可不填
     * 返回一个xml字符串
     * */
    static public function arrTurnXml($array,$sim_obj=''){
        if($sim_obj === ''){
            $sim = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><body></body>');
        }else{
            $sim = $sim_obj;
        }
        foreach ($array as $k => $v) {
            if(is_numeric($k)){
                $k = 'item';
            }
            if(is_array($v)){
                self::arrTurnXml($v,$sim->addChild($k));
            }else{
                $sim->addChild($k,$v);
            }
        }
        return $sim->saveXml();
    }

    /*
   * curl发送数据封装
   * $url: 地址
   * $data: 数组形式的post数据
   * $json: 是否以json方式提交(1: 是, 0:否)
   * 返回 成功: true    失败:错误原因
   * */
    static public function curl($url,$data=null,$json = false)
    {
        $curl = curl_init();
        //访问地址
        curl_setopt($curl,CURLOPT_URL,$url);
        //证书
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        if(!empty($data))
        {
            //发送json格式的数据
            if($json && is_array($data))
            {
                $data = json_encode($data);
            }
        }
        //设置post传值
        curl_setopt($curl,CURLOPT_POST,1);
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        if($json)
        {
            //设置header头
            curl_setopt($curl,CURLOPT_HEADER,0);
            curl_setopt($curl,CURLOPT_HTTPHEADER,[
                'Content-Type: application/json; charset=utf-8',
                'Content-Length:' . strlen($data)
            ]);
        }
        //设为不输出
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        //执行
        $return = curl_exec($curl);
        //获取最后错误
        $error = curl_errno($curl);
        //关闭
        curl_close($curl);
        if($error)
        {
            return['error'=>false,'errmsg'=>$error];
        }
        return $return;
    }

    /*
     * 异常错误函数
     * try
     * {
     *      echo $a;
     * }catch (Exception $E)
     * {
     *      XIN::try_catch($E);
     * }
     * */
    static public function try_catch($E)
    {
        $Trace = $E->getTrace();
        $SERVER = $Trace[0]['args'][4]['_SERVER'];
        $SERVER_time = date('Y-m-d H:i:s',$SERVER['REQUEST_TIME']).substr($SERVER['REQUEST_TIME_FLOAT'],stripos($SERVER['REQUEST_TIME_FLOAT'],'.'));
        echo
        <<<HTML
    <table style="font-size: 12px;" border="1" cellspacing="0" width="100%">
    <tr>
    <td colspan="2" style="text-align: center"><font color="red" style="font-size: 13px; font-weight: 800">错误信息收集 </font></td>
    </tr>
    <tr>
    <td>异常文件名</td>
    <td>{$E->getFile()}</td>
    </tr>
    <tr>
    <td>异常的代码在文件中的行号</td>
    <td>{$E->getLine()}</td>
    </tr>
    <tr>
    <td>异常消息原因</td>
    <td>{$E->getMessage()}</td>
    </tr>
    <tr>
    <td>异常追踪信息</td>
    <td>{$E->getTraceAsString()}</td>
    </tr>
    <tr>
    <td>在php解析中的异常代码</td>
    <td>{$E->getCode()}</td>
    </tr>
    <tr>
    <td>异常链中的前一个异常</td>
    <td>{$E->getPrevious()}</td>
    </tr>
    <tr>
    <td>异常时间</td>
    <td>{$SERVER_time}</td>
    </tr>
    <tr>
    <td>域名</td>
    <td>{$SERVER['HTTP_HOST']}</td>
    </tr>
    <tr>
    <td>客户端浏览器</td>
    <td>{$SERVER['HTTP_USER_AGENT']}</td>
    </tr>
    <tr>
    <td>用户的 IP 地址</td>
    <td>{$SERVER['REMOTE_ADDR']}</td>
    </tr>
    <tr>
    <td>服务器的 IP 地址</td>
    <td>{$SERVER['SERVER_ADDR']}</td>
    </tr>
    <tr>
    <td>脚本所在的服务器的主机名</td>
    <td>{$SERVER['SERVER_NAME']}</td>
    </tr>
    <tr>
    <td>响应请求时的头信息(服务器标识)</td>
    <td>{$SERVER['SERVER_SOFTWARE']}</td>
    </tr>
    <tr>
    <td>页面时通信协议的名称和版本</td>
    <td>{$SERVER['SERVER_PROTOCOL']}</td>
    </tr>
    <tr>
    <td>页面请求方法</td>
    <td>{$SERVER['REQUEST_METHOD']}</td>
    </tr>
    <tr>
    <td>查询字符串</td>
    <td>{$SERVER['QUERY_STRING']}</td>
    </tr>
    <tr>
    <td>请求头中 Accept 项的内容</td>
    <td>{$SERVER['HTTP_ACCEPT']}</td>
    </tr>
    </table>
HTML;
    }

}

#打印函数
function P($value,$type= false)
{
    echo '<pre>';
    if($type||$value==false||@strlen($value)==1)
    {
        var_dump($value);
    }else
    {
        print_r($value);
    }
}






/******
 * User: 降省心
 * QQ:1348550820
 * Website: http://www.hanfu8.top
 * Date: 2017/8/28
 * Time: 17:22
 ******/
