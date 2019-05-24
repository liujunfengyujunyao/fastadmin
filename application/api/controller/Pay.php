<?php
/**
 * Created by PhpStorm.
 * User: GoldenBrother
 * Date: 2019/5/11
 * Time: 13:45
 */

namespace app\api\controller;
use EasyWeChat\QRCode\QRCode;
use think\Db;
use think\Controller;
use app\common\controller\Backend;
header('Access-Control-Allow-Headers: Content-Type,Content-Length,Accept-Encoding,X-Requested-with, Origin, Authorization,access-control-request-headers'); // 设置允许自定义请求头的字段
//header("Access-Control-Max-Age", "1800");
header("Content-Type: text/html;charset=utf-8");
header('Access-Control-Allow-Methods:POST,GET,OPTIONS,DELETE'); // 允许请求的类型
header('Access-Control-Allow-Credentials: true'); // 设置是否允许发送 cookies
//header('Access-Control-Allow-Origin:http://bs.goldenbrother.cn');
header('Access-Control-Allow-Origin:*');
class Pay extends Backend{


    public function __construct(){
        parent::__construct();

        import('yeepay.YopClient3', EXTEND_PATH, '.php');

        $this->parentMerchantNo = '10026912451';//config('parentMerchantNo');
        $this->merchantNo = '10027419272';//config('merchantNo');
        $this->private_key = 'MIIEugIBADANBgkqhkiG9w0BAQEFAASCBKQwggSgAgEAAoIBAQDAVCOCDnslcJceuxavrLswc9WPU9b7yBTVadL8dPVD+Qqpd1xcFQm1FyxIZRbgEAV4MT8oSdhMYqV7bKSyt5PrT9oU5bzJytdJQwxe3eX7WYMldHNv9EHr1uJAQhgWPwqRndRoKHiCxcgy6ps10HGE8Qj0IsAyTL/Og6idcYekVlbVj9w0kotq0kPmRkda0wS8lYD6mH6qq9C36FnEWV3qVKdcO/hJ2AG9e5m75HuAU99BbfwYr0uStZcimpYLtOj0/Cn4v5B//Gthc/Cgf3LJ5FuiKmPKoxfnNoB4TB5ALRcDaovacT7SsMhXFwbfRkt2OfZVYqFtiiuyzUYefU+ZAgMBAAECgf90cn0NQbdN892Lvbr+opazv26OWTTRPVNf47LbJ/VYMnFCKgLBvfsiqeUl8A7pmsm0/BxBSHStywxmrmEJ1By7XJ2uCWtEwouW0AGtbqzQgmHlS5yZLEq9gF18iogK8CB2ChmQ9vAAPb/5FBLlgk85Lrc9Gc1EpzN61jxBF3wJAy/2AL0Q+NYpq6TOWXWoEYFnjQtStq7AaJOh4/K0RhmFvVapyXL4i7fWddWW2jZ//AzIOe5ok5VD7YdxPKXRSxCjlS5JTDVDAZ3KY72i4+oVpeqffF5XR3MdAai+66wHI3eH0QKf6Qz56wyH9yFwSzBEValeWV29SP+MOhjcqI0CgYEA8NxL2kzVh8Kdygkm9pJB3Gxd9ZUPw9oKEdWusZSKLvIs36KPY6qYB5xsF03lmZoe0HvtBLUL03J/D2BVDChHbv2pT5wxKkHU0vkw5ojRiEnMpWbvE6skndeZEA1DD6E4+RSL10siAjXoSKifHzaEu7s1Km30hWqsRBdzXir3gNMCgYEAzGrpqkFnSnQq4sepnL9v247ikjYJi80tly1tjMdkJww9exX1EOSgSMXtXgMof99GUTipFBHe8PRtX4I+yI9K/I4zxRtaYgP+gZ7BVgYe98E6ZNrGD/8LNbJfDbsBwrtYDE/Y23hRbLJOPN/+PocF5LA+uJMuIni1DDfh7MJgymMCgYB+cskHtCqt+UgpVyCzdhlJhULWuQjrwz5iGpJ5/AeHmfBg/9DTfC4QYNiGa4jMWRMwVL8cJ4gr3AJEqkg797F43YbTmqZdDu6SS+yWOuH18PiVJTMCWmkAzL04ph28yOFGMrkvr+wMyQxHiO7wzghlHmVM/yjOGjCSFtWkbF4/rQKBgDI+8VKdIvOFHGmD5GgYEjmopH6F89C+TT+EthHNjQugEZiorAVL/S4GILNkGVddHV6ni7/YKLGXky7Px/jqZ+cuWQFRGOVQ0AUybZlkhcYmY+EYeWjDKxE21/B7EBK6lAjqs4Y2y+To6xxBfrAF5mfw/mnGG6fzfaUUM19L5Bi7AoGAVI8iQ5NP0iZtCdSnQPkjKZMDifwVLwdfcaEjRYop7cfe9IYak+QPC/LQGkjKH5G8t2OAsbC9wExwM3Lhd9DKRBDlqcCPxaTD5Wxq1UDXDcARWarWOpDF7l3Gt7StAsGo9QRb8d0w9CRFLCDzxj1CKGwVz12XfrpL/OdVqtHe/EI=';//config('private_key');
        $this->yop_public_key = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6p0XWjscY+gsyqKRhw9MeLsEmhFdBRhT2emOck/F1Omw38ZWhJxh9kDfs5HzFJMrVozgU+SJFDONxs8UB0wMILKRmqfLcfClG9MyCNuJkkfm0HFQv1hRGdOvZPXj3Bckuwa7FrEXBRYUhK7vJ40afumspthmse6bs6mZxNn/mALZ2X07uznOrrc2rk41Y2HftduxZw6T4EmtWuN2x4CZ8gwSyPAW5ZzZJLQ6tZDojBK4GZTAGhnn3bg5bBsBlw2+FLkCQBuDsJVsFPiGh/b6K/+zGTvWyUcu+LUj2MejYQELDO3i2vQXVDk7lVi2/TcUYefvIcssnzsfCfjaorxsuwIDAQAB';//config('yop_public_key');

        $this->merHmacKey = '877X5o8A1ku3rCG03N0N5587e8l64WA5506K127X08201y777MM04z3D10r1';//config('merHmacKey');

        $this->notifyUrl = 'http://47.104.30.132/callback.php';
    }
    public function test()
    {
        echo 222;

    }
    public function test2()
    {
//        $url = "http://192.168.1.133/yeepay/api/pay";
        $url = "http://192.168.1.144:1161/api/pay/pay";
        $data = [
            'type' => 1,
//                'amount' => $check['order_amount'],
            'amount' => 0.01,
            'goods_name' => "广告",
            'notify' => "http://liujunfeng.imwork.net/ad/client/notify"
//                'notify' =>"http://47429ceb.ngrok.io/ad/client/notify"
        ];
//            halt($data);
        $result = json_curl($url, $data);
        halt($result);
        $arr = json_decode($result, true);
        $url = $arr['url'];
        return $this->qrcode($url);
        halt($arr);
    }

    //申请支付链接
    public function pay(){

        $type = input('post.type');//1支付宝2微信
        $user_id = input('post.userid')?:2;
        $amount = input('post.amount');//订单金额
        $goods_name = input('post.goods_name')?:'goods';
        $payType = array('1'=>'ALIPAY','2'=>'WECHAT');
        $sn = input('post.sn');//设备sn
halt($sn);
        $request = new \YopRequest("OPR:".$this->parentMerchantNo, $this->private_key, "https://open.yeepay.com/yop-center",$this->yop_public_key);

        if($user_id == 1){$user_id = 2;}

        $user = Db::name('wk_user')->where(['id'=>$user_id])->field('user_name,merchant_no,divide_rate')->find();
        if(!$user){
            return json(['status'=>0,'msg'=>'用户不存在']);
        }else{
            $yeepay_in = round(bcmul($amount,0.003,10),2);
            $platform_in = round(bcsub($user['divide_rate'],0.003,10)*$amount,2);
            if($platform_in < 0){
                return json(['status'=>0,'msg'=>'金额计算错误']);
            }
            $user_in = bcsub($amount,bcadd($yeepay_in,$platform_in,10),2);
            $request->addParam("divideDetail",'[{"ledgerNo":"'.$user['merchant_no'].'","ledgerName":"'.$user['user_name'].'", "amount":"'.$user_in.'"}]');
            $request->addParam("fundProcessType", 'SPLIT_ACCOUNT_IN');
        }

        $data=array();
        $data['parentMerchantNo']=$this->parentMerchantNo;
        $data['merchantNo']=$this->merchantNo;
        $data['orderId']=$this->getOrderId();
        $data['orderAmount']=$amount;
        $data['notifyUrl']=$this->notifyUrl;

        $goods = array(
            'goodsName'=>$goods_name,
        );

        $request->addParam("parentMerchantNo", $data['parentMerchantNo']);
        $request->addParam("merchantNo", $data['merchantNo']);
        $request->addParam("orderId", $data['orderId']);
        $request->addParam("orderAmount", $data['orderAmount']);
        $request->addParam("timeoutExpress", 7200);//过期时间 默认72小时， 最小1秒， 最大5年
        $request->addParam("timeoutExpressType", 'SECOND');//过期时间单位：SECOND("秒"), MINUTE("分"), HOUR("时"), DAY("天")
        $request->addParam("requestDate", $this->getDate());
        $request->addParam("notifyUrl", $this->notifyUrl);
        $request->addParam("goodsParamExt", json_encode($goods));
        $request->addParam("hmac", $this->getHmac($data));
        $request->addParam("payTool", 'SCCANPAY');
        $request->addParam("payType", $payType[$type]);
        $request->addParam("userIp", $_SERVER['REMOTE_ADDR']);
        $request->addParam("extParamMap", '{"reportFee":"XIANXIA"}');

        $response = \YopClient3::post("/rest/v1.0/nccashierapi/api/orderpay", $request);

        $result = (array)$response->result;
        if($result['code'] == 'CAS00000'){
            $info = array(
                'user_id'=>$user_id,
                'order_id'=>$data['orderId'],
                'unique_order_id'=>$result['uniqueOrderNo'],
                'type'=>$type,
                'order_amount'=>$data['orderAmount'],
                'goods_title'=>$goods['goodsName'],
                'goods_detail'=>$goods['goodsDesc']?:'',
                'residual_amount'=>$data['orderAmount'],
                'user_in'=>$user_in,
                'platform_in'=>$platform_in,
                'yeepay_in'=>$yeepay_in,
                'divide_rate'=>$user['divide_rate'],
                'add_time'=>time(),
                'update_time'=>time(),
                'sn'=>$sn
            );
            $res = Db::name('wk_order')->insert($info);
            if($res != false){
                return $result['resultData'];
            }
        }else{
            //var_dump($response);
            return json(['status'=>0,'msg'=>'下单失败']);
        }
    }


    //回调
    public function callback(){
        import('yeepay.Util.YopSignUtils', EXTEND_PATH, '.php');

        $source = $_REQUEST["response"];
        $data = \YopSignUtils::decrypt($source,$this->private_key, $this->yop_public_key);

        // $l = 'time:'.date('Y-m-d H:i:s',time()).PHP_EOL.'data:'.$data.PHP_EOL.PHP_EOL;
        // file_put_contents('./callback.log', $l ,FILE_APPEND);

        $data = json_decode($data,true);

        if($data['status'] == 'SUCCESS'){//支付成功
            $res = Db::name('wk_order')->where(['order_id'=>$data['orderId'],'unique_order_id'=>$data['uniqueOrderNo'],'order_status'=>1])->setField('order_status',2);
            echo "SUCCESS";
        }

    }

    public function pay2($type,$amount,$user_id="2",$goods_name="goods",$sn=""){

//        $type = input('post.type');//1支付宝2微信
//        $user_id = input('post.userid')?:2;
//        $amount = input('post.amount');//订单金额
//        $goods_name = input('post.goods_name')?:'goods';
//        $payType = array('1'=>'ALIPAY','2'=>'WECHAT');
//        $sn = input('post.sn');//设备sn

        $payType = array('1'=>'ALIPAY','2'=>'WECHAT');

        $request = new \YopRequest("OPR:".$this->parentMerchantNo, $this->private_key, "https://open.yeepay.com/yop-center",$this->yop_public_key);

        if($user_id == 1){$user_id = 2;}

        $user = Db::name('wk_user')->where(['id'=>$user_id])->field('user_name,merchant_no,divide_rate')->find();
        if(!$user){
            return json(['status'=>0,'msg'=>'用户不存在']);
        }else{
            $yeepay_in = round(bcmul($amount,0.003,10),2);
            $platform_in = round(bcsub($user['divide_rate'],0.003,10)*$amount,2);
            if($platform_in < 0){
                return json(['status'=>0,'msg'=>'金额计算错误']);
            }
            $user_in = bcsub($amount,bcadd($yeepay_in,$platform_in,10),2);
            $request->addParam("divideDetail",'[{"ledgerNo":"'.$user['merchant_no'].'","ledgerName":"'.$user['user_name'].'", "amount":"'.$user_in.'"}]');
            $request->addParam("fundProcessType", 'SPLIT_ACCOUNT_IN');
        }

        $data=array();
        $data['parentMerchantNo']=$this->parentMerchantNo;
        $data['merchantNo']=$this->merchantNo;
        $data['orderId']=$this->getOrderId();
        $data['orderAmount']=$amount;
        $data['notifyUrl']=$this->notifyUrl;

        $goods = array(
            'goodsName'=>$goods_name,
        );

        $request->addParam("parentMerchantNo", $data['parentMerchantNo']);
        $request->addParam("merchantNo", $data['merchantNo']);
        $request->addParam("orderId", $data['orderId']);
        $request->addParam("orderAmount", $data['orderAmount']);
        $request->addParam("timeoutExpress", 7200);//过期时间 默认72小时， 最小1秒， 最大5年
        $request->addParam("timeoutExpressType", 'SECOND');//过期时间单位：SECOND("秒"), MINUTE("分"), HOUR("时"), DAY("天")
        $request->addParam("requestDate", $this->getDate());
        $request->addParam("notifyUrl", $this->notifyUrl);
        $request->addParam("goodsParamExt", json_encode($goods));
        $request->addParam("hmac", $this->getHmac($data));
        $request->addParam("payTool", 'SCCANPAY');
        $request->addParam("payType", $payType[$type]);
        $request->addParam("userIp", $_SERVER['REMOTE_ADDR']);
        $request->addParam("extParamMap", '{"reportFee":"XIANXIA"}');
//dump(2);
        $response = \YopClient3::post("/rest/v1.0/nccashierapi/api/orderpay", $request);
//halt($response);
        $response = json_decode($response,true);
//        halt($response);
        $result = $response['result'];
//halt([$response,$request]);
//        halt($data);
        if($result['code'] == 'CAS00000'){
            $info = array(
                'user_id'=>$user_id,
                'order_id'=>$data['orderId'],
                'unique_order_id'=>$result['uniqueOrderNo'],
                'type'=>$type,
                'order_amount'=>$data['orderAmount'],
                'goods_title'=>$goods['goodsName'],
//                'goods_detail'=>$goods['goodsDesc']?:'',
                'residual_amount'=>$data['orderAmount'],
                'user_in'=>$user_in,
                'platform_in'=>$platform_in,
                'yeepay_in'=>$yeepay_in,
                'divide_rate'=>$user['divide_rate'],
                'add_time'=>time(),
                'update_time'=>time(),
                'sn'=>$sn
            );
//            halt($info);
            $res = Db::name('wk_order')->insert($info);
            if($res != false){
                $return =  ['url' => $result['resultData'],'uniqueOrderNo' => $result['uniqueOrderNo']];
//                return $return;
                $url = urldecode($return['url']);
//                return $url;
//              return $this->makeQrcodeImg($url);
              return $this->qrcode($url);
            }
        }else{
            //var_dump($response);
            return json(['status'=>0,'msg'=>'下单失败']);
        }
    }
    public function qrcode($url)
    {
        vendor('phpqrcode.phpqrcode');
        $object=new \QRcode();
        ob_end_clean();
        $object->png($url,false,3,10,2);
        exit();
    }

//    //回调
//    public function callback(){
//        import('yeepay.Util.YopSignUtils', EXTEND_PATH, '.php');
//
//        $source = $_REQUEST["response"];
//        $data = \YopSignUtils::decrypt($source,$this->private_key, $this->yop_public_key);
//
//        // $l = 'time:'.date('Y-m-d H:i:s',time()).PHP_EOL.'data:'.$data.PHP_EOL.PHP_EOL;
//        // file_put_contents('./callback.log', $l ,FILE_APPEND);
//
//        $data = json_decode($data,true);
//
//        if($data['status'] == 'SUCCESS'){//支付成功
//            $res = Db::name('wk_order')->where(['order_id'=>$data['orderId'],'unique_order_id'=>$data['uniqueOrderNo'],'order_status'=>1])->setField('order_status',2);
//            echo "SUCCESS";
//        }
//
//    }






    public function getOrderId(){
        date_default_timezone_set('Asia/Shanghai');
        $orderId = "DS" . date("ymd_His") . rand(10, 99);
        return $orderId;
    }


    public function getDate(){
        $date = date('Y-m-d H:i:s',time());
        return $date;
    }


    public function getHmac($data){

        $hmacstr = hash_hmac('sha256', $this->toString($data), $this->merHmacKey, true);
        $hmac = bin2hex($hmacstr);

        return $hmac;
    }


    //将参数转换成k=v拼接的形式
    public function toString($arraydata){
        $Str="";
        foreach ($arraydata as $k=>$v){
            $Str .= strlen($Str) == 0 ? "" : "&";
            $Str.=$k."=".$v;
        }
        return $Str;
    }
    //接收支付回调信息
    public function notify()
    {   //私钥
        $private_Key = "MIIEugIBADANBgkqhkiG9w0BAQEFAASCBKQwggSgAgEAAoIBAQDAVCOCDnslcJceuxavrLswc9WPU9b7yBTVadL8dPVD+Qqpd1xcFQm1FyxIZRbgEAV4MT8oSdhMYqV7bKSyt5PrT9oU5bzJytdJQwxe3eX7WYMldHNv9EHr1uJAQhgWPwqRndRoKHiCxcgy6ps10HGE8Qj0IsAyTL/Og6idcYekVlbVj9w0kotq0kPmRkda0wS8lYD6mH6qq9C36FnEWV3qVKdcO/hJ2AG9e5m75HuAU99BbfwYr0uStZcimpYLtOj0/Cn4v5B//Gthc/Cgf3LJ5FuiKmPKoxfnNoB4TB5ALRcDaovacT7SsMhXFwbfRkt2OfZVYqFtiiuyzUYefU+ZAgMBAAECgf90cn0NQbdN892Lvbr+opazv26OWTTRPVNf47LbJ/VYMnFCKgLBvfsiqeUl8A7pmsm0/BxBSHStywxmrmEJ1By7XJ2uCWtEwouW0AGtbqzQgmHlS5yZLEq9gF18iogK8CB2ChmQ9vAAPb/5FBLlgk85Lrc9Gc1EpzN61jxBF3wJAy/2AL0Q+NYpq6TOWXWoEYFnjQtStq7AaJOh4/K0RhmFvVapyXL4i7fWddWW2jZ//AzIOe5ok5VD7YdxPKXRSxCjlS5JTDVDAZ3KY72i4+oVpeqffF5XR3MdAai+66wHI3eH0QKf6Qz56wyH9yFwSzBEValeWV29SP+MOhjcqI0CgYEA8NxL2kzVh8Kdygkm9pJB3Gxd9ZUPw9oKEdWusZSKLvIs36KPY6qYB5xsF03lmZoe0HvtBLUL03J/D2BVDChHbv2pT5wxKkHU0vkw5ojRiEnMpWbvE6skndeZEA1DD6E4+RSL10siAjXoSKifHzaEu7s1Km30hWqsRBdzXir3gNMCgYEAzGrpqkFnSnQq4sepnL9v247ikjYJi80tly1tjMdkJww9exX1EOSgSMXtXgMof99GUTipFBHe8PRtX4I+yI9K/I4zxRtaYgP+gZ7BVgYe98E6ZNrGD/8LNbJfDbsBwrtYDE/Y23hRbLJOPN/+PocF5LA+uJMuIni1DDfh7MJgymMCgYB+cskHtCqt+UgpVyCzdhlJhULWuQjrwz5iGpJ5/AeHmfBg/9DTfC4QYNiGa4jMWRMwVL8cJ4gr3AJEqkg797F43YbTmqZdDu6SS+yWOuH18PiVJTMCWmkAzL04ph28yOFGMrkvr+wMyQxHiO7wzghlHmVM/yjOGjCSFtWkbF4/rQKBgDI+8VKdIvOFHGmD5GgYEjmopH6F89C+TT+EthHNjQugEZiorAVL/S4GILNkGVddHV6ni7/YKLGXky7Px/jqZ+cuWQFRGOVQ0AUybZlkhcYmY+EYeWjDKxE21/B7EBK6lAjqs4Y2y+To6xxBfrAF5mfw/mnGG6fzfaUUM19L5Bi7AoGAVI8iQ5NP0iZtCdSnQPkjKZMDifwVLwdfcaEjRYop7cfe9IYak+QPC/LQGkjKH5G8t2OAsbC9wExwM3Lhd9DKRBDlqcCPxaTD5Wxq1UDXDcARWarWOpDF7l3Gt7StAsGo9QRb8d0w9CRFLCDzxj1CKGwVz12XfrpL/OdVqtHe/EI=";
        //公钥
        $public_Key = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA6p0XWjscY+gsyqKRhw9MeLsEmhFdBRhT2emOck/F1Omw38ZWhJxh9kDfs5HzFJMrVozgU+SJFDONxs8UB0wMILKRmqfLcfClG9MyCNuJkkfm0HFQv1hRGdOvZPXj3Bckuwa7FrEXBRYUhK7vJ40afumspthmse6bs6mZxNn/mALZ2X07uznOrrc2rk41Y2HftduxZw6T4EmtWuN2x4CZ8gwSyPAW5ZzZJLQ6tZDojBK4GZTAGhnn3bg5bBsBlw2+FLkCQBuDsJVsFPiGh/b6K/+zGTvWyUcu+LUj2MejYQELDO3i2vQXVDk7lVi2/TcUYefvIcssnzsfCfjaorxsuwIDAQAB";
        $source = $_REQUEST["response"];
        $json = decrypt($source, $private_Key, $public_Key);
        $data = json_decode($json, true);

        Db::name('wk_order')->where(['unique_order_id' => $data['uniqueOrderNo'], 'order_status' => 1])->update('order_status', 2);
//        Db::name('ad_order')->where(['unique_order_id' => $data['uniqueOrderNo']])->save(['status' => 1]);
        $check_id = DB::name('ad_order')->where(['unique_order_id' => $data['uniqueOrderNo']])->getField('check_id');
        DB::name('ad_check')->where(['id' => $check_id])->save(['is_pay' => 1]);
        $this->check_time($check_id);//扣除时间
        $this->send_msg($check_id);//发送协议
        $log = 'time:' . date('Y-m-d H:i:s', time()) . PHP_EOL . 'data:' . $json . PHP_EOL . PHP_EOL;
        file_put_contents('./callback.log', $log, FILE_APPEND);
        echo "SUCCESS";

    }

}