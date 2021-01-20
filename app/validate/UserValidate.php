<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class UserValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'id|用户ID' => 'require',
        'username|用户名' => 'require|length:1,20',
        'password|密码' => 'require|length:6,20',
        'email|邮箱' => 'require|email',
        'mobile|手机号' => 'require|mobile'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];

    /* 场景验证，复用验证规则，但是对于验证规则不一致的需要单独考虑，例如：
     * 对于更新场景，可能不需要验证邮箱与手机号是否必填，但是需要验证若填了
     * 这些字段数据是否满足特定的格式要求，这时就需要单独考虑更新的场景验证了或者用独立验证
    */
    protected $scene = [
        'reg' => ['username', 'password', 'email', 'mobile'],
        'login' => ['username', 'password'],
        'del' => ['id']
    ];

    /**
     * 更新的场景验证，不能在上面指定，因为email和mobile是需要移除必填属性的
     * @return mixed
     */
    public function sceneUpdate()
    {
        return $this->only(['id', 'email', 'mobile'])
            ->remove('email', 'require')
            ->remove('mobile', 'require');
    }
}
