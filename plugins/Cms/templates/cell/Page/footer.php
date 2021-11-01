<?php if(!empty($page)){
	echo $this->Text->truncate(strip_tags($page->description), 220, ['ellipsis' => '...','exact' => false]); 
 } ?>