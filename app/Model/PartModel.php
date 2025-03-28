<?php

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;
use app\Model\ProjModel as pj;

class PartModel extends Model
{
    // 指定表名
    protected $table = 'rms_part_info';
    
    // 指定主键名
    protected $pk = 'id';
    
    //自动时间戳
    protected $autoWriteTimestamp = true;
    
    //软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';

    //关联外键
    public function proj()
    {
        return $this->belongsTo(Pj::class,'proj_id');
    }
}
