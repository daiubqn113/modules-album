<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Tue, 10 Nov 2020 06:56:08 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['main'];

$post =[];
$error=[];


$post['id'] = $nv_Request->get_int('id', 'post, get', 0);


if($nv_Request->isset_request("submit", "post")){
    //
    $post['album_id'] = $nv_Request->get_title('album_id', 'post', '');
    $post['status'] = $nv_Request->get_int('status', 'post', 1);
    $post['content'] = $nv_Request->get_title('content', 'post', '');
    $post['name_user'] = $nv_Request->get_title('name_user', 'post', '');
    
    if(isset($_FILES, $_FILES['img'], $_FILES['img']['tmp_name']) and is_uploaded_file($_FILES['img']['tmp_name'])){
        // Khởi tạo Class upload
        $upload = new NukeViet\Files\Upload($admin_info['allow_files_type'], $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT);
        
        // Thiết lập ngôn ngữ, nếu không có dòng này thì ngôn ngữ trả về toàn tiếng Anh
        $upload->setLanguage($lang_global);
        
        // Tải file lên server
        if (empty($error)) {
            $upload_info = $upload->save_file($_FILES['img'], NV_UPLOADS_REAL_DIR . '/album', false, $global_config['nv_auto_resize']);
            //         echo '<pre><code>';
            //         echo htmlspecialchars(print_r($upload_info, true));
            //         die();
        }
        
        if ($upload_info['error'] == '' && empty($error)) {
            $image = new NukeViet\Files\Image(NV_UPLOADS_REAL_DIR . '/album' . '/' . $upload_info['basename'], NV_MAX_WIDTH, NV_MAX_HEIGHT);
            
            $image->resizeXY(400, 400);
            $newname = NV_CURRENTTIME . '_' . $upload_info['basename'];
            $quality = 80;
            $image->save(NV_UPLOADS_REAL_DIR . '/album' . '/', $newname, $quality);
            $image->close();
            $info = $image->create_Image_info;
            //lấy biến
            $image = $newname;
        } else {
            $error[]= $lang_module['error'];
        }
    }
    
    if (empty($post['album_id']))
    {
        $error[]= $lang_module['album_id'];
    }


    
    if (empty($post['name_user']))
    {
        $error[]= $lang_module['error_name_user'];
    }
    
    if (empty($image))
    {
        $error[]= $lang_module['error_img'];
    }
    
    if (empty($post['content']))
    {
        $error[]= $lang_module['error_content'];
    }
    
    
    if(empty($error)){
        if($post['id'] > 0){
            //update
            $sql = "UPDATE `nv4_album` SET `album_id`=:album_id,`img`=:img,`content`=:content,`name_user`=:name_user, `status`=:status WHERE id=".$post['id'];
            $s = $db->prepare($sql);
        }else {
            //insert
            $sql = "INSERT INTO `nv4_album_product`( `album_id`, `img`, `content`, `name_user`, `create_at`, `status`) VALUES (:album_id, :img, :content, :name_user, :create_at, :status)";
            $s = $db->prepare($sql);
            $s->bindValue('create_at', NV_CURRENTTIME);
            
        }
        
        $s->bindParam('album_id', $post['album_id']);
        $s->bindParam('img', $image);
        $s->bindParam('content', $post['content']);
        $s->bindParam('name_user', $post['name_user']); 
        $s->bindParam('status', $post['status']);
        $exe = $s->execute();
        if($exe){
            if($post['id'] > 0){
                $error[]= $lang_module['succ_U'];
            }else{
                $error[]= $lang_module['succ_I'];
            }
            
        }else{
            $error[]= $lang_module['error'];
        }
        
    }
}else if($post['id'] > 0){
    $sql="SELECT * FROM `nv4_album_product` where id=".$post['id'];
    $post=$db->query($sql)->fetch();
}

//------------------------------
// Viết code xử lý chung vào đây
//------------------------------

$xtpl = new XTemplate('add_album_product.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('POST', $post);


$album = "SELECT id,title_album FROM `nv4_album`";
$album_i = $db->query($album);
foreach ($album_i as $data)
{
    $data['selected'] = $data['id'] == $post['album_id'] ? 'selected' : '';
    $xtpl->assign('DATA', $data);
    $xtpl->parse('main.data');
}
if (!empty($error)) {
    $xtpl->assign('ERROR', implode("<br>", $error));
    $xtpl->parse('main.error');
}

//-------------------------------
// Viết code xuất ra site vào đây
//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
