<?php

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;
use app\Model\Part;

class Mold extends Model
{
    // 指定表名
    protected $table = 'mold_info';
    
    // 指定主键名
    protected $pk = 'id';
    
    //自动时间戳
    protected $autoWriteTimestamp = true;
    
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    //指定要转换的字段  
    protected $translatable = ['timestamp_field']; 

    //关联外键
    public function parts()
    {
        return $this->hasMany(Part::class,'id','part_no');
    }

    //长宽高修改器
    public function setMoldSizeAttr($value,$data)
    {
        $length = $data['length'] ?? 0;
        $width = $data['width'] ?? 0;
        $height = $data['height'] ?? 0;
        $moldSize  = $length . 'x' . $width . 'x' . $height;
        return $moldSize;
    }

     protected $rule = [
      'name'  => 'require|max:25',
      'age'   => 'number|between:1,120',
      'email' => 'email',
    ];

    protected $message = [
      'name.require' => '名称必须',
      'name.max'     => '名称最多不能超过25个字符',
      'age.number'   => '年龄必须是数字',
      'age.between'  => '年龄必须在1~120之间',
      'email'        => '邮箱格式错误',
    ];

}
