<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;
use app\Model\partInfo as pa;
use app\Model\Proj as pj;
use app\Model\Prob as pb;
use app\Model\MoldInfo;

/**
 * 	
 */
class Info extends BaseController
{
		public function partsInfo()
		{
		//渲染产品信息
		$parts = pa::select();
		// return json($parts);
		view::assign('parts',$parts);
		return	view::fetch();
		}


		public function supInfo()
		{
		//渲染产品信息
		$parts = pa::select();
		view::assign('parts',$parts);
		return	view::fetch();
		}


		public function custInfo()
		{
		//渲染产品信息
		$parts = pa::select();
		view::assign('parts',$parts);
		return	view::fetch();
		}

		public function projInfo()
		{
		//渲染产品信息
		$projects = pj::select();
		view::assign('projects',$projects);
		return	view::fetch();
		}


		public function machInfo()
		{
		//渲染产品信息
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