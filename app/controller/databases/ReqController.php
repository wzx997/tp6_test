<?php
//Author：王志祥
//说明：


namespace app\controller\databases;


use app\BaseController;
use think\Request;

class ReqController extends BaseController
{
    // 请求对象测试1，依赖注入获取请求对象
    public function reqTest1(Request $request)
    {
        return $this->resSuccess([
            'params' => $request->param(),
            'params.name' => $request->param('name'),
            'post' => $request->post(),
            'get' => $request->get(),
            'post.name' => $request->post('name'),
            'scheme' => $request->scheme(),
            'host' => $request->host()
        ]);
    }

    // 请求对象测试2，基类的对象
    public function reqTest2()
    {
        $request = $this->request;
        return $this->resSuccess([
            'params' => $request->param(),
            'params.name' => $request->param('name'),
            'post' => $request->post(),
            'get' => $request->get(),
            'post.name' => $request->post('name'),
        ]);
    }

    // 请求对象测试3，门面方式
    public function reqTest3()
    {
        return $this->resSuccess([
            'params' => \think\facade\Request::param(),
            'params.name' => \think\facade\Request::param('name'),
            'post' => \think\facade\Request::post(),
            'get' => \think\facade\Request::get(),
            'post.name' => \think\facade\Request::post('name'),
        ]);
    }

    // 请求对象测试4，助手函数
    public function reqTest4()
    {
        return $this->resSuccess([
            'params' => \request()->param(),
            'params.name' => \request()->param('name'),
            'post' => \request()->post(),
            'get' => \request()->get(),
            'post.name' => \request()->post('name'),
        ]);
    }
}