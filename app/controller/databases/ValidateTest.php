<?php
//Author：王志祥
//说明：


namespace app\controller\databases;


use app\BaseController;
use app\validate\User;
use think\exception\ValidateException;
use think\facade\Validate;
use think\validate\ValidateRule;

class ValidateTest extends BaseController
{
    // 验证方式1，用tp5.1的验证方式
    /* 这种方式与下面的1,2,3都是支持场景验证的，具体用法为$validate->scene('reg')->check($data)，即验证reg场景
    具体详细用法参看官方文档，方式3的场景验证与方式1,2不太一致，查看源码即可推出具体的用法，4,5两种方式相当于独立验
    证，对于场景验证则没有实际意义。同时，这些都是支持批量验证的
    */
    public function validateTest1()
    {
        $data = $this->request->post();

        $validate = new User();//验证其的用法1

        if (!$validate->check($data)) {
            return $this->resFail('参数验证失败：'.$validate->getError());
        }

        return $this->resSuccess($data);
    }

    // 方式2，利用tp6.0的助手函数验证方式，会抛出异常，需要处理异常
    /*   使用validate()助手函数或者是基类控制器的$this->validate()方法均会抛出异常，因为在这两个方法里面已经默认抛出异常了,
    如果不想抛出异常，使用助手函数时则给定第四个参数为假，那么前三个参数也要给定，这是不方便的；如果使用基类的验证方法，可以选择
    改一下该方法。或者可以采用第一种方式实例化验证器的方式或者第五种方式门面模式调用的方式
    */
    public function validateTest2()
    {
        $data = $this->request->post();

        try{
             validate(User::class)->check($data);
        } catch (ValidateException $e) {
            return $this->resFail('参数验证失败：'.$e->getError());
        }

        return $this->resSuccess($data);
    }

    // 方式3，调用基类的验证器方法传入验证器类，会抛出异常，需要处理异常
    public function validateTest3()
    {
        $data = $this->request->post();

        try{
            $this->validate($data, User::class);
        } catch (ValidateException $e) {
            return $this->resFail('参数验证失败：'.$e->getError());
        }

        return $this->resSuccess($data);
    }

    // 方式4，调用基类的验证器方法自定义规则与提示消息,会抛出异常，需要处理异常
    public function validateTest4()
    {
        $data = $this->request->post();

        $rule = [
            'name|姓名'  => 'require|max:25',
            'age|年龄'   => 'number|between:1,120',
            'email|邮箱' => 'email',
        ];
//        $message = [
//            'name.require'  => '姓名必须的',
//            'age.require'   => '年龄不能为空',
//            'email.require' => '邮箱不能为空',
//            'name.max'      => '名称最多不能超过25个字符',
//            'age.number'    => '年龄必须是数字',
//            'age.between'   => '年龄只能在1-120之间',
//            'email'         => '邮箱格式错误',
//        ];


        try{
            //$this->validate($data, $rule, $message);
            $this->validate($data, $rule);
        } catch (ValidateException $e) {
            return $this->resFail('参数验证失败：'.$e->getError());
        }

        return $this->resSuccess($data);
    }

    // 方式5，门面方式，不会抛出异常信息
    public function validateTest5()
    {
        $data = $this->request->post();

//        $rule = [
//            'name|姓名'  => 'require|max:25',
//            'age|年龄'   => 'number|between:1,120',
//            'email|邮箱' => 'email',
//        ];

        $rule = [
            'name|姓名'  => ValidateRule::isRequire(null, '姓名必填')->max(25),
            'age|年龄'   => ValidateRule::isNumber(null, '年龄必须是数字')->between('1,100', '年龄在1-100之间'),
            'email|邮箱' => ValidateRule::isEmail(null, '邮箱格式不正确'),
        ];
//        $message = [
//            'name.require'  => '姓名必须的',
//            'age.require'   => '年龄不能为空',
//            'email.require' => '邮箱不能为空',
//            'name.max'      => '名称最多不能超过25个字符',
//            'age.number'    => '年龄必须是数字',
//            'age.between'   => '年龄只能在1-120之间',
//            'email'         => '邮箱格式错误',
//        ];

//        $validate = Validate::rule($rule)->message($message);
        $validate = Validate::rule($rule);

        if (!$validate->check($data)) {
            return $this->resFail('参数验证失败：'.$validate->getError());
        }

        return $this->resSuccess($data);
    }

    /**
     * 验证重复密码
     */
    public function validateTest6()
    {
        $data = $this->request->post();

        $rule = [
            'password|密码' => 'require|min:6|max:16',
            'repassword|重复密码' => 'require|confirm:password',
        ];

        $validate = Validate::rule($rule);

        if (!$validate->check($data)) {
            return $this->resFail('参数验证失败：'.$validate->getError());
        }

        return $this->resSuccess($data);
    }
}
