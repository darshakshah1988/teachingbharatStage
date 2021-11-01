<?php
foreach ($nav_tree as $menu) {
    $json_url = json_decode($menu->menu_link, true);
    if (empty($json_url)) {
        $json_url = $menu->menu_link;
    }
    $title = '';
    $aopt = [];
    if (!empty($menu->children)) {
        $childClass = "class='dropdown'";
        //$title = ' <b class="caret"></b>';
        //$json_url = 'javascript:void(0);';
        $aopt['data-toggle'] = 'dropdown';
        $aopt['class'] = 'dropdown-toggle';
        $aopt['escape'] = false;
    }else{
        $aopt['class'] = ['waves-effect waves-dark'];
        $aopt['escape'] = false;
    }
    echo "<li " . (isset($childClass) ? $childClass : '') . " >";
    echo $this->Html->link($menu->title . $title, $json_url, $aopt);
        if($menu->title == "Explore"){
                echo $this->cell('Cms.Navigations::boards');
        }else{
            if (!empty($menu->children)) {
                $this->Custom->recurse($menu->children, 'dropdown-menu');
            }
        }

    echo "</li>";
    if($menu->id == 63){
         echo $this->element('sessionsmenu');
    }
}

?>
