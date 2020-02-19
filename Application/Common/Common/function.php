<?php
/**
 * Passport 加密函数
 *
 * @param        string          等待加密的原字串
 * @param        string          私有密匙(用于解密和加密)
 *
 * @return       string          原字串经过私有密匙加密后的结果
 */

function encrypt($txt, $key = '_qscms') {
    // 使用随机数发生器产生 0~32000 的值并 MD5()
    srand((double)microtime() * 1000000);
    $encrypt_key = md5(rand(0, 32000));
    // 变量初始化
    $ctr = 0;
    $tmp = '';
    // for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
    for($i = 0; $i < strlen($txt); $i++) {
        // 如果 $ctr = $encrypt_key 的长度，则 $ctr 清零
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        // $tmp 字串在末尾增加两位，其第一位内容为 $encrypt_key 的第 $ctr 位，
        // 第二位内容为 $txt 的第 $i 位与 $encrypt_key 的 $ctr 位取异或。然后 $ctr = $ctr + 1
        $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
    }
    // 返回结果，结果为 passport_key() 函数返回值的 base64 编码结果
    return base64_encode(passport_key($tmp, $key));
}

/**
 * Passport 解密函数
 *
 * @param        string          加密后的字串
 * @param        string          私有密匙(用于解密和加密)
 *
 * @return       string          字串经过私有密匙解密后的结果
 */
function decrypt($txt, $key = '_qscms') {
    // $txt 的结果为加密后的字串经过 base64 解码，然后与私有密匙一起，
    // 经过 passport_key() 函数处理后的返回值
    $txt = passport_key(base64_decode($txt), $key);
    // 变量初始化
    $tmp = '';
    // for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
    for ($i = 0; $i < strlen($txt); $i++) {
        // $tmp 字串在末尾增加一位，其内容为 $txt 的第 $i 位，
        // 与 $txt 的第 $i + 1 位取异或。然后 $i = $i + 1
        $tmp .= $txt[$i] ^ $txt[++$i];
    }
    // 返回 $tmp 的值作为结果
    return $tmp;
}
/**
 * Passport 密匙处理函数
 *
 * @param        string          待加密或待解密的字串
 * @param        string          私有密匙(用于解密和加密)
 *
 * @return       string          处理后的密匙
 */
function passport_key($txt, $encrypt_key) {
    // 将 $encrypt_key 赋为 $encrypt_key 经 md5() 后的值
    $encrypt_key = md5($encrypt_key);
    // 变量初始化
    $ctr = 0;
    $tmp = '';
    // for 循环，$i 为从 0 开始，到小于 $txt 字串长度的整数
    for($i = 0; $i < strlen($txt); $i++) {
        // 如果 $ctr = $encrypt_key 的长度，则 $ctr 清零
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        // $tmp 字串在末尾增加一位，其内容为 $txt 的第 $i 位，
        // 与 $encrypt_key 的第 $ctr + 1 位取异或。然后 $ctr = $ctr + 1
        $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
    }
    // 返回 $tmp 的值作为结果
    return $tmp;
}

function addslashes_deep($value) {
    $value = is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
    return $value;
}

function stripslashes_deep($value) {
    if (is_array($value)) {
        $value = array_map('stripslashes_deep', $value);
    } elseif (is_object($value)) {
        $vars = get_object_vars($value);
        foreach ($vars as $key => $data) {
            $value->{$key} = stripslashes_deep($data);
        }
    } else {
        $value = stripslashes($value);
    }
    return $value;
}

function todaytime() {
    return mktime(0, 0, 0, date('m'), date('d'), date('Y'));
}

/**
 * 友好时间
 */
function sub_day($endday,$staday,$range=''){
    $value = $endday - $staday;
    if($value < 0){
        return '';
    }elseif($value >= 0 && $value < 59){
        return ($value+1)."秒";
    }elseif($value >= 60 && $value < 3600){
        $min = intval($value / 60);
        return $min."分钟";
    }elseif($value >=3600 && $value < 86400){
        $h = intval($value / 3600);
        return $h."小时";
    }elseif($value >= 86400 && $value < 86400*30){
        $d = intval($value / 86400);
        return intval($d)."天";
    }elseif($value >= 86400*30 && $value < 86400*30*12){
        $mon  = intval($value / (86400*30));
        return $mon."月";
    }else{   
        $y = intval($value / (86400*30*12));
        return $y."年";
    }
}

function strip_textarea($string){
   return nl2br(str_replace(' ', '&nbsp;', htmlspecialchars($string, ENT_QUOTES)));
}

/**
 * 时间格式变换
 */
function daterange($endday,$staday,$format='Y-m-d',$color='',$range=3){
    $value = $endday - $staday;
    if($value < 0){
        return '';
    }elseif($value >= 0 && $value < 59){
        $return=($value+1)."秒前";
    }elseif($value >= 60 && $value < 3600){
        $min = intval($value / 60);
        $return=$min."分钟前";
    }elseif($value >=3600 && $value < 86400){
        $h = intval($value / 3600);
        $return=$h."小时前";
    }elseif($value >= 86400){
        $d = intval($value / 86400);
        if ($d>$range){
            return date($format,$staday);
        }else{
            $return=$d."天前";
        }
    }
    if($color){
    $return="<span id=\"r_time\" style=\"color:{$color}\">".$return."</span>";
    }
    return $return;  
}

/**
 * 友好时间
 */
function fdate($time) {
    if (!$time) return false;
    $fdate = '';
    $d = time() - intval($time);
    $ld = time() - mktime(0, 0, 0, 0, 0, date('Y')); //年
    $md = time() - mktime(0, 0, 0, date('m'), 0, date('Y')); //月
    $byd = time() - mktime(0, 0, 0, date('m'), date('d') - 2, date('Y')); //前天
    $yd = time() - mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')); //昨天
    $dd = time() - mktime(0, 0, 0, date('m'), date('d'), date('Y')); //今天
    $td = time() - mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')); //明天
    $atd = time() - mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')); //后天
    if ($d == 0) {
        $fdate = '刚刚';
    } else {
        switch ($d) {
            case $d < $atd:
                $fdate = date('Y年m月d日 H:i', $time);
                break;
            case $d < $td:
                $fdate = '后天' . date('H:i', $time);
                break;
            case $d < 0:
                $fdate = '明天' . date('H:i', $time);
                break;
            case $d < 60:
                $fdate = $d . '秒前';
                break;
            case $d < 3600:
                $fdate = floor($d / 60) . '分钟前';
                break;
            case $d < $dd:
                $fdate = '今天' . date('H:i', $time);
                break;
            case $d < $yd:
                $fdate = '昨天' . date('H:i', $time);
                break;
            case $d < $byd:
                $fdate = '前天' . date('H:i', $time);
                break;
            case $d < $md:
                $fdate = date('m-d H:i', $time);
                break;
            case $d < $ld:
                $fdate = date('m-d H:i', $time);
                break;
            default:
                $fdate = date('Y-m-d', $time);
                break;
        }
    }
    return $fdate;
}

function PA($data){
    $data = str_replace('PM','上午',$data);
    $data = str_replace('AM','下午',$data);
    return $data;
}

/**
 * [ddate 时间差]
 */
function ddate($s,$e){
    $starttime = strtotime($s);
    $endtime = strtotime($e);
    $startyear = date('Y',$starttime);
    $startmonth = date('m',$starttime);
    $endyear = date('Y',$endtime);
    $endmonth = date('m',$endtime);
    $return = '';
    $return_year = $endyear - $startyear;
    $return_month = $endmonth - $startmonth;
    if($return_month<0){
        $return_month += 12;
        $return_year -= 1;
    }
    if($return_year>0){
        $return .= $return_year.'年';
    }
    if($return_month>0){
        $return .= $return_month.'个月';
    }
    return $return;
}

/**
 * 对象转换成数组
 */
function object_to_array($obj) {
    $_arr = is_object($obj) ? get_object_vars($obj) : $obj;
    foreach ($_arr as $key => $val) {
        $val = (is_array($val) || is_object($val)) ? object_to_array($val) : $val;
        $arr[$key] = $val;
    }
    return $arr;
}

/**
 * 获取图片
 */
function attach($attach, $type) {
    if(empty($attach)) return false;
    if(false === strpos($attach, 'http://')) {
        //本地附件
        return __ROOT__ . '/data/upload/' . $type . '/' . $attach;
        //远程附件
        //todo...
    }else{
        //URL链接
        return $attach;
    }
}

/**
 * [badword 敏感词处理]
 * @param  [string] $data [文本内容]
 * @return [string]       [替换后的内容]
 */
function badword($data){
    if(!C('qscms_badword_status')) return $data;
    //敏感词处理
    return D('Badword')->check($data);
}

/**
 * [requireone 验证数组内容必填一项：一维数组]
 */
function requireone($d){
    $t = array_filter($d);
    return !empty($t);
}

/**
 * [ad 广告位初始化]
 * @param  [string] $tpl [广告位名称]
 * @return [html]        [广告位终端]
 * @return [num]         [广告数量]
 */
function ad($tpl,$num='',$type='pc'){
    W('Common/Banner/index',array($tpl,$num,$type));
}

/**
 * [P 模板跳转 参数处理]
 * @param array $data [数组]
 */
function P($data = array()){
    $get = $_GET;
    unset($get['_URL_']);
    unset($get['p']);
    return U(CONTROLLER_NAME.'/'.ACTION_NAME,array_filter(array_merge($get,$data)));
}

/*
    字段单独验证 
*/
function fieldRegex($value,$rule){
    $validate = array(
        'require'   =>  '/.+/',
        'email'     =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
        'mobile'    =>  '/^(13|15|14|17|18)\d{9}$/',
        'tel'        =>  '/^(([0\\+]\\d{2,3}-)?(0\\d{2,3})-)?(\\d{7,8})(-(\\d{3,}))?$/',
        'url'       =>  '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
        'currency'  =>  '/^\d+(\.\d+)?$/',
        'number'    =>  '/^\d+$/',
        'zip'       =>  '/^\d{6}$/',
        'integer'   =>  '/^[-\+]?\d+$/',
        'double'    =>  '/^[-\+]?\d+(\.\d+)?$/',
        'english'   =>  '/^[A-Za-z]+$/',
        'img'       =>  '(.*)\\.(jpg|bmp|gif|ico|pcx|jpeg|tif|png|raw|tga)$/',
        'in'        =>  '/^(\d{1,10},)*(\d{1,10})$/',
        'qq'        =>  '/^[1-9]*[1-9][0-9]*$/'
    );
    // 检查是否有内置的正则表达式
    if(isset($validate[strtolower($rule)]))
        $rule       =   $validate[strtolower($rule)];
    return preg_match($rule,$value)===1;
}

function contact_hide($data,$IsWhat = 2){
    if($IsWhat == 1){
        return preg_replace('/([0[0-9]{2,3}[-]?[1-9]]|[1-9])[0-9]{2,4}([0-9]{3}[-]?[0-9]?)/i','$1****$2',$data);
    }elseif($IsWhat == 2){
        return  preg_replace('/(1[34578]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$data);
    }else{
        $email_array = explode("@", $data);
        $n = mb_strlen($email_array[0],'utf-8');
        return str_pad(substr($email_array[0],0,intval($n/2)),$n,'*').$email_array[1];
    }
}

function setLog($params){
    $tableArr = array('SysLog','SysEmailLog','MembersLog','MembersChargeLog','RefreshLog','AdminLog','MembersSetmealLog');
    if(!$params['_t']){
        return array('state'=>false,'error'=>'参数错误！');
    }
    if(!in_array($params['_t'],$tableArr)){
        return array('state'=>false,'error'=>'表名错误！');
    }
    $mod = D($params['_t']);
    $params['__hash__'] = $_POST['__hash__'];
    C('SUBSITE_VAL.s_id') && $params['subsite_id'] = C('SUBSITE_VAL.s_id');
    if(false===$mod->create($params)){
        return array('state'=>false,'error'=>$mod->getError());
    }else{
        if(false !== $rid = $mod->add()){
            return array('state'=>true);
        }else{
            return array('state'=>false,'error'=>'日志记录失败！');
        }
    }
}

/**
 * 写后台日志
 */
function admin_write_log($str, $user,$log_type=1){
    $params = array(
        '_t'=>'AdminLog',
        'admin_name'=>$user,
        'log_value'=>$str,
        'log_type'=>$log_type
        );
    setLog($params);
}

//会员操作日志
function write_members_log($user,$type,$replace1='',$replace2='',$replace3='',$source = false,$param_id=0){
    $members_log['_t']='MembersLog';
    $members_log['log_uid']=$user['uid'];
    $members_log['log_utype']=$user['utype'];
    $members_log['log_username']=$user['username'];
    $members_log['log_type']=$type;
    $members_log['log_value'] = sprintf(D('MembersLog')->type_arr[$type]['content'],$replace1,$replace2,$replace3);
    if($type == 1000 || $type == 1001){
        $str = C('PLATFORM')=='mobile' ? '(Mobile)' : '(Home)';
        $members_log['log_value'].=$str;
    }
    $source && $members_log['log_source']=$source;
    $param_id && $members_log['param_id']=$param_id;
    setLog($members_log);
    unset($members_log);
}

//截取字符
function cut_str($sourcestr,$cutlength, $start=0,$dot=''){
    $returnstr = '';
    $i = 0;
    $n = 0;
    $str_length = strlen($sourcestr);
    $mb_str_length = mb_strlen($sourcestr,'utf-8');
    while(($n < $cutlength) && ($i <= $str_length)){
        $temp_str = substr($sourcestr,$i,1);
        $ascnum = ord($temp_str);
        if($ascnum >= 224){
            $returnstr = $returnstr.substr($sourcestr,$i,3);
            $i = $i + 3;
            $n++;
        }elseif($ascnum >= 192){
            $returnstr = $returnstr.substr($sourcestr,$i,2);
            $i = $i + 2;
            $n++;
        }elseif(($ascnum >= 65) && ($ascnum <= 90)){
            $returnstr = $returnstr.substr($sourcestr,$i,1);
            $i = $i + 1;
            $n++;
        }else{
            $returnstr = $returnstr.substr($sourcestr,$i,1);
            $i = $i + 1;
            $n = $n + 0.5;
        }
    }
    if($mb_str_length > $cutlength){
        $returnstr = $returnstr.$dot;
    }
    return $returnstr;
}

// 分词
function get_tags($title,$num=10,$mode=false,$s=false){
    vendor('pscws4.pscws4#class');
    $pscws = new \PSCWS4();
    $pscws->set_dict(QSCMS_DATA_PATH . 'scws/dict.utf8.xdb');
    $pscws->set_rule(QSCMS_DATA_PATH . 'scws/rules.utf8.ini');
    $pscws->set_ignore(true);
    $pscws->send_text($title);
    if($mode){
        //开启二元分词
        $pscws->set_multi(2);
        while (false !== $tag = $pscws->get_result()) {
            foreach ($tag as $key => $val) {
                $tags[] = $val['word'];
            }
        }
    }else{
        //不开启二元分词，返回系统计算出来的最关键词汇列表
        $words = $pscws->get_tops($num);
        $tags = array();
        foreach ($words as $val) {
            $tags[] = $val['word'];
        }
    }
    $pscws->close();
    return $s ? $tags : array_map("fulltextpad",$tags);
}

/**
 * 前台分页统一
 */
function pager($count, $pagesize) {
    $pager = new Common\ORG\Page($count, $pagesize);
    $pager->rollPage = 5;
    $pager->setConfig('first', '首页');
    $pager->setConfig('prev', '上一页');
    $pager->setConfig('next', '下一页');
    $pager->setConfig('last', '最后一页');
    if(C('PLATFORM')=='mobile'){
        $pager->setConfig('theme', '%upPage% <span>%nowPage%/%totalPage%</span> %downPage%');
    }else{
        $pager->setConfig('theme', '%first% %upPage% %linkPage% %downPage% %end%');
    }
    return $pager;
}

/**
 *  解析 url
*/
function parseUrl($data){  
    $parse_url=parse_url(parse_url_request_url());
    $parse_url=$parse_url['query'];
    parse_str($parse_url,$urlarray);
    foreach($data as $key=>$val){
        $urlarray[$key]=$val;
    }
    return '?'.http_build_query($urlarray);
}

function parse_url_request_url(){     
    if (isset($_SERVER['REQUEST_URI'])){        
        $url = $_SERVER['REQUEST_URI'];    
    }else{    
        if(isset($_SERVER['argv'])){           
            $url = $_SERVER['PHP_SELF'] .'?'. $_SERVER['argv'][0];      
        }else{         
            $url = $_SERVER['PHP_SELF'] .'?'.$_SERVER['QUERY_STRING'];
        }  
    }    
    return $url; 
}

/**
 * [url_rewrite 伪静态]
 * @param  [type]    $alias     [description]
 * @param  [array]   $get       [传值]
 * @param  boolean   $rewrite   [是否开启伪静态]
 * @return [string]             [链接]
 */
function url_rewrite($alias=NULL,$get=NULL,$subsite_id=0,$rewrite=true){
    if(C('PLATFORM')=='mobile'){
        $page_list = F('mobile_page_config','',MODULE_PATH.'Conf/');
    }else{
        $page_list = D('Page')->page_cache();
    }
    $url ='';
    if($get['key'] && C('qscms_key_urlencode')==1){
        $get['key'] = urlencode(urldecode($get['key']));
    }
    if($page_list[$alias]['url']=='0' || $rewrite==false){//原始链接
        $u = $page_list[$alias]['module'].'/'.$page_list[$alias]['controller'].'/'.$page_list[$alias]['action'];
        $url = U($u,$get);
    }else{
        if($url = $page_list[$alias]['rewrite']){
            if($page_list[$alias]['pagetpye']=='2' && empty($get['page'])){
                $get['page']=1;
            }
            if($get){
                foreach($get as $k=>$val){
                    $data['($'.$k.')'] = $val;
                }
                $url = strtr($url,$data);
            }
            $url = preg_replace('/\(\$(\w+)\)/','',$url);
            $url = __ROOT__.'/'.$url.C('URL_HTML_SUFFIX');
        }else{
            $u = $page_list[$alias]['module'].'/'.$page_list[$alias]['controller'].'/'.$page_list[$alias]['action'];
            $url = U($u,$get);
        }
    }
    return C('apply.Subsite') ? subsite_url($alias,$url,$subsite_id) : $url;
}

function subsite_url($alias,$url,$subsite_id){
    $alias_k = $alias;
    if(C('PLATFORM')=='mobile') $alias_k = str_replace('QS_','QS_m_',$alias);
    if(false === $subsite_alias = F('subsite_alias')) $subsite_alias = D('SubsiteConfig')->get_subsite_alias();
    if(!$domain = $subsite_alias[$alias_k]){
        if(in_array($alias,array('QS_resumeshow','QS_companyshow','QS_help','QS_helplist','QS_helpshow','QS_mall_index','QS_goods_list','QS_goods_show','QS_mall_charts'))){
            $domain = C('PLATFORM')=='mobile' && C('qscms_wap_domain') ? C('qscms_wap_domain') : C('qscms_site_domain');
        }else{
            if($subsite_id > 0){
                if(false === $subsite = F('subsite_domain_list')) $subsite = D('Subsite')->get_subsite_domain();
                $domain = C('PLATFORM')=='mobile' && $subsite[$subsite_id]['s_m_domain'] ? $subsite[$subsite_id]['s_m_domain'] : $subsite[$subsite_id]['s_domain'];
                $domain = 'http://'.$domain;
            }
        }
    }else{
        $domain = 'http://'.$domain;
    }
    $dir = str_replace('/','',C('qscms_site_dir'));
    $dir = $dir ? C('qscms_site_dir') : '';
    return $domain ? $domain . $dir . $url : C('SUBSITE_DOMAIN') . $dir . $url;
}

function check_url($subsite_id){
    !$subsite_id && $subsite_id = 0;
    if(C('SUBSITE_VAL.s_id') != $subsite_id){
        if(C('qscms_subsite_method') == 1){
            if(false === $subsite = F('subsite_domain_list')) $subsite = D('Subsite')->get_subsite_domain();
            $domain = C('PLATFORM')=='mobile' && $subsite[$subsite_id]['s_m_domain'] ? $subsite[$subsite_id]['s_m_domain'] : $subsite[$subsite_id]['s_domain'];
            $url = 'http://'.$domain.$_SERVER['REQUEST_URI'];
            redirect301($url);
        }else{
            redirect404();
        }
    }
}

function redirect301($url){
    send_http_status(301);
    redirect($url);
}

function redirect404(){
    $controller = new \Common\Controller\BaseController;
    $controller->_empty();
}

function https_request($url,$data = null){
    if(function_exists('curl_init')){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }else{
        return false;
    }
}

function convert_datefm($date,$format,$separator="-"){
    if ($format=="1"){
        return date("Y-m-d", $date);
    }else{
        if (!preg_match("/^[0-9]{4}(\\".$separator.")[0-9]{1,2}(\\1)[0-9]{1,2}(|\s+[0-9]{1,2}(|:[0-9]{1,2}(|:[0-9]{1,2})))$/",$date))  return false;
        $date=explode($separator,$date);
        return mktime(0,0,0,$date[1],$date[2],$date[0]);
    }
}

/**
 * 删除目录
 */
function rmdirs($dir,$rm_self=false){  
    $d = dir($dir);  
    while (false !== ($child = $d->read())){  
        if($child != '.' && $child != '..'){  
            if(is_dir($dir.'/'.$child)){
                rmdirs($dir.'/'.$child,true);  
            } 
            else{
                unlink($dir.'/'.$child);  
            } 
        }  
    }  
    $d->close();  
    $rm_self && rmdir($dir);  
}

/**
 * 获取随机字符串
 */
function get_rand_char($num){
    if (empty($num)){
        return false;
    }
    $string = 'ABCDEFGHIGKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $str = '';
    for ($i = 0; $i < $num; $i++){
        $pos = rand(0, 51);
        $str .= $string{$pos};
    }
    return $str;
}

/**
* 随机字符串
*
* @return bool
**/
function randnums($length, $numeric = 0) {
    $seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
    $seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
    if($numeric) {
          $hash = '';
    } else {
          $hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
          $length--;
    }
    $max = strlen($seed) - 1;
    for($i = 0; $i < $length; $i++) {
      $hash .= $seed{mt_rand(0, $max)};
    }
    return $hash;
}

/**
 * 获取子目录
 */
function getsubdirs($dir) {
    $subdirs = array();
    if(!$dh = opendir($dir)) return $subdirs;
    while ($f = readdir($dh)) {
        if($f =='.' || $f =='..') continue;
        $path = $dir.'/'.$f;  //如果只要子目录名, path = $f;
        $subdir=$f;
        if(is_dir($path)) {
                $subdirs[] = $subdir;
        }
    }
    closedir($dh);
    return $subdirs;
}

/**
 * 生成excel
 */
function create_excel($top_str,$data){
    header("Content-Type: application/vnd.ms-execl");
    header("Content-Disposition: attachment; filename=myExcel.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $top_str;
    foreach ($data as $k => $v) {
        foreach ($v as $k1 => $v1) {
            echo $v1;
            echo ($k1+1)<count($v)?"\t":"";
        }
        echo "\t\n";
    }
}

/**
 *计算坐标点周围某段距离的正方形的四个点
 *@param lng float 经度
 *@param lat float 纬度
 *@param distance float 该点所在圆的半径，该圆与此正方形内切，默认值为0.5千米
 *@return array 正方形的四个点的经纬度坐标
 */
function square_point($lng, $lat,$distance = 0.5){
    $earth_radius = 6378.138;
    $dlng =  2 * asin(sin($distance / (2 * $earth_radius)) / cos(deg2rad($lat)));
    $dlng = rad2deg($dlng);
    $dlat = $distance/$earth_radius;
    $dlat = rad2deg($dlat);
    return array(
        'lt'=>array('lat'=>$lat + $dlat,'lng'=>$lng-$dlng),
        'rt'=>array('lat'=>$lat + $dlat, 'lng'=>$lng + $dlng),
        'lb'=>array('lat'=>$lat - $dlat, 'lng'=>$lng - $dlng),
        'rb'=>array('lat'=>$lat - $dlat, 'lng'=>$lng + $dlng)
    );
}

//检查缓存
function check_cache($cache,$dir,$days=1){
    $cachename=STATISTICS_PATH.$dir.$cache;
    if(!is_dir(STATISTICS_PATH.$dir)) mkdir(STATISTICS_PATH.$dir);
    if (!is_writable(STATISTICS_PATH.$dir)){
        exit("请先将“".STATISTICS_PATH.$dir."”目录设置可读写！");
    }
    if (file_exists($cachename)){
        $filemtime=filemtime($cachename);
        if ($filemtime>strtotime("-".$days." day")){
            return file_get_contents($cachename);
        }
    }
    return false;
}

//写入缓存
function write_cache($cache,$dir,$json){
    if(!is_dir(STATISTICS_PATH.$dir)) mkdir(STATISTICS_PATH.$dir);
    $cachename=STATISTICS_PATH.$dir.$cache;
    if (!file_put_contents($cachename, $json, LOCK_EX)){
        $fp = @fopen($cachename, 'wb+');
        if (!$fp){
            exit('生cache文件失败，请设置“'.STATISTICS_PATH.$dir.'”的读写权限');
        }
        if (!@fwrite($fp, $json)){
            exit('生cache文件失败，请设置“'.STATISTICS_PATH.$dir.'”的读写权限');
        }
        @fclose($fp);
    }
}

/**
 * [get_first 后台取get传值第一个元素key及val]
 */
function get_first(){
    if(!$_GET) return '';
    return '&'.key($_GET).'='.current($_GET);
}

/**
 * 获取跳转到触屏的地址
 * $data = array(
 *      'c'=>'',
 *      'a'=>'',
 *      'params'=>'a=1&b=2&c=3',
 * );
 */

function build_mobile_url($data=array()){
    $config = F('Mobile/Conf/config','',APP_PATH);
    $url = C('qscms_site_domain').C('qscms_site_dir');
    if(empty($data)){
        if($config['URL_MODEL']==0){
            $url = C('qscms_wap_domain')?C('qscms_wap_domain'):(C('qscms_site_domain').C('qscms_site_dir').'?m=Mobile');
        }else if($config['URL_MODEL']==1){
            $url = C('qscms_wap_domain')?C('qscms_wap_domain'):(C('qscms_site_domain').C('qscms_site_dir').'index.php/Mobile');
        }else if($config['URL_MODEL']==2){
            $url = C('qscms_wap_domain')?C('qscms_wap_domain'):(C('qscms_site_domain').C('qscms_site_dir').'Mobile');
        }
    }else{
        if($config['URL_MODEL']==0){
            if(C('qscms_wap_domain')){
                $url = C('qscms_wap_domain').'?c='.$data['c'].'&a='.$data['a'].($data['params']?('&'.$data['params']):'');
            }else{
                $url = C('qscms_site_domain').C('qscms_site_dir').'?m=Mobile&c='.$data['c'].'&a='.$data['a'].($data['params']?('&'.$data['params']):'');
            }
        }else if($config['URL_MODEL']==1){
            if($data['params']){
                $data['params'] = str_replace("&", "/", $data['params']);
                $data['params'] = str_replace("=", "/", $data['params']);
            }
            if(C('qscms_wap_domain')){
                $url = C('qscms_wap_domain').'/index.php/'.$data['c'].'/'.$data['a'].($data['params']?('/'.$data['params']):'');
            }else{
                $url = C('qscms_site_domain').C('qscms_site_dir').'index.php/Mobile/'.$data['c'].'/'.$data['a'].($data['params']?('/'.$data['params']):'');
            }
        }else if($config['URL_MODEL']==2){
            if($data['params']){
                $data['params'] = str_replace("&", "/", $data['params']);
                $data['params'] = str_replace("=", "/", $data['params']);
            }
            if(C('qscms_wap_domain')){
                $url = C('qscms_wap_domain').'/'.$data['c'].'/'.$data['a'].($data['params']?('/'.$data['params']):'');
            }else{
                $url = C('qscms_site_domain').C('qscms_site_dir').'Mobile/'.$data['c'].'/'.$data['a'].($data['params']?('/'.$data['params']):'');
            }
        }
    }
    return $url;
}

function GetIp(){  
    $realip = '';  
    $unknown = 'unknown';  
    if (isset($_SERVER)){  
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){  
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
            foreach($arr as $ip){  
                $ip = trim($ip);  
                if ($ip != 'unknown'){  
                    $realip = $ip;  
                    break;  
                }  
            }  
        }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){  
            $realip = $_SERVER['HTTP_CLIENT_IP'];  
        }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){  
            $realip = $_SERVER['REMOTE_ADDR'];  
        }else{  
            $realip = $unknown;  
        }  
    }else{  
        if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){  
            $realip = getenv("HTTP_X_FORWARDED_FOR");  
        }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){  
            $realip = getenv("HTTP_CLIENT_IP");  
        }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){  
            $realip = getenv("REMOTE_ADDR");  
        }else{  
            $realip = $unknown;  
        }  
    }  
    $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;  
    return $realip;  
}

function GetIpLookup($ip = ''){  
    if(empty($ip)){  
        $ip = GetIp();  
    }  
    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);  
    if(empty($res)){ return false; }  
    $jsonMatches = array();  
    preg_match('#\{.+?\}#', $res, $jsonMatches);  
    if(!isset($jsonMatches[0])){ return false; }  
    $json = json_decode($jsonMatches[0], true);  
    if(isset($json['ret']) && $json['ret'] == 1){  
        $json['ip'] = $ip;  
        unset($json['ret']);  
    }else{  
        return false;  
    }  
    return $json;  
}

function del_punctuation($str){
    if(!$str) return '';
    $char = "`·。、！？：；﹑•＂…‘’“”〝〞∕¦‖—　〈〉﹞﹝「」‹›〖〗】【»«』『〕〔》《﹐¸﹕︰﹔！¡？¿﹖﹌﹏﹋＇´ˊˋ―﹫︳︴¯＿￣﹢﹦﹤‐­˜﹟﹩﹠﹪﹡﹨﹍﹉﹎﹊ˇ︵︶︷︸︹︿﹀︺︽︾ˉ﹁﹂﹃﹄︻︼（）";
    $pattern = array(
        "/[[:punct:]]/i",
        '/['.$char.']/u',
        '/[ ]{2,}/'
    );
    $str = preg_replace($pattern, '', $str);
    return $str;
}

//文本输入
function text_in($str){
    $str=strip_tags($str,'<br>');
    $str = str_replace(" ", "&nbsp;", $str);
    $str = str_replace("\n", "<br>", $str); 
    if(!get_magic_quotes_gpc()) {
      $str = addslashes($str);
    }
    return $str;
}

//文本输出
function text_out($str){
    $str = str_replace("&nbsp;", " ", $str);
    $str = str_replace("<br>", "\n", $str); 
    $str = stripslashes($str);
    return $str;
}

//html代码输入
function html_in($str){
    $str=htmlspecialchars($str);
    if(!get_magic_quotes_gpc()) {
        $str = addslashes($str);
    }
   return $str;
}

//html代码输出
function html_out($str){
    if(function_exists('htmlspecialchars_decode')){
        $str=htmlspecialchars_decode($str);
    }else{
        $str=html_entity_decode($str);
    }
    $str = stripslashes($str);
    return $str;
}

/**
 * array_link 连接两个数组
 * @param array $arr  主数组
 * @param array $arr2 附加数组 键名必须是关联字段的值
 * @param string $k   关联字段名
 * @return array
 */
function array_link($arr, $arr2, $k){
    if (!is_array($arr)||!is_array($arr2)) return $arr;
    if (empty($arr2)) return $arr;
    foreach ($arr as $key=>$val) {
        if(!empty($arr2[$val[$k]])) {
            
            $arr[$key] = array_merge($val, $arr2[$val[$k]]);
        }
    }
    return $arr;
}

/**
 * array_key 取数组中的某一字段设置为键值
 * @param array $arr 原数组
 * @param string $key 字段名
 * @return array
 */
function array_key($arr, $key){
    $new_arr = array();
    if (!is_array($arr)) return $new_arr;
    foreach ($arr as $k=>$v) $new_arr[$v[$key]] = $v;
    return $new_arr;
}

//中文字符串截取
function msubstr($str, $length, $charset="utf-8", $suffix=true){
    if(empty($str)){
        return;
    }
    $sourcestr=$str;
    $cutlength=$length;
    $returnstr = '';
    $i = 0;
    $n = 0.0;
    $str_length = strlen($sourcestr); //字符串的字节数
    while ( ($n<$cutlength) and ($i<$str_length) ){
       $temp_str = substr($sourcestr, $i, 1);
       $ascnum = ord($temp_str); 
       if ( $ascnum >= 252){
        $returnstr = $returnstr . substr($sourcestr, $i, 6); 
        $i = $i + 6; 
        $n++; 
       }elseif ( $ascnum >= 248 ){
        $returnstr = $returnstr . substr($sourcestr, $i, 5);
        $i = $i + 5;
        $n++;
       }elseif ( $ascnum >= 240 ){
        $returnstr = $returnstr . substr($sourcestr, $i, 4);
        $i = $i + 4;
        $n++;
       }elseif ( $ascnum >= 224 ){
        $returnstr = $returnstr . substr($sourcestr, $i, 3);
        $i = $i + 3 ; 
        $n++; 
       }elseif ( $ascnum >= 192 ){
        $returnstr = $returnstr . substr($sourcestr, $i, 2);
        $i = $i + 2; 
        $n++; 
       }elseif ( $ascnum>=65 and $ascnum<=90 and $ascnum!=73){
        $returnstr = $returnstr . substr($sourcestr, $i, 1);
        $i = $i + 1;
        $n++;
       }elseif ( !(array_search($ascnum, array(37, 38, 64, 109 ,119)) === FALSE) ){
        $returnstr = $returnstr . substr($sourcestr, $i, 1);
        $i = $i + 1;
        $n++; 
       }else{
        $returnstr = $returnstr . substr($sourcestr, $i, 1);
        $i = $i + 1;
        $n = $n + 0.5; 
       }
    }
    if ( $i < $str_length && $suffix){
       $returnstr = $returnstr . '…';
    }
    return $returnstr;
}

//字符串截取
function len($str, $len=0){
    if(!empty($len)){
        return msubstr($str, $len);
    }else{
        return $str;
    }
}

function pre($vars, $label = '', $return = false){
    if (ini_get('html_errors')){
        $content = "<pre>\n";
        if ($label != '') {
            $content .= "<strong>{$label} :</strong>\n";
        }
        $content .= htmlspecialchars(print_r($vars, true));
        $content .= "\n</pre>\n";
    } else {
        $content = $label . " :\n" . print_r($vars, true);
    }
    if ($return) { return $content; }
    echo $content;
    return null;
}

function pree($a,$b){
    print_r($a);
    echo "<br/>";
    print_r($b);
    exit;
}

function values2keys($arr, $value=1){
    $new = array();
    while (list($k,$v) = each($arr)){
        $v = trim($v);
        if ($v != ''){ 
            $new[$v] = $value;
        }
    }
    return $new;
}

/** 
 * 把全名拆分为姓氏和名字 
 * @param string $fullname 全名 
 * @return array 一维数组,元素一是姓,元素二为名 
 * @author: 风柏杨<waitatlee@163.com> 
 */
function split_name($fullname){
     $hyphenated = array('欧阳','太史','端木','上官','司马','东方','独孤','南宫','万俟','闻人','夏侯','诸葛','尉迟','公羊','赫连','澹台','皇甫',  
        '宗政','濮阳','公冶','太叔','申屠','公孙','慕容','仲孙','钟离','长孙','宇文','城池','司徒','鲜于','司空','汝嫣','闾丘','子车','亓官',  
        '司寇','巫马','公西','颛孙','壤驷','公良','漆雕','乐正','宰父','谷梁','拓跋','夹谷','轩辕','令狐','段干','百里','呼延','东郭','南门',  
        '羊舌','微生','公户','公玉','公仪','梁丘','公仲','公上','公门','公山','公坚','左丘','公伯','西门','公祖','第五','公乘','贯丘','公皙',  
        '南荣','东里','东宫','仲长','子书','子桑','即墨','达奚','褚师');  
        $vLength = mb_strlen($fullname, 'utf-8');  
        $lastname = '';  
        $firstname = '';//前为姓,后为名  
        if($vLength > 2){  
            $preTwoWords = mb_substr($fullname, 0, 2, 'utf-8');//取命名的前两个字,看是否在复姓库中  
            if(in_array($preTwoWords, $hyphenated)){  
                $lastname = $preTwoWords;  
                $firstname = mb_substr($fullname, 2, 10, 'utf-8');  
            }else{  
                $lastname = mb_substr($fullname, 0, 1, 'utf-8');  
                $firstname = mb_substr($fullname, 1, 10, 'utf-8');  
            }  
        }else if($vLength == 2){//全名只有两个字时,以前一个为姓,后一下为名  
            $lastname = mb_substr($fullname ,0, 1, 'utf-8');  
            $firstname = mb_substr($fullname, 1, 10, 'utf-8');  
        }else{  
            $lastname = $fullname;  
        }  
        //return array($lastname, $firstname);
        return $lastname;  
}

function _strip_tags($tagsArr,$str) {   
    foreach ($tagsArr as $tag) {  
        $p[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";  
    }  
    $return_str = preg_replace($p,"",$str);  
    return $return_str;  
}

/**
 * 多维数组合并（支持多数组）
 * @return array
 */
function array_merge_multi(){
    $args = func_get_args();
    $array = array();
    foreach ( $args as $arg ) {
        if ( is_array($arg) ) {
            foreach ( $arg as $k => $v ) {
                if ( is_array($v) ) {
                    $array[$k] = isset($array[$k]) ? $array[$k] : array();
                    $array[$k] = array_merge_multi($array[$k], $v);
                } else {
                    $array[$k] = $v;
                }
            }
        }
    }
    return $array;
}

/**
* 不转义中文字符和\/的 json 编码方法
* @param array $arr 待编码数组
* @return string
*/
function json_encode_no_zh($arr) {
    $str = str_replace ( "\\/", "/", json_encode ( $arr ) );
    $search = "#\\\u([0-9a-f]+)#ie";
    if (strpos ( strtoupper(PHP_OS), 'WIN' ) === false) {
       $replace = "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))";//LINUX
    } else {
       $replace = "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))";//WINDOWS
    }
    return preg_replace ($search, $replace, $str );
}


function strFilter($str){
    $str = str_replace('`', '', $str);
    $str = str_replace('·', '', $str);
    $str = str_replace('~', '', $str);
    $str = str_replace('!', '', $str);
    $str = str_replace('！', '', $str);
    $str = str_replace('@', '', $str);
    $str = str_replace('#', '', $str);
    $str = str_replace('$', '', $str);
    $str = str_replace('￥', '', $str);
    $str = str_replace('%', '', $str);
    $str = str_replace('^', '', $str);
    $str = str_replace('……', '', $str);
    $str = str_replace('&', '', $str);
    $str = str_replace('*', '', $str);
    $str = str_replace('(', '', $str);
    $str = str_replace(')', '', $str);
    $str = str_replace('（', '', $str);
    $str = str_replace('）', '', $str);
    $str = str_replace('-', '', $str);
    $str = str_replace('_', '', $str);
    $str = str_replace('——', '', $str);
    $str = str_replace('+', '', $str);
    $str = str_replace('=', '', $str);
    $str = str_replace('|', '', $str);
    $str = str_replace('\\', '', $str);
    $str = str_replace('[', '', $str);
    $str = str_replace(']', '', $str);
    $str = str_replace('【', '', $str);
    $str = str_replace('】', '', $str);
    $str = str_replace('{', '', $str);
    $str = str_replace('}', '', $str);
    $str = str_replace(';', '', $str);
    $str = str_replace('；', '', $str);
    $str = str_replace(':', '', $str);
    $str = str_replace('：', '', $str);
    $str = str_replace('\'', '', $str);
    $str = str_replace('"', '', $str);
    $str = str_replace('“', '', $str);
    $str = str_replace('”', '', $str);
    $str = str_replace(',', '', $str);
    $str = str_replace('，', '', $str);
    $str = str_replace('<', '', $str);
    $str = str_replace('>', '', $str);
    $str = str_replace('《', '', $str);
    $str = str_replace('》', '', $str);
    $str = str_replace('.', '', $str);
    $str = str_replace('。', '', $str);
    $str = str_replace('/', '', $str);
    $str = str_replace('、', '', $str);
    $str = str_replace('?', '', $str);
    $str = str_replace('？', '', $str);
    return trim($str);
}

//二维数组转一维数组
function array_multi_to_single($array,$clearrepeated=false){
    if(!isset($array)||!is_array($array)||empty($array)){
        return false;
    }
    if(!in_array($clearrepeated,array('true','false',''))){
        return false;
    }
    static $result_array=array();
    foreach($array as $value){
        if(is_array($value)){
            array_multi_to_single($value);
        }else{
            $result_array[]=$value;
        }
    }
    if($clearrepeated){
        $result_array=array_unique($result_array);
    }
    return $result_array;
}

function field_get_name($info='',$field='',$ext_field='',$ext_condition=''){
    if($field==''){
        return $info;
    }
    $category = F('category');
    if($ext_field){
        $category_list = $category[$ext_field];
    }else{
        $category_list = $category[$field];
        if(empty($category_list)){
            $field = ucfirst($field);
            $category_list = $category[$field];
        }
    }
    $info = explode(',',$info);
    foreach ($info as $key => $value) {
    foreach ($category_list as $k => $v){
            if($value==$k){
                if($ext_condition==1){
                    if(count($info)>2){
                        if($key==1){
                            $infos['field'].=$category_list[$value].' '.'...';
                            break 2;
                        }   
                    }
                }
                $infos['field'].=$category_list[$value].' ';
            }
        }
    }
    return $infos['field'];
}

function str2arr($str, $glue = ','){
     return explode($glue, $str);
}

function arr2str($arr, $glue = ','){
    return implode($glue, $arr);
}

function amount_interval_do($info='',$empty=''){
    $category = F('category');
    $money_unit = array_flip($category['money_unit']);
    if($info['amount_interval']){
            $patterns = "/\d+/";
            preg_match_all($patterns,$info['amount_interval'],$amount_interval_num);
            preg_match_all("/[\x{4e00}-\x{9fa5}]+/u",$info['amount_interval'], $amount_interval_cn);
            $info['amount_interval_min'] = $amount_interval_num[0][0];
            $info['amount_interval_max'] = $amount_interval_num[0][1];
            $info['amount_interval_min_unit']=$money_unit[$amount_interval_cn[0][0]];
            $info['amount_interval_max_unit']=$money_unit[$amount_interval_cn[0][1]];
            
            if(empty($info['amount_interval_max'])){
                $info['amount_interval_max'] = $info['amount_interval_min'];
            }
            if(empty($info['amount_interval_max_unit'])){
                $info['amount_interval_max_unit'] = $info['amount_interval_min_unit'];
            }
            
            if($empty==1){
                unset($info['amount_interval']);
                unset($info['投资估算']);
            }
        }
    return $info;
}
    
function ext_info_do($info='',$field='',$ext_field=''){
    if($field==''){
        return $info;
    }
    $category = F('category');
    $array=['tz_area','attxmrz_intention'];
    if(in_array($field,$array)){
        $info[$field] = explode(" ",$info[$field]);
    }else{
        $info[$field] = explode(",",$info[$field]);
    }
    if(!empty($ext_field)){
        $field_category = $category[$ext_field];
    }else{
        $field_category = $category[$field];
    }
        if(is_array($info[$field])){
            foreach ($info[$field] as $k => $v) {
               foreach ($field_category as $key => $value){
                   if($v==$value){
                        $r.=$key.',';
                   }
               }
            }
        }
    $info[$field] = rtrim($r,',');
    return $info;
}
    
//单纯100万
function unit_do($info='',$field='',$type=''){
    if($field=='' || $type==''){
        return;
    }
    $category = F('category');
    $patterns = "/\d+/";
    preg_match_all($patterns,$info[$field],$arr);
    $unit = reset($arr[0]);
    $info[$field.'_unit'] = trim(str_replace($unit,'',$info[$field]));
    if($type=='money'){
        $money_unit = array_flip($category['money_unit']);
        $info[$field.'_unit'] = $money_unit[$info[$field.'_unit']];
    }
    if($type=='date'){
        $date = array_flip($category['date']);
        $info[$field.'_unit'] = $date[$info[$field.'_unit']];
    }
    $info[$field] = $unit;
    return $info;
}
    
function three_unit_do($info='',$field='',$empty=''){
    if($field==''){
        return $info;
    }
    $category = F('category');
    $patterns = "/\d+/";
    $unit = explode(" ",$info[$field]);
    preg_match_all($patterns,$info[$field],$arr);
    $info[$field.'_min'] = reset($arr[0]);
    $info[$field.'_max'] = end($arr[0]);
    $date = array_flip($category['date']);
    $info[$field.'_unit'] = end($unit);
    $info[$field.'_unit'] = $date[$info[$field.'_unit']];
    if($empty==1){
        unset($info[$field]);
    }
    return $info;
}
    
function cut_date($info,$field){
    if($field==''){
        return $info;
    }
    $info[$field] = str_replace("%/年","",$info[$field]);
    return $info;
}
    
function get_single_num($info='',$field=''){
    if($field==''){
        return $info;
    }
    $patterns = "/\d+/";
    //$S20 = explode(" ",$info[$field]);
    preg_match_all($patterns,$info[$field],$arr);
    $info[$field] = end($arr[0]);
    return $info;
}

function S18($info='',$field=''){
    if($field==''){
        return $info;
    }
    $patterns = "/\d+/";
    $temp = explode(" ",$info[$field]);
    preg_match_all($patterns,$info[$field],$arr);
    $info[$field.'_min'] = reset($arr[0]);
    $info[$field.'_max'] = end($arr[0]);
    $info[$field.'_unit'] = end($temp);
    unset($info[$field]);
    return $info;
}

// 销售回款,其它来源[土地变性后银行贷款]
function special_field_do($info='',$field=''){
    if($field==''){
        return $info;
    }
    //$str = '销售回款,其它来源[土地变性后银行贷款]';
    $temp_str = strstr($info[$field],'[');
    $info['extra_'.$field] = strFilter(strstr($info[$field],'['));
    if(empty($info['extra_'.$field])){
        unset($info['extra_'.$field]);
    }
    $info[$field] = str_replace($temp_str,'',$info[$field]);
    $info = ext_info_do($info,$field);
    return $info;
}

function area_do($info='',$field=''){
    if($field==''){
        return $info;
    }
    $area = F('area');
    $province = F('province');
    $city = F('city');
    $city_pid= F('city_pid');
    foreach ($area as $k => $v) {
        $area_info[$v] = strstr($info[$field],$k);
    }
    $area_info = array_filter($area_info);
    if($area_info){
            $province_city_info = str_replace($area_info,'',$info[$field]);
            foreach ($city as $k => $v) {
                $city_info[$v] = strstr($province_city_info,$k);
            }
            $city_info = array_filter($city_info);
            if($city_info){
                $c_name=implode('',$city_info);
                $a_name=implode('',$area_info);
                $p_name = str_replace($c_name.$a_name,'',$info[$field]);
                if($p_name){
                    $province_info = $province[$p_name];
                }
                if($province_info){
                    $province_info=[$province_info=>$p_name];
                }
            }
    }else{
        foreach ($city as $k => $v) {
            $city_info[$v] = strstr($info[$field],$k);
        }
        $city_info = array_filter($city_info);
        if($city_info){
            $c_name=implode('',$city_info);
            $p_name = str_replace($c_name,'',$info[$field]);
            if($p_name){
                $province_info = $province[$p_name];
            }
            if($province_info){
                $province_info=[$province_info=>$p_name];
            }
        }else{
            $p_name = $info[$field];
            $province_info = $province[$p_name];
            $province_info=[$province_info=>$p_name];
        }
    }
        $province_info = array_keys($province_info);
        $city_info = array_keys($city_info);
        $area_info = array_keys($area_info);
        if(!empty($province_info)){
            $address['province_id'] = $province_info[0];
        }else{
            $address['province_id'] = $city_pid[$city_info[0]];
        }
        if(!empty($city_info)){
            //北京、重庆、北京、天津
            $address['city_id'] = $city_info[0];
        }else{
            $address['city_id'] =0;
        }
        if(!empty($area_info)){
            $address['area_id'] = $area_info[0];
        }else{
            $address['area_id'] =0;
        }
    $last_area_id = end(array_filter($address));
    $info['province_id'] = $address['province_id'];
    $info['city_id'] = $address['city_id'];
    $info['area_id'] = $address['area_id'];
    $info['last_area_id'] = $last_area_id;
    if(isset($info[$field]) && !empty($info[$field])){
        unset($info[$field]);
    }
    return $info;
}

function fund_info_tz_area($info){
    $category = F('category');
    $info['tz_area'] = explode(",",$info['tz_area']);
       foreach ($info['tz_area'] as $k => $v) {
            foreach ($category['province'] as $key => $value){
                if($v==$key){
                    $r.=$value.' ';
                }
            }
        }
    $info['tz_area'] = rtrim($r,' ');
    return $info;
}

/**
 * 判断email格式是否正确
 * @param $email
 */
function is_email($email) {
    return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

function link_area($province_id,$city_id,$area_id){
    $province = array_flip(F('province'));
    $city = array_flip(F('city'));
    $area = array_flip(F('area'));
    $link_area = array();
    $ext_area = [158,192,2966,2740];
    if(in_array($city_id,$ext_area)){
        unset($province_id);
    }
    if($province_id){
        $link_area['province_id'] = $province[$province_id];
    }
    if($city_id){
        $link_area['city_id'] = $city[$city_id];
    }
    if($area_id){
        $link_area['area_id'] = $area[$area_id];
    }
    $link_area = $link_area['province_id'].$link_area['city_id'].$link_area['area_id'];
    return $link_area;
}

//使用个人邮箱发送邮件
function person_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
    $config = ['SMTP_HOST'=>'smtp.qq.com','SMTP_PORT'=>'465','SMTP_USER'=>'123456@qq.com','SMTP_PASS'=>'','FROM_EMAIL'=>'123456@qq.com','FROM_NAME'=>'网站留言','REPLY_EMAIL'=>'','REPLY_NAME'=>''];
    vendor('PHPMailer.class#phpmailer');
    vendor('SMTP');
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP();
    $mail->SMTPDebug = 1; // 关闭SMTP调试功能
    $mail->SMTPAuth = true; // 启用 SMTP 验证功能
    $mail->SMTPSecure = 'ssl'; // 使用安全协议
    $mail->Host = $config['SMTP_HOST']; // SMTP 服务器
    $mail->Port = $config['SMTP_PORT']; // SMTP服务器的端口号
    $mail->Username = $config['SMTP_USER']; // SMTP服务器用户名
    $mail->Password = $config['SMTP_PASS']; // SMTP服务器密码
    $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
    $replyEmail = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
    $replyName = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->AltBody = "为了查看该邮件，请切换到支持 HTML 的邮件客户端";
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    //$mail->AddAddress("123456@qq.com", $name);
    //$mail->AddAddress("123456@qq.com", $name);
    if(is_array($attachment)){ // 添加附件
        foreach ($attachment as $file){
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}

//使用企业邮箱发送邮件
function company_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
    $config = ['SMTP_HOST'=>'smtp.exmail.qq.com','SMTP_PORT'=>'465','SMTP_USER'=>'services@jinrong.com','SMTP_PASS'=>'jinrong','FROM_EMAIL'=>'services@jinrong.com','FROM_NAME'=>'金融网客服','REPLY_EMAIL'=>'','REPLY_NAME'=>''];
    vendor('PHPMailer.class#phpmailer');
    vendor('SMTP');
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP(); // 设定使用SMTP服务
    $mail->SMTPDebug = 1; // 关闭SMTP调试功能
    $mail->SMTPAuth = true; // 启用 SMTP 验证功能
    $mail->SMTPSecure = 'ssl'; // 使用安全协议
    $mail->Host = $config['SMTP_HOST']; // SMTP 服务器
    $mail->Port = $config['SMTP_PORT']; // SMTP服务器的端口号
    $mail->Username = $config['SMTP_USER']; // SMTP服务器用户名
    $mail->Password = $config['SMTP_PASS']; // SMTP服务器密码
    $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
    $replyEmail = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
    $replyName = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->AltBody = "为了查看该邮件，请切换到支持 HTML 的邮件客户端";
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    $mail->AddAddress("123456@qq.com", $name);
    $mail->AddAddress("123456@qq.com", $name);
    if(is_array($attachment)){ // 添加附件
        foreach ($attachment as $file){
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}

function array_no_empty($arr) {
    if (is_array($arr)) {
        foreach ($arr as $k => $v ) {
            if (empty($v)) unset($arr[$k]);
            elseif (is_array($v)) {
                $arr[$k] = array_no_empty($v);
            }
        }
    }
    return $arr;
}

function avatars_rand(){
    $sex_rand = ['nan','nv'];
    $sex = $sex_rand[rand(0,1)];
    $num = rand(1,5);
    return $sex.$num;
}

//复制到搜索框中的内容,去除左右空格
function trimall($str) {
    if(is_array($str)){
        return array_map('trimall', $str);
    }
    $qian=array(" ","　","\t","\n","\r");
    $hou=array("","","","","");
    return str_replace($qian,$hou,$str);    
}

function num_format($num){ 
    if(!is_numeric($num)){ 
        return false; 
    } 
    $num = explode('.',$num);//把整数和小数分开 
    $rl = $num[1];//小数部分的值 
    $j = strlen($num[0])%3;//整数有多少位 
    $sl = substr($num[0],0,$j);//前面不满三位的数取出来 
    $sr = substr($num[0],$j);//后面的满三位的数取出来 
    $i = 0; 
    while($i <= strlen($sr)){ 
        $rvalue = $rvalue.','.substr($sr,$i,3);//三位三位取出再合并，按逗号隔开 
        $i = $i + 3; 
    } 
    $rvalue = $sl.$rvalue; 
    $rvalue = substr($rvalue,0,strlen($rvalue)-1);
    //去掉最后一个逗号 
    $rvalue = explode(',',$rvalue);//分解成数组 
    if($rvalue[0]==0){ 
        array_shift($rvalue);//如果第一个元素为0，删除第一个元素 
    } 
    $rv = $rvalue[0];//前面不满三位的数 
    for($i = 1; $i < count($rvalue); $i++){ 
        $rv = $rv.','.$rvalue[$i]; 
    }
    if(!empty($rl)){ 
        $rvalue = $rv.'.'.$rl;//小数不为空，整数和小数合并 
    }else{ 
        $rvalue = $rv;//小数为空，只有整数 
    }
    return $rvalue; 
}

//个数补齐成两位
function one_to_two($num) {
    return $num=sprintf ("%02d",$num);
}

//php打印console_log函数
function console_log($data){
    if(is_array($data) || is_object($data)){
        echo("<script>console.log('".json_encode($data)."');</script>");    
    }else{
        echo("<script>console.log('".$data."');</script>"); 
    }
}

//ajax_out
function ajax_out($arr,$code,$msg){
    header('Content-type:text/json');
    $data['code']= $code;
    $data['msg'] = $msg;
    $data['data'] = $arr;
    exit(json_encode($data,JSON_UNESCAPED_UNICODE));
}


function get_C($str){
    if(C($str)) return C($str);
}

function VerifyLoginServlet($geetest_challenge,$geetest_validate,$geetest_seccode){
    vendor("Geetest.Geetestlib");
    $GtSdk=new \GeetestLib(C('CAPTCHA_ID'), C('PRIVATE_KEY'));
    $data = array(
        "user_id" => session_id(), # 网站用户id
        "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
        "ip_address" => get_client_ip() # 请在此处传输用户请求验证时所携带的IP
    );
    if (session('gtserver')==1){//服务器正常
        $result = $GtSdk->success_validate($geetest_challenge,$geetest_validate,$geetest_seccode, $data);
        if ($result) {
            return true;
        } else{
            return false;
        }     
    }else {//服务器宕机,走failback模式
        $result = $GtSdk->success_validate($geetest_challenge,$geetest_validate,$geetest_seccode, $data);
        if ($result) {
            return true;
        } else{
            return false;
        }        
    }   
}


