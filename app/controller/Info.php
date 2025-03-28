<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;
use app\Model\PartModel as pa;
use app\Model\ProjModel as pj;
use app\Model\CustomModel as cu;

/**
 * 	
 */
class Info extends BaseController
{
		public function partsInfo()
		{
		//渲染产品信息
		$parts = pa::with("proj")->select();
		view::assign('parts',$parts);
		return	view::fetch();
	}
	
	
	public function supInfo()
	{
		//渲染供应商信息
		$parts = pa::select();
		view::assign('parts',$parts);
		return	view::fetch();
	}
	
	
	public function custInfo()
	{
		//渲染客户信息
		$res = cu::where('style' , 1 ) -> select();
		// return json($res);
		view::assign('res',$res);
		return	view::fetch();
		}

	public function projInfo()
		{
		//渲染项目信息
		$projects = pj::with("custom") ->select();
		view::assign('projects',$projects);
		return	view::fetch();
	}


	public function machInfo()
	{
		//渲染设备信息
		$parts = pa::select();
		view::assign('parts',$parts);
		return	view::fetch();
	}


	public function storInfo()
	{
		//渲染产品信息
		$parts = pa::select();
		view::assign('parts',$parts);
		return	view::fetch();
	}

	public function userInfo()
	{
		//渲染产品信息
		$parts = pa::select();
		view::assign('parts',$parts);
		return	view::fetch();
	}

}


?>