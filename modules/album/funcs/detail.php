<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Tue, 10 Nov 2020 06:56:08 GMT
 */

if (!defined('NV_IS_MOD_ALBUM')) {
    die('Stop!!!');
}

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$array_data = [];

$id = $nv_Request->get_int('id','get', 0);


if($id>0){
    $sql = "SELECT * FROM `nv4_album_product` WHERE id =" . $id;
    
    $result = $db->query($sql);
    
    //Không có dữ liệu chuyển về trang main
    if (!$row = $result->fetch()) {
        nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail');
    }
    
    $cate = "SELECT id,name FROM `nv4_album_product` where id= " .$row['album_id'];
    $row_cate = $db->query($cate)->fetch();
    
    //     print_r($row_cate);die();
    
    
    
    
}else{
    //Không có id thì chuyển về trang main
    nv_redirect_location(NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail');
}

//------------------
// Viết code vào đây
//------------------

$contents = nv_theme_album_detail($array_data);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
