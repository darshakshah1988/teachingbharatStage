<?php
//dump($nav_tree);
if(!empty($boards->toArray())){
    echo "<ul class='dropdown-menu'>";
    foreach ($boards as $menu) {
        echo "<li>";
        echo $this->Html->link($menu->title, 
                ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'index', '?' => ['boards[]' => $menu->id]]
            );    
        echo "</li>";
    }
    echo "</ul>";
}


?>