<?php
	/**
	 * desc   无限极分类目录树
	 * date   2014年12月14日
	 * @param $items 多为数组
	 * @param $id 
	 * @param $pid
	 * @param $son
	 * @return array
	 */
	function genTree($items, $id='id',$pid='pid', $son = 'child'){
		$tree = array(); //格式化的树
		$tmpMap = array();  //临时扁平数据
		foreach ($items as $item) {
			$tmpMap[$item[$id]] = $item;
		}
		
		foreach ($items as $item) {
			if (isset($tmpMap[$item[$pid]])) {
				$tmpMap[$item[$pid]][$son][] = &$tmpMap[$item[$id]];
			} else {
				$tree[] = &$tmpMap[$item[$id]];
			}
		}
		return $tree;
	}


	//exportExcel函数类
    function exportExcel($fileName,$headArr,$data){
        //导入PHPExcel类库
        vendor("PHPExcel");
        vendor("PHPExcel.Writer.Excel2007");
        vendor("PHPExcel.IOFactory.php");

        $date = date("Y_m_d",time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        //print_r($headArr);exit;
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();

        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }

/**
     * 邮件发送函数
     */
    function sendMail($to, $title, $content) {
        Vendor('PHPMailer.PHPMailerAutoload');     
        $mail = new PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
        $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
        $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
        $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
        $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
        $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
        $mail->AddAddress($to,"您好");
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
        $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
        $mail->Subject =$title; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
        return($mail->Send());

        //临时解决邮箱发送邮件问题
        //getHttpResponseGET("http://code.yaopengtao.com/2016/maill/sendmail.php?to={$to}&title={$title}&content={$content}");
        //return true;
    }


/**
     * 加密
     */
    function encrypt($data, $key = "kefu_qianfeng")  
    {  
        $key    =   md5($key);  
        $x      =   0;  
        $len    =   strlen($data);  
        $l      =   strlen($key);  
        for ($i = 0; $i < $len; $i++)  
        {  
            if ($x == $l)   
            {  
                $x = 0;  
            }  
            $char .= $key{$x};  
            $x++;  
        }  
        for ($i = 0; $i < $len; $i++)  
        {  
            $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);  
        }  
        return base64_encode($str);  
    } 

    /**
     * 解密
     */ 

    function decrypt($data, $key = "kefu_qianfeng")  
    {  
        $key = md5($key);  
        $x = 0;  
        $data = base64_decode($data);  
        $len = strlen($data);  
        $l = strlen($key);  
        for ($i = 0; $i < $len; $i++)  
        {  
            if ($x == $l)   
            {  
                $x = 0;  
            }  
            $char .= substr($key, $x, 1);  
            $x++;  
        }  
        for ($i = 0; $i < $len; $i++)  
        {  
            if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))  
            {  
                $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));  
            }  
            else  
            {  
                $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));  
            }  
        }  
        return $str;  
    }


/**
 * 签名字符串
 * @param $prestr 需要签名的字符串
 * @param $key 私钥
 * return 签名结果
 */
function md5Sign($prestr, $key = 'lizongyang.com') {
    $prestr = $prestr . $key;
    return md5($prestr);
}

/**
 * 验证签名
 * @param $prestr 需要签名的字符串
 * @param $sign 签名结果
 * @param $key 私钥
 * return 签名结果
 */
function md5Verify($prestr, $sign, $key = 'lizongyang.com') {
    $prestr = $prestr . $key;
    $mysgin = md5($prestr);
    echo $mysgin;

    echo "<br>";

    echo $sign;

    if($mysgin == $sign) {
        return true;
    }
    else {
        return false;
    }
}


/** 
 * @desc PHPEXCEL导入
 * return array();
 */
 function importExcel($file)
{
    vendor("PHPExcel");
    //$PHPExcel=new \PHPExcel();
    list(,,$ext)=explode('.',$file);
    //如果excel文件后缀名为.xls，导入这个类
    if($ext=='xls'){
         vendor("PHPExcel.Reader.Excel5");
         $objReader=new \PHPExcel_Reader_Excel5();
         //如果excel文件后缀名为.xlsx，导入这个类
    }else if($ext=='xlsx'){
        vendor("PHPExcel.Reader.Excel2007");
        $objReader=new \PHPExcel_Reader_Excel2007();
    }
    //$objReader = PHPExcel_IOFactory::createReader('Excel5');//use Excel2007 for 2007 format 
    $objPHPExcel = $objReader->load($file); 
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow(); // 取得总行数 
    $highestColumn = $sheet->getHighestColumn(); // 取得总列数
    $objWorksheet = $objPHPExcel->getActiveSheet();

    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);  
    $excelData = array();  
    for ($row = 1; $row <= $highestRow; $row++) {  
        for ($col = 0; $col < $highestColumnIndex; $col++) {  
            $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();  
        }  
    }
    return $excelData;  
}

/**
     * 计算二维数组某个值的合
     */
    function multi_array_sum($arr,  $key, $keys = '')
    {
        
        if ($arr)
        {
            $sum_no = 0;
            
            foreach($arr as $v)
            {
               if ($keys)
               {
                    $sum_no +=  $v[$key][$keys];
               } else {
                    $sum_no +=  $v[$key];
               }
            }
            return $sum_no;
        } else {
            return 0;
        }
        
    }
/*
     * 模板字符串截取不乱码
     * yankee
     * 2016 4 6
     * */

    function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true)
    {
        if(function_exists("mb_substr")){
            if($suffix)
                return mb_substr($str, $start, $length, $charset)."...";
            else
                return mb_substr($str, $start, $length, $charset);
        }
        elseif(function_exists('iconv_substr')) {
            if($suffix)
                return iconv_substr($str,$start,$length,$charset)."...";
            else
                return iconv_substr($str,$start,$length,$charset);
        }
        $re['utf-8']   = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef]
                      [x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
        $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
        $re['gbk']    = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
        $re['big5']   = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
        if($suffix) return $slice."…";
        return $slice;
    }


 /**
 * 下载文本文件
 * @return string
 */
function sendFile($str){
    $len = strlen($str);
    $name = "qfile.txt";
    ob_end_clean();
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", FALSE);
    header("Pragma: no-cache");
    header("Content-Type: application/octet-stream");
    header("Content-Length: ".(string)($len));
    header("Content-Disposition: inline; filename=$name");
    header("Content-Transfer-Encoding: binary\n");
    print($str);
    flush();
}

/**
 * 获取二级域名
 * @return string
 */
function get_domain2()
{
    $domain     = $_SERVER['HTTP_HOST'];
    $domain_arr = explode('.',$domain);
    $count      = count($domain_arr);
    if ($count < 3)
    {
        return 'www';
    }
    return $domain_arr[0];
}

/**
 * 获取一级域名
 * @return string
 */
function get_host_domain($url)
{
    $url  = 'http://' . str_replace('http://', '', $url);

    $data = parse_url($url);
    $data = $data['host'];
    $data = explode('.', $data);
    $data = $data[count($data) - 2] . '.' . $data[count($data) - 1];
    return $data;
}

/**
 * 获取一级域名后缀
 * @return string
 */
function get_domain_suffix($domain)
{
    $arr = explode(".", get_host_domain($domain));
    return $arr[1];
}

/**
 * 获取一级域名长度
 * @return string
 */
function domain_length($domain)
{
    $arr = explode(".", get_host_domain($domain));
    return strlen($arr[0]);
}

////获得访客浏览器类型
  function GetBrowser(){
   if(!empty($_SERVER['HTTP_USER_AGENT'])){
    $br = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/MSIE/i',$br)) {    
               $br = 'MSIE';
             }elseif (preg_match('/Firefox/i',$br)) {
     $br = 'Firefox';
    }elseif (preg_match('/Chrome/i',$br)) {
     $br = 'Chrome';
       }elseif (preg_match('/Safari/i',$br)) {
     $br = 'Safari';
    }elseif (preg_match('/Opera/i',$br)) {
        $br = 'Opera';
    }else {
        $br = 'Other';
    }
    return $br;
   }else{return "None";} 
  }
  
  ////获得访客浏览器语言
  function GetLang(){
   if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
    $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
    $lang = substr($lang,0,5);
    if(preg_match("/zh-cn/i",$lang)){
     $lang = "简体中文";
    }elseif(preg_match("/zh/i",$lang)){
     $lang = "繁体中文";
    }else{
        $lang = "English";
    }
    return $lang;
    
   }else{return "None";}
  }
  
   ////获取访客操作系统
  function GetOs(){
   if(!empty($_SERVER['HTTP_USER_AGENT'])){
    $OS = $_SERVER['HTTP_USER_AGENT'];
      if (preg_match('/win/i',$OS)) {
     $OS = 'Windows';
    }elseif (preg_match('/mac/i',$OS)) {
     $OS = 'MAC';
    }elseif (preg_match('/linux/i',$OS)) {
     $OS = 'Linux';
    }elseif (preg_match('/unix/i',$OS)) {
     $OS = 'Unix';
    }elseif (preg_match('/bsd/i',$OS)) {
     $OS = 'BSD';
    }else {
     $OS = 'Other';
    }
          return $OS;  
   }else{return "None";}   
  }

  //获取完整的url
  function get_full_url()
  {
     return "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
  }

// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/* 
*function：计算两个日期相隔多少年，多少月，多少天 
*param string $date1[格式如：2011-11-5] 
*param string $date2[格式如：2012-12-01] 
*return array array('年','月','日'); 
*/  
function diffDate($date1,$date2){  
    if(strtotime($date1)>strtotime($date2)){  
        $tmp=$date2;  
        $date2=$date1;  
        $date1=$tmp;  
    }  
    list($Y1,$m1,$d1)=explode('-',$date1);  
    list($Y2,$m2,$d2)=explode('-',$date2);  
    $Y=$Y2-$Y1;  
    $m=$m2-$m1;  
    $d=$d2-$d1;  
    if($d<0){  
        $d+=(int)date('t',strtotime("-1 month $date2"));  
        $m--;  
    }  
    if($m<0){  
        $m+=12;  
        $y--;  
    }  
    return array('year'=>$Y,'month'=>$m,'day'=>$d);  
} 

// 路由URL
function detaurl($type,$id){
    if($id)
    {
        return "/$type/{$id}";
    }else{
        return '';
    }
}
  
/**
 * 删除目录及目录下所有文件或删除指定文件
 * @param str $path   待删除目录路径
 * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
 * @return bool 返回删除状态
 */
 function delDirAndFile($path, $delDir = FALSE) {
   $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
 }

// 获取ip
function ip(){ 
if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) { 
    $ip = getenv('HTTP_CLIENT_IP'); 
}elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')){ 
    $ip = getenv('HTTP_X_FORWARDED_FOR'); 
}elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')){ 
    $ip = getenv('REMOTE_ADDR'); 
}elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')){ 
    $ip = $_SERVER['REMOTE_ADDR']; 
} 
    
    return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : 'unknown'; 
} 


 ////根据ip获得访客所在地地名
 function Getaddress($ip=''){
  if(empty($ip)){
      $ip = ip();    
  }
  $ipadd = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?ip=".$ip);//根据新浪api接口获取
  if($ipadd){
   $charset = iconv("gbk","utf-8",$ipadd);   
   preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$charset,$ipadds);
   return $ipadds;   //返回一个二维数组
  }else{
    return "addree is none";
    }  
 } 

  
//处理方法
function rmdirr($dirname) {
    if (!file_exists($dirname)) {
        return false;
    }
    if (is_file($dirname) || is_link($dirname)) {
        return unlink($dirname);
    }
    $dir = dir($dirname);
    if ($dir) {
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            //递归
            rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
        }
    }
}

//公共函数
//获取文件修改时间
function getfiletime($file, $DataDir) {
    $a = filemtime($DataDir . $file);
    $time = date("Y-m-d H:i:s", $a);
    return $time;
}

//获取文件的大小
function getfilesize($file, $DataDir) {
    $perms = stat($DataDir . $file);
    $size = $perms['size'];
    // 单位自动转换函数
    $kb = 1024;         // Kilobyte
    $mb = 1024 * $kb;   // Megabyte
    $gb = 1024 * $mb;   // Gigabyte
    $tb = 1024 * $gb;   // Terabyte

    if ($size < $kb) {
        return $size . " B";
    } else if ($size < $mb) {
        return round($size / $kb, 2) . " KB";
    } else if ($size < $gb) {
        return round($size / $mb, 2) . " MB";
    } else if ($size < $tb) {
        return round($size / $gb, 2) . " GB";
    } else {
        return round($size / $tb, 2) . " TB";
    }
}


 


