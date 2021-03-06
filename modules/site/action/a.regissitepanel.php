<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$id = trim($id);
$name = trim($name);
$title = trim($title);

if ($site_uid)
{
	$ISID = getDbData($Table['s_site'],"uid<>".$site_uid." and id='".$id."'",'*');
	if ($ISID['uid']) getLink('','',_LANG('a7001','site'),'');

	// 사이트코드가 없을 경우는 usescode를 0(false)로 셋팅하고, 있을 경우 usescode를 1로 셋팅한다.
	if (empty($id)){ $usescode = 0;
	}else { $usescode = 1; };

	$QVAL = "id='$id',name='$name',title='$title',layout='$layout',startpage='$startpage',m_layout='$m_layout',m_startpage='$m_startpage',open='$open'";
	getDbUpdate($table['s_site'],$QVAL,'uid='.$site_uid);

	if ($_HS['id'] != $id)
	{
		rename($g['path_page'].$_HS['id'].'-menus',$g['path_page'].$id.'-menus');
		rename($g['path_page'].$_HS['id'].'-pages',$g['path_page'].$id.'-pages');
	}
}

if ($_HS['id'] != $id || $_HS['name'] != $name)
{
	getLink($g['s'].'/?r='.$id.'&panel=Y&_admpnl_='.urlencode($referer),'parent.parent.',_LANG('a0004','site'),'');
}
else {
	getLink('reload','parent.frames._ADMPNL_.',_LANG('a0004','site'),'');
}
?>