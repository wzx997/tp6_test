<?php
//Author：王志祥
//说明：


namespace app\controller\databases;


use app\BaseController;
use think\Exception;
use think\facade\Db;
use think\facade\Log;

class LogTestController extends BaseController
{

    public function logTest()
    {
        try {
//            $data = Db::table('tp_user')
//                ->field('ss') //字段不存在的时候会报500错误，不知道这是不是一个bug
//                ->select();
            $data = [
                "username" => "蜡笔小新3",
                "password" => "123",
                "gender" => "男",
                "email" => "xiaoxin@163.com",
                "price" => "60.00",
                "details" => "123",
                "uid" => 1001,
                "status" => 'sss',
                "list" => []
            ];
            Db::table('tp_user')->data($data)->insert();
        } catch (\Exception $e) {
            Log::error('数据库查询异常'.$e->getMessage().$e->getFile());
            return $this->resFail('查询失败'.$e->getMessage());
        }

        return $this->resSuccess($data);
    }
}