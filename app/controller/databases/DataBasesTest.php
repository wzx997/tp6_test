<?php
//Author：王志祥
//说明：


namespace app\controller\databases;


use app\BaseController;
use app\model\User;
use think\facade\Db;
use think\facade\Log;
use think\facade\Validate;

class DataBasesTest extends BaseController
{
    public function getAllUser()
    {
        $user = Db::table('tp_user')->select();
//        $user = Db::table('tp_user')->find();
//        $user = Db::table('tp_user')->where('id', '=', 19)->find();
        return $this->resSuccess($user);
    }

    public function insertUser()
    {
        $data = [
            "username" => "蜡笔小新3",
            "password" => "123",
            "gender" => "男",
            "email" => "xiaoxin@163.com",
            "price" => "60.00",
            "details" => "123",
            "uid" => 1001,
            "status" => -1,
            "list" => ['name' => 'wzx', 'age' => 20]
        ];

        $dataAll = [
            [
                "username" => "蜡笔小新4",
                "password" => "123",
                "gender" => "男",
                "email" => "xiaoxin@163.com",
                "price" => "60.00",
                "details" => "123",
                "uid" => 1001,
                "status" => -1,
                "list" => []
            ],
            [
                "username" => "蜡笔小新5",
                "password" => "123",
                "gender" => "男",
                "email" => "xiaoxin@163.com",
                "price" => "60.00",
                "details" => "123",
                "uid" => 1001,
                "status" => -1,
                "list" => []
            ]
        ];

        // json字段的新增
        $res = Db::table('tp_user')->json(['list'])->insert($data);
//        $res = Db::table('tp_user')->data($data)->insert();
//        $res = Db::table('tp_user')->save($data);
//        $res = Db::table('tp_user')->insertAll($dataAll);

        if ($res) {
            return $this->resSuccess(['count' => $res], '新增成功');
        }

        return $this->resFail('新增失败');
    }

    public function updUser()
    {
//        Db::table('tp_user')
//            ->where('id', '=', 301)
//            ->update(['username' => '李嘿嘿']);

        Db::table('tp_user')
            ->save(['id' => 301, 'username' => '李嘿嘿2']);

        // json字段的更新
        $data['list->name'] = 'zzz';
        Db::table('tp_user')
            ->json(['list'])
            ->where('id', '=', '303')
            ->update($data);
        return $this->resSuccess([], '修改成功');
    }

    public function delUser()
    {
//        $res = Db::table('tp_user')->delete(307);
        $res = Db::table('tp_user')
            ->where('id', '=', 308)
            ->delete();


        if ($res) {
            return $this->resSuccess(['count' => $res], '删除成功');
        }

        return $this->resFail('删除失败');
    }

    public function selUser()
    {
        // where('create_time', '> time', '2019-01-01')等价于
        // ->whereTime('create_time', '>', '2019-01-01') 都会加上时分秒的时间
        // 但是不等价与where('create_time', '>', '2019-01-01')，这种不会加上时分秒的时间
//        $user = Db::table('tp_user')
//            ->where('create_time', '>', '2019-01-01')
//            ->select();

//        $user = Db::table('tp_user')
//            ->whereTime('create_time', '>', '2019-01-01')
//            ->select();

//        Db::name('tp_user')
//            ->whereTime('create_time', 'between', ['1970-10-1', '2000-10-1'])
//            ->select();

//        Db::name('tp_user')
//            ->whereBetweenTime('create_time', '1970-10-1', '2000-10-1')
//            ->select();

        // 查询今年的数据
//        Db::name('tp_user')
//            ->whereYear('create_time')
//            ->select();

        // 去年的数据
//        Db::name('tp_user')
//            ->whereYear('create_time', 'last year')
//            ->select();

//        Db::name('tp_user')
//            ->whereWeek('create_time', '2019-1-1')
//            ->select();

//        Db::name('tp_user')
//            ->whereTime('create_time', '-2 year')
//            ->select();

//        $map = [
//            ['username', 'like', 'thinkphp%'],
//            ['password', 'like', '%thinkphp'],
//            ['id', '>', 0],
//        ];
//        Db::table('tp_user')
//            ->where([$map])
//            ->where('status', 1)
//            ->select();

//        $map1 = [
//            ['username', 'like', 'thinkphp%'],
//            ['email', 'like', '%thinkphp'],
//        ];
//
//        $map2 = [
//            ['username', 'like', 'kancloud%'],
//            ['email', 'like', '%kancloud'],
//        ];
//
//        Db::table('tp_user')
//            ->whereOr([ $map1, $map2 ])
//            ->select();

        //// create_time不会被当成字符串看待
//        $user = Db::table('tp_user')
//            ->whereColumn('update_time','>','create_time')
//            ->select();

        // create_time会被当成字符串看待
//        $user = Db::table('tp_user')
//            ->where('update_time','>','create_time')
//            ->select();

        // 获取器查询数据
//        $user = Db::table('tp_user')
//            ->withAttr('status', function ($value) {
//                $status = [-3 => '删除中', -1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核', 3 => '审核'];
//                return $status[$value];})
//            ->field('id,username as name,email,status')
//            ->select()->toArray();

        // json 字段的查询
        $user = Db::table('tp_user')
            ->json(['list'])
            ->where('id', '=', 303)
            ->select();
//        var_dump($user);
//        var_dump(Db::getLastSql());
        return $this->resSuccess($user);
    }

    public function joinTest()
    {
//        $data = Db::table('tp_user u')
//            ->leftJoin('tp_profile p', 'p.user_id = u.id')
//            ->where('u.id', '=', '19')
//            ->field('u.username,u.gender,u.email,p.hobby')
//            ->select();

        $data = Db::table('tp_user u')
            ->leftJoin('tp_access a', 'a.user_id = u.id')
            ->leftJoin('tp_role r', 'a.role_id = r.id')
            ->where('r.id', '=', 1)
            ->field('u.username,u.gender,u.email,r.type')
            ->select();
        return $this->resSuccess($data);
    }

    #----------------------------------- 模型操作 -------------------------
    public function modelTest()
    {

                $data = User::where('id', '>', 19)->select();
//        $user = new User();
//        $data = [
//            "username" => "蜡笔小新4",
//            "password" => "123",
//            "gender" => "男",
//            "email" => "xiaoxin@163.com",
//            "price" => "60.00",
//            "details" => "123",
//            "uid" => 1001,
//            "status" => -1,
//            "list" => []
//        ];
//
//        $user->save($data);
        return $this->resSuccess($data);
    }

    public function modelJoinTest()
    {
        $data = User::withJoin('profile')->find(19);
        return $this->resSuccess($data);
    }

    //关联预载入
    public function modelJoinTest2()
    {
//        $list = User::select([19, 20, 21]);
//        foreach($list as $user){
//            // 获取用户关联的profile模型数据
//            dump($user->profile);
//        }

        $list = User::with(['profile'])->select([19, 20, 21]);
        foreach($list as $user){
            // 获取用户关联的profile模型数据
            dump($user->profile);
        }

    }

    public function pageQuery1()
    {
        $pageSize = $this->request->param('pageSize', 5);
        $pageNum = $this->request->param('pageNum', 1);

        $rule = [
            'pageSize|每页条数' => 'integer',
            'pageNum|页码数' => 'integer',
        ];

        $validate = Validate::rule($rule);
        if (!$validate->check(['pageSize' => $pageSize, 'pageNum' => $pageNum])) {
            return $this->resFail('参数验证失败：'.$validate->getError());
        }

        try {
            $data = Db::table('tp_user')
                ->field('id,username name,gender,email,status')
                ->withAttr('status', function ($value) {
                    $status = [-3 => '删除中', -1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核', 3 => '审核'];
                    return $status[$value];
                })
                ->page($pageNum, $pageSize)
                ->select();
            $total = Db::table('tp_user')->count();
        } catch (\Throwable $e) {
            Log::error('数据库查询失败'.$e->getMessage());
            return $this->resFail('查询失败：'.$e->getMessage());
        }

        return $this->resSuccess([
            'total' => $total,
            'data' => $data
        ]);
    }


    public function pageQuery2()
    {
        try {
            $data = Db::table('tp_user')
                ->field('id,username name,gender,email,status')
                ->withAttr('status', function ($value) {
                    $status = [-3 => '删除中', -1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核', 3 => '审核'];
                    return $status[$value];
                })
                ->paginate(5);
        } catch (\Throwable $e) {
            Log::error('数据库查询失败'.$e->getMessage());
            return $this->resFail('查询失败：'.$e->getMessage());
        }
        return $this->resSuccess($data);
    }
}