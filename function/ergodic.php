<?php

foreach($arr  as $k=>$v){
    echo "
        <div class='list'>
        <h3>表名 : {$k}</h3>
        <!-- Table goes in the document BODY -->
        <table class='hovertable'>
                <tr>
                <th>字段名</th><th>数据类型</th><th>备注</th>
                </tr>
    ";
    foreach($v as $value){
    echo "
            <tr onmouseover='this.style.backgroundColor='#ffff66';' onmouseout='this.style.backgroundColor='#d4e3e5';'>
                <td>{$value['c_name']}</td><td>{$value['c_type']}</td><td>{$value['comment']}</td>
            </tr>
    ";
}
echo "
</table>
</div>
";
}