<?php
header( 'content-type:text/html;charset=utf-8' );
$file =getcwd();
include_once($file.'/data/config.php');
$dsn = "mysql:dbname={$config['db']['name']};host={$config['db']['host']}";
$db_user = $config['db']['user'];
$db_pass = $config['db']['pass'];
try{
    $pdo = new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败 请配置数据库信息  配置路径： [ ./data/config.php ] <br/> 交流QQ: 907226763';exit();
}


//查询sql注释

$sql = "SELECT t.TABLE_NAME,t.TABLE_COMMENT,c.COLUMN_NAME,c.COLUMN_TYPE,c.COLUMN_COMMENT FROM information_schema.TABLES t,INFORMATION_SCHEMA.Columns c WHERE c.TABLE_NAME=t.TABLE_NAME AND t.`TABLE_SCHEMA`='{$config['db']['name']}'";

$res=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);



$table_name = '';
$arr = array();
foreach($res as $key=>$row){ 
   if($table_name != $row['TABLE_NAME']){
        $table_name = $row['TABLE_NAME'];
        $arr[$row['TABLE_NAME']][$key]['comment'] =  $row['COLUMN_COMMENT'];//字段注释
        $arr[$row['TABLE_NAME']][$key]['c_name'] =  $row['COLUMN_NAME'];//字段名
        $arr[$row['TABLE_NAME']][$key]['c_type'] =  $row['COLUMN_TYPE'];//字段类型

   }else{
    //同上
    $arr [$table_name][$key]['comment'] = $row['COLUMN_COMMENT'];
    $arr [$table_name][$key]['c_name'] = $row['COLUMN_NAME'];
    $arr [$table_name][$key]['c_type'] = $row['COLUMN_TYPE'];
//array_push($arr,$arr_to);
   }
}
foreach($arr  as $k=>$v){
    $arr[$k] = array_values($v);
}