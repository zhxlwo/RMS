<?php
namespace app\index\validate;

use think\Validate;

class Image extends Validate
{
    protected $rule = [
        'image' => 'require|file|fileExt:jpg,png,gif|fileSize:1024000',
    ];

    protected $message = [
        'image.require' => '请选择图片',
        'image.file' => '非法的文件',
        'image.fileExt' => '非法的文件类型',
        'image.fileSize' => '图片大小不能超过1MB',
    ];
}
