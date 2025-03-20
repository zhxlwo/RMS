<?php
namespace app\controller;

use think\BaseController;
use think\facede\View;
use app\Model\Prob as pr;
use think\Request;
/**
 * 问题表
 */
class Prob extends BaseController
{
	//渲染问题清单
	public function probInfo()
	{
		// code...
		$prob = pr::select();
		view::assign('probs',$prob);
		return view::fetch();
	}

    //渲染测试页面
    public function test()
    {
        return View::fetch('mold/test');
    }
    


}