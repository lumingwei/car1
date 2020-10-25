<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {

    //后台首页
    public function index(){
        $this->display(); // 输出模板
    }

    public function search_car(){
        $postArr['license_number'] = I('license_number','','trim');
        $postArr['chassis_number'] = I('chassis_number','','trim');
        $where = array();
        if(!empty($postArr['license_number'])){
            $where['license_number']  = array('like', "%{$postArr['license_number']}%");
        }
        if(!empty($postArr['chassis_number'])){
            $where['chassis_number']  = array('like', "%{$postArr['chassis_number']}%");
        }
        $company    = M('case'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
       //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $list[$k]['status'] = $v['status'] == 1?'已完结':'未完结';
            }
        }
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    public function search_people(){
        $postArr['car_owner'] = I('car_owner','','trim');
        $postArr['id_card'] = I('id_card','','trim');
        $where = array();
        if(!empty($postArr['car_owner'])){
            $where['car_owner']  = array('like', "%{$postArr['car_owner']}%");
        }
        if(!empty($postArr['id_card'])){
            $where['id_card']  = array('like', "%{$postArr['id_card']}%");
        }
        $company    = M('case'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $list[$k]['status'] = $v['status'] == 1?'已完结':'未完结';
            }
        }
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    public function search_company(){
        $postArr['company_name'] = I('company_name','','trim');
        $where = array();
        if(!empty($postArr['company_name'])){
            $where['company_name']  = array('like', "%{$postArr['company_name']}%");
        }
        $company    = M('case'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $list[$k]['status'] = $v['status'] == 1?'已完结':'未完结';
            }
        }
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    public function search_phone(){
        $postArr['car_owner_phone'] = I('car_owner_phone','','trim');
        $where = array();
        if(!empty($postArr['car_owner_phone'])){
            $where['car_owner_phone']  = array('like', "%{$postArr['car_owner_phone']}%");
        }
        $company    = M('case'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $list[$k]['status'] = $v['status'] == 1?'已完结':'未完结';
            }
        }
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }


    //新增/编辑案件
    public function add_case(){
        $id         = I('id',0,'intval');
        $pin_code   = I('pin_code','','trim');
        $from       = I('from','search_car','trim');
        if(!empty($id)){
            $info = M('case')->where(array('id'=>$id))->find();
        }
        if(!empty($pin_code)){
            $info = M('case')->where(array('pin_code'=>$pin_code))->find();
        }
        if(IS_AJAX){
            $company    = M('case');
            $data       = $company->create(); // 把无用的都顾虑掉了
            $data['danger_time'] = !empty($data['danger_time'])?strtotime($data['danger_time']):0;
            if($id){
                $ret        = $company->where(array('id'=>$id))->save($data);
            }else{
                $ret        = $company->add($data);
            }
            if($ret){
                $this->success('操作成功', U('index/'.$from));
            }else{
                $this->error('操作失败');
            }
        }else{
            !empty($info) && $info['danger_time'] = !empty($info['danger_time'])?date('Y-m-d',$info['danger_time']):'';
            $this->assign('info',!empty($info)?$info:array());
            $this->assign('from',$from);
        }
        $this->display(); // 输出模板
    }

    //新增/编辑案件
    public function look_case(){
        $id         = I('id',0,'intval');
        $pin_code   = I('pin_code','','trim');
        $from       = I('from','search_car','trim');
        if(!empty($id)){
            $info = M('case')->where(array('id'=>$id))->find();
        }
        if(!empty($pin_code)){
            $info = M('case')->where(array('pin_code'=>$pin_code))->find();
        }
        if(IS_AJAX){
            $company    = M('case');
            $data       = $company->create(); // 把无用的都顾虑掉了
            $data['danger_time'] = !empty($data['danger_time'])?strtotime($data['danger_time']):0;
            if($id){
                $ret        = $company->where(array('id'=>$id))->save($data);
            }else{
                $ret        = $company->add($data);
            }
            if($ret){
                $this->success('操作成功', U('index/'.$from));
            }else{
                $this->error('操作失败');
            }
        }else{
            !empty($info) && $info['danger_time'] = !empty($info['danger_time'])?date('Y-m-d',$info['danger_time']):'';
            $this->assign('info',!empty($info)?$info:array());
        }
        $this->display(); // 输出模板
    }

    //删除案件
    public function del_case(){
        $id   = I('id',0,'intval');
        $from = I('from','search_car','trim');
        if(empty($id)){
            $this->error('非法参数', U('index/'.$from));
        }
        $company    = M('case');
        $ret        = $company->where(array('id'=>$id))->delete();
        if($ret){
            $this->success('操作成功', U('index/'.$from));
        }else{
            $this->error('操作失败', U('index/'.$from));
        }
    }


    public function criminal_case(){
        $postArr['fraud_type']           = I('fraud_type',0,'intval');
        $postArr['company_name']         = I('company_name','','trim');
        $postArr['name']                  = I('name','','trim');
        $postArr['id_card']               = I('id_card','','trim');
        $where = array();
        if(!empty($postArr['company_name'])){
            $where['company_name']  = array('like', "%{$postArr['company_name']}%");
        }
        if(!empty($postArr['fraud_type'])){
            $where['fraud_type']  = $postArr['fraud_type'];
        }
        if(!empty($postArr['name'])){
            $where['name']  = array('like', "%{$postArr['name']}%");
        }
        if(!empty($postArr['id_card'])){
            $where['id_card']  = array('like', "%{$postArr['id_card']}%");
        }
        $company    = M('criminal_case'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $fraud_type_list   = M('fraud_type')->select();
        $company_list      = M('risk_company')->select();
        $company_list      = $this->tranKeyArray($company_list,'id');
        $fraud_type_list   = $this->tranKeyArray($fraud_type_list,'id');
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $list[$k]['fraud_type_name'] = !empty($fraud_type_list[$v['fraud_type']]['name'])?$fraud_type_list[$v['fraud_type']]['name']:'';
            }
        }
        $company_html    = $this->getCompanyHtml($postArr['company_id']);
        $fraud_type_html = $this->getFraudTypeHtml($postArr['fraud_type']);
        $this->assign('company_html',$company_html);
        $this->assign('fraud_type_html',$fraud_type_html);
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //新增/编辑刑事案件
    public function add_criminal_case(){
        $id = I('id',0,'intval');
        if(!empty($id)){
            $info = M('criminal_case')->where(array('id'=>$id))->find();
        }
        if(IS_AJAX){
            $company    = M('criminal_case');
            $data       = $company->create(); // 把无用的都顾虑掉了
            if($id){
                $ret        = $company->where(array('id'=>$id))->save($data);
            }else{
                $ret        = $company->add($data);
            }
            if($ret){
                $this->success('操作成功', U('index/criminal_case'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $company_html    = $this->getCompanyHtml($info['company_id']);
            $fraud_type_html = $this->getFraudTypeHtml($info['fraud_type']);
            $this->assign('company_html',$company_html);
            $this->assign('fraud_type_html',$fraud_type_html);
            $this->assign('info',!empty($info)?$info:array());
        }
        $this->display(); // 输出模板
    }

    //删除刑事案件
    public function del_criminal_case(){
        $id = I('id',0,'intval');
        if(empty($id)){
            $this->error('非法参数', U('index/criminal_case'));
        }
        $company    = M('criminal_case');
        $ret        = $company->where(array('id'=>$id))->delete();
        if($ret){
            $this->success('操作成功', U('index/criminal_case'));
        }else{
            $this->error('操作失败', U('index/criminal_case'));
        }
    }

    public function risk_car(){
        $postArr['brand_type']           = I('brand_type',0,'intval');
        $postArr['fraud_type']           = I('fraud_type',0,'intval');
        $postArr['license_number']       = I('license_number','','trim');
        $postArr['chassis_number']       = I('chassis_number','','trim');
        $postArr['vehicle_type']         = I('vehicle_type','','trim');
        $where = array();
        if(!empty($postArr['brand_type'])){
            $where['brand_type']  = $postArr['brand_type'];
        }
        if(!empty($postArr['fraud_type'])){
            $where['fraud_type']  = $postArr['fraud_type'];
        }
        if(!empty($postArr['license_number'])){
            $where['license_number']  = array('like', "%{$postArr['license_number']}%");
        }
        if(!empty($postArr['chassis_number'])){
            $where['chassis_number']  = array('like', "%{$postArr['chassis_number']}%");
        }
        if(!empty($postArr['vehicle_type'])){
            $where['vehicle_type']  = array('like', "%{$postArr['vehicle_type']}%");
        }
        $company    = M('risk_car'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $fraud_type_list   = M('fraud_type')->select();
        $brand_type_list   = M('brand_type')->select();
        $brand_type_list   = $this->tranKeyArray($brand_type_list,'id');
        $fraud_type_list   = $this->tranKeyArray($fraud_type_list,'id');
        if(!empty($list)){
            foreach ($list as $k=>$v){
                $list[$k]['fraud_type_name']    = !empty($fraud_type_list[$v['fraud_type']]['name'])?$fraud_type_list[$v['fraud_type']]['name']:'';
                $list[$k]['brand_type_name']    = !empty($brand_type_list[$v['brand_type']]['name'])?$brand_type_list[$v['brand_type']]['name']:'';
            }
        }
        $brand_type_html    = $this->getBrandTypeHtml($postArr['brand_type']);
        $fraud_type_html    = $this->getFraudTypeHtml($postArr['fraud_type']);
        $this->assign('brand_type_html',$brand_type_html);
        $this->assign('fraud_type_html',$fraud_type_html);
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //新增/编辑刑事案件
    public function add_risk_car(){
        $id = I('id',0,'intval');
        if(!empty($id)){
            $info = M('risk_car')->where(array('id'=>$id))->find();
        }
        if(IS_AJAX){
            $company    = M('risk_car');
            $data       = $company->create(); // 把无用的都顾虑掉了
            if($id){
                $ret        = $company->where(array('id'=>$id))->save($data);
            }else{
                $ret        = $company->add($data);
            }
            if($ret){
                $this->success('操作成功', U('index/risk_car'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $brand_type_html    = $this->getBrandTypeHtml($info['brand_type']);
            $fraud_type_html = $this->getFraudTypeHtml($info['fraud_type']);
            $this->assign('brand_type_html',$brand_type_html);
            $this->assign('fraud_type_html',$fraud_type_html);
            $this->assign('info',!empty($info)?$info:array());
        }
        $this->display(); // 输出模板
    }

    //删除刑事案件
    public function del_risk_car(){
        $id = I('id',0,'intval');
        if(empty($id)){
            $this->error('非法参数', U('index/criminal_case'));
        }
        $company    = M('criminal_case');
        $ret        = $company->where(array('id'=>$id))->delete();
        if($ret){
            $this->success('操作成功', U('index/criminal_case'));
        }else{
            $this->error('操作失败', U('index/criminal_case'));
        }
    }

    public function uploadImg(){
        $ret    = array('code'=>0,'url'=>'');
        $upFile = $_FILES['file'];
        //判断文件是否为空或者出错
        if ($upFile['error']==0 && !empty($upFile)) {
            $dirpath                = 'Public/static/img/' . date('Ym') . '/'; // 设置上传目录,相对路径
            if (is_dir($dirpath) || @mkdir($dirpath, 0766, true)) {
                if(!empty($_FILES['file']['name'])){
                    $tmp       = explode('.',$_FILES['file']['name']);
                    $type_name = end($tmp);
                    $filename = date('YmdHis').rand(1,100).'.'.$type_name;
                    $queryPath = $dirpath.$filename;
                    //move_uploaded_file将浏览器缓存file转移到服务器文件夹
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$queryPath)){
                        $ret['url']          = $queryPath;
                        $ret['code']         = 1;
                    }
                }
            }
        }
        echo json_encode($ret);
    }

    private function getCompanyHtml($select_id = 0){
        $select_id = !empty($select_id)?intval($select_id):0;
        $list   = M('risk_company')->select();
        $html   = '<select  name="company_id">';
        $html  .= '<option value="0">请选择</option>';
        if(!empty($list)){
            foreach ($list as $v){
                if($v['id'] == $select_id){
                    $html .= '<option value="'.$v['id'].'" selected>'.$v['name'].'</option>';
                }else{
                    $html .= '<option value="'.$v['id'].'">'.$v['name'].'</option>';
                }
            }
        }
        $html .= '</select>';
        return $html;
    }
    private function getFraudTypeHtml($select_id = 0){
        $select_id = !empty($select_id)?intval($select_id):0;
        $list   = M('fraud_type')->select();
        $html   = '<select  name="fraud_type">';
        $html  .= '<option value="0">请选择</option>';
        if(!empty($list)){
            foreach ($list as $v){
                if($v['id'] == $select_id){
                    $html .= '<option value="'.$v['id'].'" selected>'.$v['name'].'</option>';
                }else{
                    $html .= '<option value="'.$v['id'].'">'.$v['name'].'</option>';
                }
            }
        }
        $html .= '</select>';
        return $html;
    }
    private function getBrandTypeHtml($select_id = 0){
        $select_id = !empty($select_id)?intval($select_id):0;
        $list   = M('brand_type')->select();
        $html   = '<select  name="brand_type">';
        $html  .= '<option value="0">请选择</option>';
        if(!empty($list)){
            foreach ($list as $v){
                if($v['id'] == $select_id){
                    $html .= '<option value="'.$v['id'].'" selected>'.$v['name'].'</option>';
                }else{
                    $html .= '<option value="'.$v['id'].'">'.$v['name'].'</option>';
                }
            }
        }
        $html .= '</select>';
        return $html;
    }



    /*
     * 通讯录模块
     * risk_book
     */
    //列表
    public function risk_book(){
        $postArr['linkman']        = I('linkman','','trim');
        $postArr['company_name']   = I('company_name','','trim');
        $postArr['area_name']      = I('area_name','','trim');
        $where = array();
        if(!empty($postArr['linkman'])){
            $where['linkman']  = array('like', "%{$postArr['linkman']}%");
        }
        if(!empty($postArr['company_name'])){
            $where['company_name']  = array('like', "%{$postArr['company_name']}%");
        }
        if(!empty($postArr['area_name'])){
            $where['area_name']  = array('like', "%{$postArr['area_name']}%");
        }
        $company    = M('risk_book'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
       // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //新增
    public function add_risk_book(){
        $id       = I('id',0,'intval');
        if(!empty($id)){
            $info = M('risk_book')->where(array('id'=>$id))->find();
        }
        if(IS_AJAX){
            $user               = M('risk_book');
            $data               = $user->create(); // 把无用的都顾虑掉了
            if($id){
                $ret        = $user->where(array('id'=>$id))->save($data);
            }else{
                $ret        = $user->add($data);
            }
            if($ret){
                $this->success('操作成功', U('index/risk_book'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $this->assign('info',!empty($info)?$info:array());
        }
        $this->display(); // 输出模板
    }
    

    //删除
    public function del_risk_book(){
        $id = I('id',0,'intval');
        if(empty($id)){
            $this->error('非法参数', U('index/risk_book'));
        }
        $company    = M('risk_book');
        $ret        = $company->where(array('id'=>$id))->delete();
        if($ret){
            $this->success('操作成功', U('index/risk_book'));
        }else{
            $this->error('操作失败', U('index/risk_book'));
        }
    }


 /*
 * 风险人员
 * risk_people
 */
    //列表
    public function risk_people(){
        $postArr['name']        = I('name','','trim');
        $postArr['id_card']   = I('id_card','','trim');
        $postArr['phone']      = I('phone','','trim');
        $postArr['driving_licence']      = I('driving_licence','','trim');
        $where = array();
        if(!empty($postArr['name'])){
            $where['name']  = array('like', "%{$postArr['name']}%");
        }
        if(!empty($postArr['id_card'])){
            $where['id_card']  = array('like', "%{$postArr['id_card']}%");
        }
        if(!empty($postArr['phone'])){
            $where['phone']  = array('like', "%{$postArr['phone']}%");
        }
        if(!empty($postArr['driving_licence'])){
            $where['driving_licence']  = array('like', "%{$postArr['driving_licence']}%");
        }
        $company    = M('risk_people'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //新增
    public function add_risk_people(){
        $id       = I('id',0,'intval');
        if(!empty($id)){
            $info = M('risk_people')->where(array('id'=>$id))->find();
        }
        if(IS_AJAX){
            $user               = M('risk_people');
            $data               = $user->create(); // 把无用的都顾虑掉了
            if($id){
                $ret        = $user->where(array('id'=>$id))->save($data);
            }else{
                $ret        = $user->add($data);
            }
            if($ret){
                $this->success('操作成功', U('index/risk_people'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $this->assign('info',!empty($info)?$info:array());
        }
        $this->display(); // 输出模板
    }


    //删除
    public function del_risk_people(){
        $id = I('id',0,'intval');
        if(empty($id)){
            $this->error('非法参数', U('index/risk_people'));
        }
        $company    = M('risk_people');
        $ret        = $company->where(array('id'=>$id))->delete();
        if($ret){
            $this->success('操作成功', U('index/risk_people'));
        }else{
            $this->error('操作失败', U('index/risk_people'));
        }
    }


/*
* 风险机构
* risk_company
*/
    //列表
    public function risk_company(){
        $postArr['name']        = I('name','','trim');
        $postArr['id_card']   = I('id_card','','trim');
        $postArr['phone']      = I('phone','','trim');
        $postArr['driving_licence']      = I('driving_licence','','trim');
        $where = array();
        if(!empty($postArr['name'])){
            $where['name']  = array('like', "%{$postArr['name']}%");
        }
        if(!empty($postArr['id_card'])){
            $where['id_card']  = array('like', "%{$postArr['id_card']}%");
        }
        if(!empty($postArr['phone'])){
            $where['phone']  = array('like', "%{$postArr['phone']}%");
        }
        if(!empty($postArr['driving_licence'])){
            $where['driving_licence']  = array('like', "%{$postArr['driving_licence']}%");
        }
        $company    = M('risk_company'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //新增
    public function add_risk_company(){
        $id       = I('id',0,'intval');
        if(!empty($id)){
            $info = M('risk_company')->where(array('id'=>$id))->find();
        }
        if(IS_AJAX){
            $user               = M('risk_company');
            $data               = $user->create(); // 把无用的都顾虑掉了
            if($id){
                $ret        = $user->where(array('id'=>$id))->save($data);
            }else{
                $ret        = $user->add($data);
            }
            if($ret){
                $this->success('操作成功', U('index/risk_company'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $this->assign('info',!empty($info)?$info:array());
        }
        $this->display(); // 输出模板
    }


    //删除
    public function del_risk_company(){
        $id = I('id',0,'intval');
        if(empty($id)){
            $this->error('非法参数', U('index/risk_company'));
        }
        $company    = M('risk_company');
        $ret        = $company->where(array('id'=>$id))->delete();
        if($ret){
            $this->success('操作成功', U('index/risk_company'));
        }else{
            $this->error('操作失败', U('index/risk_company'));
        }
    }

/*
* 风险手机号
* risk_phone
*/
    //列表
    public function risk_phone(){
        $postArr['name']        = I('name','','trim');
        $postArr['phone']       = I('phone','','trim');
        $where = array();
        if(!empty($postArr['name'])){
            $where['name']  = array('like', "%{$postArr['name']}%");
        }
        if(!empty($postArr['phone'])){
            $where['phone']  = array('like', "%{$postArr['phone']}%");
        }
        $company    = M('risk_phone'); // 实例化User对象
        $count      = $company->where($where)->count();// 查询满足要求的总记录数
        $Page       = $this->getPage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
        //分页跳转的时候保证查询条件
        foreach($postArr as $key=>$val) {
            $Page->parameter[$key]   =   urlencode($val);
        }
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $company->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('postArr',$postArr);// 搜索参数
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板
    }

    //新增
    public function add_risk_phone(){
        $id       = I('id',0,'intval');
        if(!empty($id)){
            $info = M('risk_phone')->where(array('id'=>$id))->find();
        }
        if(IS_AJAX){
            $user               = M('risk_phone');
            $data               = $user->create(); // 把无用的都顾虑掉了
            if($id){
                $ret        = $user->where(array('id'=>$id))->save($data);
            }else{
                $ret        = $user->add($data);
            }
            if($ret){
                $this->success('操作成功', U('index/risk_phone'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $this->assign('info',!empty($info)?$info:array());
        }
        $this->display(); // 输出模板
    }


    //删除
    public function del_risk_phone(){
        $id = I('id',0,'intval');
        if(empty($id)){
            $this->error('非法参数', U('index/risk_phone'));
        }
        $company    = M('risk_phone');
        $ret        = $company->where(array('id'=>$id))->delete();
        if($ret){
            $this->success('操作成功', U('index/risk_phone'));
        }else{
            $this->error('操作失败', U('index/risk_phone'));
        }
    }

    //新增/编辑企业
    public function add_company(){
        $id = I('id',0,'intval');
        if(!empty($id)){
            $info = M('company')->where(array('id'=>$id))->find();
        }
        if(IS_AJAX){
            $company    = M('company');
            $data       = $company->create(); // 把无用的都顾虑掉了
            if($id){
                $ret        = $company->where(array('id'=>$id))->save($data);
            }else{
                $ret        = $company->add($data);
            }
            if($ret){
                $this->success('操作成功', U('index/company_list'));
            }else{
                $this->error('操作失败');
            }
        }else{
            $this->assign('info',!empty($info)?$info:array());
        }
        $this->display(); // 输出模板
    }

    //删除企业
    public function del_company(){
        $id = I('id',0,'intval');
        if(empty($id)){
            $this->error('非法参数', U('index/company_list'));
        }
        $company    = M('company');
        $ret        = $company->where(array('id'=>$id))->delete();
        if($ret){
            $this->success('操作成功', U('index/company_list'));
        }else{
            $this->error('操作失败', U('index/company_list'));
        }
    }

    public function json_return($data = array() , $code = 0 ,$msg = 'success'){
        $return = array('data'=>$data,'code'=>$code,'msg'=>$msg);
        $this->showJsonResult($return);
    }

    public function showJsonResult($data){
        header( 'Content-type: application/json; charset=UTF-8' );
        if (isset( $_REQUEST['callback'] ) ) {
            echo htmlspecialchars( $_REQUEST['callback'] ) , '(' , json_encode( $data ) , ');';
        } else {
            echo json_encode( $data, JSON_UNESCAPED_UNICODE );
        }

        die();
    }

}