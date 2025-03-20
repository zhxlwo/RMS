<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;
use app\Model\Mold as mo;
use app\Model\Prob as pr;
use think\Request;

class Mold extends BaseController
{

    //渲染模具清单
    public function moldInfo()
    {
        $res = mo::with('parts')->select();
        foreach ($res as $key => $value) {
            foreach ($res as $key => $value) {
                // code...
                $med = explode("x",$value['mold_size']);
                $value['length'] = $med[0];
                $value['width'] = $med[1];
                $value['heigh'] = $med[2];
            $molds[$key] = $value;
            }
            // code...
               
        }
        // return json($res);
        view::assign('molds', $molds);
        // view::assign('STATIC', STATIC);
        return view::fetch();
    }


    //提交模具信息
    public function saveMold(Request $request)
    {
        //整理数据
        $med = $request->post();
        //去除空值
        foreach ($med as $key => $value) {
            if ($value==0|$value==NULL) {
            }else{
                $data[$key]=$value;
            }
        }
        if (!isset($data['mold_no'])) {
            $status = 0;
            $msg = "提交失败,模具号不能为空";
            return json(['msg'=>$msg,'status'=>$status]);
        }
        //模具号不为空则查找数据库
        $res = mo::where('mold_no', $data['mold_no'])->find();
        if ($res<>null) {
            //不存在则新增数据
            // 创建mold模型实例
            $mo = new mo;
            $data['mold_size'] = $mo ->setMoldSizeAttr(null,$data);
            // return json_encode($mold);
            /*//验证数据代码




            */

            // 保存模具信息到数据库
            // return json($data);
            //增加模具信息
            $mo = $data -> parts();
            return json_encode($data);
            $res = mo::update($data,['mold_no' => $data['mold_no']]);

            
            if (!$res) {
                // 保存失败
                $status = 0;
                $msg = '提交失败,请检查';
            } else {
                // 保存成功
                $status = 1;
                $msg = '更新数据成功';
            }
        }else{
            //新增模具信息数据
            $mo = new mo;
            $data['mold_size'] = $mo ->setMoldSizeAttr(null,$data);
            $mo -> data($data,true);
            //增加模具信息
            $mo -> parts();
            $res = $mo -> save();
            if (!$res) {
                // 保存失败
                $status = 0;
                $msg = '提交失败,请检查';
            } else {
                // 保存成功
                $status = 1;
                $msg = '提交成功';
            }

        }
        return json(['msg'=>$msg,'status'=>$status]);
    }


    //删除模具信息

    public function delMold(Request $request)
    {
        $med = $request->post();
        $res = mo::destroy($med["id"]);
        if (!$res) {
            // 保存失败
            $status = 0;
            $msg = '提交失败,请检查';
        }else{
            // 保存成功
            $status = 1;
            $msg = '提交成功,请检查';
        }
    }

        //渲染问题清单
    public function probList()
    {
        // code...
        $prob = pr::select();
        view::assign('probs',$prob);
        return view::fetch("mold/prob_list");
    }





    //渲染测试页面
    public function test()
    {
        return View::fetch('mold/test');
    }
    

}
