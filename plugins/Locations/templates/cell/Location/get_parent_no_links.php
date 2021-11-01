<?php
if (!empty($records)) {
    foreach ($records AS $key => $val) {
        if($key!=$id){
        $parentLinks[] = $val;
        }
    }
}
echo !empty($parentLinks) ? implode(' > ', $parentLinks)  : '';
