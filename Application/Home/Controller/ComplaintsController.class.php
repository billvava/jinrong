<?php
namespace Home\Controller;
use Common\Controller\FrontendController;
class ComplaintsController extends FrontendController{
	public function _initialize() {
        parent::_initialize();
    }

    //举报投诉
    public function complaints($name_id='',$info_id=''){
        if(IS_POST){
            // 编号
            $data['number'] = date('YmdHis');
            // 投诉理由
            $data['content'] = I("post.content");
            // 被投诉者
            $data['name_id'] = I("post.name_id");
            //发起时间
            $data['addtime'] = time();
            //倒计时
            $data['login_id'] = C('visitor.uid');
            $path = "/data/upload/complaints/{yy}{mm}/{dd}/";
            $d = explode('-', date("y-m-d-H-i-s"));
            $path = str_replace("{yy}", $d[0], $path);
            $path = str_replace("{mm}", $d[1], $path);
            $path = str_replace("{dd}", $d[2], $path);
            if(!is_dir($path)){
                mkdir($path);
            }
            $data['field_url'] = $path.$_FILES['file']['name']; 
            $where['name_id'] = $data['name_id'];
            $where['login_id'] = $data['login_id'];
            $res = M('complaints')->where($where)->find();
            if(!$res){
               $res2 = M('complaints')->add($data);
               if (!$res2) {
                   $this->error("添加失败");
               }
            }else{
                $this->error("已经举报过了",U('Personal/complaints_send'));
            }
            $upload = new \Common\ORG\UploadFile();
            $upload->savePath = ROOT_PATH.$path;
            $upload->saveRule = "";
            $request = $upload->uploadOne($_FILES['file']);
            if(!$request){
                $this->error($upload->getErrorMsg());
            }else{
                $this->success('投诉成功',U('Personal/complaints_send'));
            }
            return;           
        }
        $info = M('BaseInfo')->field('title')->where(['id'=>$info_id])->find();
        $title = $info['title'];
        $this->assign('title',$title);
        $this->assign('name_id',$name_id);
        $this->display();
    }

}
?>
