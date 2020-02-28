<?php 
namespace Admin\Controller;
use Common\Controller\BackendController;
class BannerController extends BackendController {
    public function _initialize(){
        parent::_initialize();
    }

    public function index(){
        $info_root = ROOT_PATH.'Application/Home/View/default/public/images/banner';
        $base_root = str_replace("\\", '/',$info_root);
        if(is_dir($base_root)){
            $file = scandir($base_root);
            unset($file[0]);
            unset($file[1]);
        }
        $imgUrl = [];
        foreach ($file as $k => $v) {
            $imgUrl[$k] = "/Application/Home/View/default/public/images/banner/".$v;
        }
        $this->assign('imgUrl',$imgUrl);
        $this->display();
    }

    public function edit(){
        $url = I("get.url");
        if(IS_POST){
            $url = I("post.url");
            if(empty($_FILES)){
                $this->error("未选择上传图片！");
            }
            //删除原来的图片
            $result = @unlink(ROOT_PATH.$url); 

            $upload = new \Common\ORG\UploadFile();
            $imgname = basename($url);

            $_FILES['banner']['name'] = $imgname;
            $upload->savePath = ROOT_PATH.str_replace(array($imgname), "", $url);
            $upload->saveRule = "";
            $request = $upload->uploadOne($_FILES['banner']);
            if(!$request){
                $this->error($upload->getErrorMsg());
            }else{
                $this->success('更换成功！');
            }
            return;
        }
        $this->assign('url',$url);
        $this->display();
    }

    public function add(){

        $info_root = ROOT_PATH.'Application/Home/View/default/public/images/banner';
        $base_root = str_replace("\\", '/',$info_root);
        if(is_dir($base_root)){
            $file = scandir($base_root);
            unset($file[0]);
            unset($file[1]);
        }
        $num = 0;//(int)(count($file)+1);

        foreach ($file as $k => $v) {
          //  $imgUrl[$k] = "/Application/Home/View/default/public/images/banner/".$v;
            if($k>1){
                $p = $k-1;
                $str1 = 'img'.$p.'.jpg';
                if($str1 == $v){
                    continue;
                }else{
                    $num = $p;
                    break;
                }
            }

        }
        if($num == 0){
            $num = (int)(count($file)+1);
        }
        $url = "/Application/Home/View/default/public/images/banner/img".$num.'.jpg';

      //  $url = I("get.url");
        if(IS_POST){
            $url = I("post.url");
            if(empty($_FILES)){
                $this->error("未选择上传图片！");
            }
            //删除原来的图片
        ///    $result = @unlink(ROOT_PATH.$url);

            $upload = new \Common\ORG\UploadFile();
            $imgname = basename($url);
            $_FILES['banner']['name'] = $imgname;
            $upload->savePath = ROOT_PATH.str_replace(array($imgname), "", $url);
            $upload->saveRule = "";
            $request = $upload->uploadOne($_FILES['banner']);
            if(!$request){
                $this->error($upload->getErrorMsg());
            }else{
                $this->success('添加成功！');
            }
            return;
        }
        $this->assign('url',$url);
        $this->display();

    }

    public function del(){
        $url = I('request.url');
        if ($url) {
            if ($result = @unlink(ROOT_PATH.$url)) {
                //统一写日志
             //   $this->admin_write_log_unify($ids);
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
                $this->success(L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
                $this->error(L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, '请选择要删除的内容！');
            $this->error('请选择要删除的内容！');
        }
    }

}
?>