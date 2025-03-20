<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Request;
use think\facade\Filesystem;
use think\Image;
use think\Validate;
use think\facade\Db;
use app\index\model\Image as ImageModel;
use think\Controller;

class Upload extends BaseController
{   
    //渲染开始页面
    public function index()
    {
        return View::fetch('upload/index');
        // return phpinfo();
    }

    //渲染上传页面
    public function start()
    {
        return View::fetch('upload/upload');
        // return phpinfo();
    }


    //上传对象
    public function upload()
    {
        // 获取上传的文件对象
        $file = Request::file('image');
        $date = strtotime($this->request->post('date'));
        $mold = $this->request->post('mold');
        $position = $this->request->post('position');
        $imageIndex = $this->request->post('imageIndex');
        // 验证图片类型和大小
        $validate = $this->validate(
            ['image' => $file],
            ['image' => 'require|image|fileSize:10240000'],
            ['image.require' => '请选择图片', 'image.image' => '非法的图片文件', 'image.fileSize' => '图片大小不能超过10MB']
        );

        if ($validate !== true) {
            return $validate;
        }

        // 移动文件到指定目录（app/upImage目录下）
        $savePath = '../app/upImage';
        $name = time();
        $saveName = $name . '.' . $file->extension();
        $info = $file->move($savePath, $saveName);
         
        if ($info) {
            // 文件上传成功;
            $data = [
            'filepath_file' => $name,
            'mould_number' => $mold,
            'date_shot' => $date,
            'position' => $position,
            'order_image' => $imageIndex,
            'date_up' => time(),
            'ext' => $file->extension(),
            ];

        $result = Db::name('index')->insert($data);
            return '文件上传成功，文件路径：' . time();
        } else {
            // 文件上传失败
            return $file->getError();
        }
    }
   /* private function generateThumbnail($filePath)
    {
        // 打开原始图片
        $image = Image::open('.' . $filePath);

        // 生成缩略图的宽度和高度
        $thumbnailWidth = 200;
        $thumbnailHeight = 200;

        // 生成缩略图并保存
        $thumbnailPath = dirname($filePath) . '/thumbnail_' . basename($filePath);
        $image->thumb($thumbnailWidth, $thumbnailHeight)->save('.' . $thumbnailPath);

        return $thumbnailPath;
    }*/

    public function test()
    {
        $result = Db::table('im_index')->where('id',1)->find();

        foreach ($result as $row) {
        // 处理每一行数据
        // 例如，输出每一行的某个字段值
        echo $row['name_file'] . '<br>';
        }
        echo 'sb'.'<br>';
    }

    //渲染上传页面
    public function submits()
    {
        return View::fetch('upload/submit');
        // return phpinfo();
    }

    // 处理表单提交的方法
    public function submit(Request $request)
    {
        // 获取表单提交的数据
        $name = $request->post('name');
        $age = $request->post('age');
        $gender = $request->post('gender');

        // 将数据存入数据库
        $data = [
            'name_file' => $name,
            'age' => $age,
            'gender' => $gender,
        ];
        $re = Db::name('index')->where('id', 0)->find();

        $result = Db::name('index')->insert($data);

        // 判断数据是否成功插入
        if ($result) {
            return '数据保存成功';
        } else {
            return '数据保存失败';
        }
    }











}
