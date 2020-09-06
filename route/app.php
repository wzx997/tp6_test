<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');

Route::get('test', function () {
    $data = [
        'code' => 0,
        'msg' => 'tp6路由配置成功',
        'data' => []
    ];
    return json($data);
});

// 路由测试
Route::get('test2', 'databases.TestController/test1');

// 数据库测试
Route::post('getAllUser', 'databases.DataBasesTest/getAllUser');
Route::post('insertUser', 'databases.DataBasesTest/insertUser');
Route::post('updUser', 'databases.DataBasesTest/updUser');
Route::post('delUser', 'databases.DataBasesTest/delUser');
Route::post('selUser', 'databases.DataBasesTest/selUser');
Route::post('joinTest', 'databases.DataBasesTest/joinTest');

// 模型相关测试
Route::post('modelTest', 'databases.DataBasesTest/modelTest');
Route::post('modelJoinTest', 'databases.DataBasesTest/modelJoinTest');
Route::any('modelJoinTest2', 'databases.DataBasesTest/modelJoinTest2');

// 跨域测试，6.0的跨域已经解决了
Route::post('cors1', function () {
    $data = ['code' => 0, 'msg' => '跨域1', 'data' => []];
    return json($data);
});

Route::post('cors2', function () {
    $data = ['code' => 0, 'msg' => '跨域2', 'data' => []];
    return json($data);
});

Route::post('v1/cors3', function () {
    $data = ['code' => 0, 'msg' => '跨域3', 'data' => []];
    return json($data);
});

Route::post('v1/cors4', function () {
    $data = ['code' => 0, 'msg' => '跨域4', 'data' => []];
    return json($data);
});

//// 设置分组跨域
//Route::group('v1', function () {
//    Route::post('cors3', function () {
//        $data = ['code' => 0, 'msg' => '跨域3', 'data' => []];
//        return json($data);
//    });
//
//    Route::post('cors4', function () {
//        $data = ['code' => 0, 'msg' => '跨域4', 'data' => []];
//        return json($data);
//    });
//})->allowCrossDomain();

// 请求对象的测试
Route::post('reqTest1', 'databases.ReqController/reqTest1');
Route::post('reqTest2', 'databases.ReqController/reqTest2');
Route::post('reqTest3', 'databases.ReqController/reqTest3');
Route::post('reqTest4', 'databases.ReqController/reqTest4');

// 验证器测试
Route::post('validateTest1', 'databases.ValidateTest/validateTest1');
Route::post('validateTest2', 'databases.ValidateTest/validateTest2');
Route::post('validateTest3', 'databases.ValidateTest/validateTest3');
Route::post('validateTest4', 'databases.ValidateTest/validateTest4');
Route::post('validateTest5', 'databases.ValidateTest/validateTest5');
Route::post('validateTest6', 'databases.ValidateTest/validateTest6');

// 文件上传测试
Route::post('upload1', 'databases.UploadController/upload1');

//日志测试
Route::post('logTest', 'databases.LogTestController/logTest');

// 分页查询
Route::any('pageQuery1', 'databases.DataBasesTest/pageQuery1');
Route::any('pageQuery2', 'databases.DataBasesTest/pageQuery2');