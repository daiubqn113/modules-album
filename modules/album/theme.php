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

/**
 * nv_theme_album_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_album_main($array_data)
{
    global $module_info, $lang_module, $lang_global, $op, $module_name ;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    
    if (!empty($array_data)) {
        $i = 1;
        foreach ($array_data as $row){
            $row['stt'] = $i;
            $row['status'] = !empty($array_active[$row['status']]) ? $array_active[$row['status']] : '';
            $row['img'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $row['img'];
            $row['url_detail'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=detail&amp;id=' . $data['id'];

            $xtpl->assign('ROW', $row);
            $xtpl->parse('main.loop');
            $i++;
        }
    }

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_album_detail()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_album_detail($array_data)
{
    global $module_info, $lang_module, $lang_global, $op, $module_name;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    
    $row['price'] = number_format($row['price']);
    $row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $row['image'];
    
    $xtpl->assign('ROW', $row);
    
    $xtpl->assign('ROW_CATE', $row_cate);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_album_search()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_album_search($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}
