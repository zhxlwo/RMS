<?php

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;
use app\Model\PartModel as pa;
use app\Model\CustomModel as cu;

class ProjModel extends Model
{
    // 指定表名
    protected $table = 'rms_proj_info';
    
    // 指定主键名
    protected $pk = 'id';
    
    //自动时间戳
    protected $autoWriteTimestamp = true;
    
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    //关联外键
    public function projs()
    {
        return $this->hasMany(pa::class,'part_id','id');
    } 
    //关联外键
    public function custom()
    {
        return $this->belongsTo(cu::class,'customer_no','id');
    }



}
