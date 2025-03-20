<?php
namespace app\controller;
use app\BaseController;
use think\facade\View;
use think\facade\Db;
use think\Request;

class Show extends BaseController
{

//渲染开始页面
    public function show()
    {
        return View::fetch('upload/show1');
        // return phpinfo();
    }



    public function test(){
    return View::fetch('upload/test');
    // return phpinfo();
    }


    public function getImages(Request $request)
	{
         $date = strtotime($request->param('date'));
    // $startDate = input('start_date');
    // $endDate = input('end_date');
    // 执行查询操作，获取图片路径数据
    $images = Db::name('index')
            ->where('date_shot', $date)
            ->order('position')
            ->select();

    // 构建响应数据
    $response = [
        'success' => true,
        'data' => $images
    ];

    // 返回JSON格式的响应数据
    return json($response);
	}










}















?>