<?php

namespace app\common\model;

use think\Model;

class Album extends Model {
    public $page_info;
    /**
     * 计算数量
     * @author csdeshang
     * @param array $condition 条件
     * @return int
     */
    public function getAlbumpicCount($condition) {
        $result = db('album_pic')->where($condition)->count();
        return $result;
    }

    /**
     * 计算数量
     * @author csdeshang
     * @param array $condition 条件
     * @param string $table 表名
     * @return int
     */
    public function getCount($condition, $table = 'album_pic') {
        $result = db($table)->where($condition)->count();
        return $result;
    }

    /**
     * 获取单条数据
     * @author csdeshang
     * @param array $condition 条件
     * @param string $table 表名
     * @return array 一维数组
     */
    public function getOne($condition, $table = 'album_pic') {
        $resule = db($table)->where($condition)->find();
        return $resule;
    }

    /**
     * 分类列表
     * @author csdeshang
     * @param array $condition 查询条件
     * @param obj $page 分页页数
     * @param str $order 排序
     * @return array 二维数组
     */
    public function getAlbumclassList($condition, $page = '', $order = '') {
        $result = db('album_class')->where($condition)->order($order)->select();
        return $result;
    }

    /**
     * 计算分类数量
     * @author csdeshang
     * @param int id 相册id
     * @return array 一维数组
     */
    public function getAlbumclassCount($id) {
        return db('album_class')->where('store_id',$id)->count();
    }

    /**
     * 验证相册
     * @author csdeshang
     * @param array $condition 条件
     * @return bool 布尔类型的返回结果
     */
    public function checkAlbum($condition) {
        /**
         * 验证是否为有默认相册
         */
        $result = db('album_class')->where($condition)->select();
        if (!empty($result)) {
            unset($result);
            return true;
        }
        unset($result);
        return false;
    }

    /**
     * 图片列表
     * @author csdeshang
     * @param array $condition 查询条件
     * @param obj $page 分页页数
     * @param obj $field 字段名
     * @param obj $order 排序
     * @return array 二维数组
     */
    public function getAlbumpicList($condition, $page = '', $field = '*',$order='apic_id desc') {
        if($page){
            $result = db('album_pic')->where($condition)->field($field)->order($order)->paginate($page,false,['query' => request()->param()]);
            $this->page_info = $result;
            return $result->items();
        }else{
            $result = db('album_pic')->where($condition)->field($field)->order($order)->select();
            return $result;
        }
    }

    /**
     * 添加相册分类
     * @author csdeshang
     * @param array $data 参数内容
     * @return bool
     */
    public function addAlbumclass($data) {
        return db('album_class')->insertGetId($data);
    }

    /**
     * 添加相册图片
     * @author csdeshang
     * @param array $data 参数内容
     * @return bool
     */
    public function addAlbumpic($data) {
        $result = db('album_pic')->insertGetId($data);
        return $result;
    }

    /**
     * 更新相册分类
     * @author csdeshang
     * @param array $data 参数内容
     * @param int $id 相册id
     * @return bool
     */
    public function editAlbumclass($data, $id) {
        return db('album_class')->where('aclass_id', $id)->update($data);
    }

    /**
     * 更新相册图片
     * @author csdeshang
     * @param array $data 参数类容
     * @param int $condition 更新条件
     * @return bool
     */
    public function editAlbumpic($data, $condition) {
        $result = db('album_pic')->where($condition)->update($data);
       return $result;
    }

    /**
     * 删除分类
     * @author csdeshang
     * @param type $condition
     * @return type
     */
    public function delAlbumclass($condition) {
        return db('album_class')->where($condition)->delete();
    }

    /**
     * 根据店铺id删除图片空间相关信息
     * @author csdeshang
     * @param int $id 店铺id
     * @return bool
     */
    public function delAlbum($id) {
        $id = intval($id);
        db('album_class')->where('store_id', $id)->delete();
        $pic_list = $this->getAlbumpicList(array("store_id" => $id), '', 'apic_cover,store_id');
        
        $res=del_albumpic($pic_list);
        db('album_pic')->where('store_id', $id)->delete();
    }

    /**
     * 删除图片
     * @author csdeshang
     * @param string $id 图片id
     * @param int $store_id 店铺id
     * @return bool
     */
    public function delAlbumpic($condition) {
        $pic_list = $this->getAlbumpicList($condition, '', 'apic_cover,store_id');
        /**
         * 删除图片
         */
        $res = del_albumpic($pic_list);
        return db('album_pic')->where($condition)->delete();
    }

    /**
     * 查询单条分类信息
     * @author csdeshang
     * @param int $condition 查询条件
     * @return array 一维数组
     */
    public function getOneAlbumclass($condition) {
        return db('album_class')->where($condition)->find();
    }

    /**
     * 根据id查询一张图片
     * @author csdeshang
     * @param int $condition 查询条件
     * @return array 一维数组
     */
    public function getOneAlbumpicById($condition) {
        return db('album_pic')->where($condition)->find();
    }
    /**
     * 获取相册列表
     * @param type $condition
     * @param type $page
     * @param type $field
     * @return type
     */
    public function getGoodsalbumList($condition,$page,$field){
        if($page){
            $result = db('album_class')->alias('a')->where($condition)->join('__STORE__ s', 'a.store_id=s.store_id', 'LEFT')->field($field)->paginate($page, false, ['query' => request()->param()]);
            $this->page_info = $result;
            return $result->items();
        } else {
            return db('album_class')->alias('a')->where($condition)->join('__STORE__ s', 'a.store_id=s.store_id', 'LEFT')->field($field)->select();
        }        
    }
    /**
     * 获取相册图片数列表
     * @param type $condition
     * @param type $field
     * @param type $group
     * @return type
     */
    public function getAlbumpicCountlist($condition,$field,$group){
        return db('album_pic')->field($field)->group($group)->where($condition)->select();
    }

}
