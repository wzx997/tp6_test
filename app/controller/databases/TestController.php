<?php

namespace app\controller\databases;

use app\BaseController;
use think\facade\Db;


class TestController extends BaseController
{
    public function test1()
    {
        return $this->resSuccess();
    }
}
