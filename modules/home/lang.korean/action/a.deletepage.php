<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$R = getUidData($table['s_page'],$uid);

getDbDelete($table['s_page'],'uid='.$R['uid']);

unlink($g['path_page'].$R['id'].'.php');
unlink($g['path_page'].$R['id'].'.widget.php');

@unlink($g['path_page'].$R['id'].'.mobile.php');
@unlink($g['path_page'].$R['id'].'.css');
@unlink($g['path_page'].$R['id'].'.js');


if($_HS['startpage'] && $_HS['startpage'] == $R['uid'])
{
	getDbUpdate($table['s_site'],'startpage=0','uid='.$s);
}

db_query("OPTIMIZE TABLE ".$table['s_page'],$DB_CONNECT); 


getLink('reload','parent.','','');
?>