<?php
//dump($nav_tree);
foreach ($nav_tree as $menu) {
    $json_url = json_decode($menu->menu_link, true);
    if (empty($json_url)) {
        $json_url = $menu->menu_link;
    }
    $title = '';
    $aopt = [];
    if (!empty($menu->children)) {
        $childClass = "class='dropdown'";
        $title = ' <b class="caret"></b>';
        $json_url = 'javascript:void(0);';
        $aopt['data-toggle'] = 'dropdown';
        $aopt['class'] = 'dropdown-toggle waves-effect waves-dark';
        $aopt['escape'] = false;
    }else{
        $aopt['class'] = ['waves-effect waves-dark'];
    }
    echo "<li " . (isset($childClass) ? $childClass : '') . " ><span>";
    echo $this->Html->link($menu->title . $title, $json_url, $aopt);
   // dump($json_url);
    echo "</span>";

    if(isset($json_url['controller']) && ($json_url['controller'] == "NewspostCategories" && $json_url['action'] == "packages")){
        echo $this->cell('NewsManager.News::getMenus',['conditions'=> ['is_top' => 1]]);
    }else if(isset($json_url['controller']) && ($json_url['controller'] == "Locations" && $json_url['action'] == "destinations")){
        echo $this->cell('LocationManager.Location::getLocMenus');
    }

    if (!empty($menu->children)) {
        $this->Custom->recurse($menu->children, '');
    }
    echo "</li>";
}

?>