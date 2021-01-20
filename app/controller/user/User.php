<?php


namespace app\controller\user;


use app\BaseController;
use app\validate\UserValidate;

class User extends BaseController
{
    // --------------------------------- 验证器测试 ------------------------

    /**
     * 注册的参数验证
     * @return \think\response\Json
     */
    public function reg()
    {
        $data = $this->request->post();

        // 使用助手函数validate()或者是基类控制器的$this->validate()方法会抛出异常
        // 可以批量验证
        $validate = new UserValidate();

        if (!$validate->scene('reg')->check($data)) {
            return $this->resFail($validate->getError());
        }

        // TODO 注册的业务逻辑处理

        return $this->resSuccess($data);
    }

    /**
     * 登录的场景验证
     * @return \think\response\Json
     */
    public function login()
    {
        $data = $this->request->post();

        $validate = new UserValidate();

        if (!$validate->scene('login')->check($data)) {
            return $this->resFail($validate->getError());
        }

        // TODO 登录的业务逻辑处理

        return $this->resSuccess($data);
    }

    /**
     * 更新的场景验证
     * @return \think\response\Json
     */
    public function update()
    {
        $data = $this->request->post();

        $validate = new UserValidate();

        if (!$validate->scene('update')->check($data)) {
            return $this->resFail($validate->getError());
        }

        // TODO 更新的业务逻辑处理

        return $this->resSuccess($data);
    }

    public function delete()
    {
        $data = $this->request->post();

        $validate = new UserValidate();

        if (!$validate->scene('del')->check($data)) {
            return $this->resFail($validate->getError());
        }

        // TODO 删除的业务逻辑处理

        return $this->resSuccess($data);
    }

}