<?php
if (!empty($records)) {
    foreach ($records AS $key => $val) {
        if($key!=$id){
        $parentLinks[] = $this->Html->link($val, ['controller' => 'Locations','action' => 'view', $key, 'plugin' => 'Locations']);
        }
    }
}
echo !empty($parentLinks) ? implode(' > ', $parentLinks)  : 'N/A';
