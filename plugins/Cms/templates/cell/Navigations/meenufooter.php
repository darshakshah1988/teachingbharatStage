<?php
//dump($nav_tree);
/*foreach ($nav_tree as $menu) {
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
    echo "<li " . (isset($childClass) ? $childClass : '') . " >";
    echo $this->Html->link($menu->title . $title, $json_url, $aopt);
    if (!empty($menu->children)) {
        $this->Custom->recurse($menu->children, 'dropdown-menu');
    }
    echo "</li>";
}
*/

foreach ($nav_tree as $menu) {
$json_url = json_decode($menu->menu_link, true);
    if (empty($json_url)) {
        $json_url = $menu->menu_link;
    }
   
?>
<div class="col-lg-3 col-md-6 ml-lg-auto">
            <h5 class="widget-title line-bottom"><?php echo $menu->title; ?></h5>
			<?php if (!empty($menu->children)) {
				$this->Custom->ftrrecurse($menu->children, 'links');
			} ?>
        </div>
		<?php } ?>