<?php
namespace models;
class Brand extends Model{
    protected $table = 'brand';
    protected $fillable = ['brand_name','logo'];

    public function _before_write(){
        $this->_delete_logo();
        //实现上传图片的代码
        $uploader = \libs\Uploader::make();
        $logo = '/uploads/' . $uploader->upload('logo','brand');
        $this->data['logo'] = $logo;
    }
    public function _before_delete(){
        $this->_delete_logo();
    }
    protected function _delete_logo(){
        //如果是修改就删除原图片
        if(isset($_GET['id'])){
            //先从数据库中取出原LOGO
            $ol = $this->findOne($_GET['id']);
            //删除
            @unlink(ROOT . 'public'. $ol['logo']);
        }
    }
}