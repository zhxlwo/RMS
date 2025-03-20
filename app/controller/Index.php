<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;
use app\index\model\User as us;
use think\facade\session;
use think\Request;

class Index extends BaseController
{
     public function index()
    {
        return view::fetch('index');
    }

     public function login()
    {
        return view::fetch('login');
    }

    //登录验证
    public function signIn(Request $request)
    {
        $status = 0; //验证失败标志
        $result = '验证失败'; //失败提示信息
        $data = $request -> param(false);
        // $data['ss00000'] = $_POST["password"];
        return json($data);

        //验证规则
        $rule = [
            'name|姓名' => 'require',
            'password|密码'=>'require',
            // 'captcha|验证码' => 'require|captcha'
        ];

        //验证数据 $this->validate($data, $rule, $msg)
        $res = $this -> validate($data, $rule);

        //通过验证后,进行数据表查询
        //此处必须全等===才可以,因为验证不通过,$result保存错误信息字符串,返回非零
        if (true === $res) {
            //查询条件
            $map = [
                'name' => $data['name'],
                'password' => md5($data['password'])
            ];

            //数据表查询,返回模型对象
            $user = us::get($map);
            if (null === $user) {
                $msg = '没有该用户,请检查';
            } else {
                $status = 1;
                $msg = '验证通过,点击[确定]后进入后台';

                //创建2个session,用来检测用户登陆状态和防止重复登陆
                Session::set('user_id', $user -> id);
                Session::set('user_info', $user -> getData());

                //更新用户登录次数:自增1
                $user -> setInc('login_count');
            }
        } else {
          $mes = $res;
          $status = 0;
        }
        return ['status'=>$status, 'msg'=>$msg, 'data'=>$data];
    }

      public function test()
    {
       return view::fetch('test');
    } 
/*     public function index()
    {
       return '<style>*{ padding: 0; margin: 0; }</style><iframe src=https://www.thinkphp.cn/welcome?version="' . \think\facade\App::version() . '" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>';
    } */
    public function hello($name = 'ThinkPHP8')
    {
        return 'hello,' . $name;
    }
}
