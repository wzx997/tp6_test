<?php
//Author：王志祥
//说明：


namespace app\controller\databases;


use app\BaseController;
use \think\facade\Filesystem;

class UploadController extends BaseController
{
    // 文件上传
    public function upload1()
    {
        $file = $this->request->file('file');

//        $savename = Filesystem::putFile( 'topic', $file);
        $savename = Filesystem::disk('public')->putFile( 'topic', $file);
        if (!$savename) {
            return $this->resFail('上传失败');
        }
        return $this->resSuccess(['savename' => $savename],'上传成功');
    }
}