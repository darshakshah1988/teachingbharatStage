<?php
use Cake\Core\Configure;
if($this->request->getParam('action') != 'profile'){
?>
<li class="dropdown parent">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Session</a>

<ul class="child">
<li><a href="/micro-sessions/micro-sessions/landing">Micro Sessions</a></li>
<?php /*?> <li class="dropdown parent"><a href="#">CBSE<span class="expand">»</span></a>
        <ul class="child">
           <li class="dropdown parent"><a href="#">1 <span class="expand">»</span></a>
            <ul class="child">
                <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
           <li class="dropdown parent"><a href="#">2 <span class="expand">»</span></a>
            <ul class="child">
               <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
           <li class="dropdown parent"><a href="#">3 <span class="expand">»</span></a>
            <ul class="child">
                <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
           <li class="dropdown parent"><a href="#">4 <span class="expand">»</span></a>
            <ul class="child">
               <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
       </ul>
</li>
<li class="dropdown parent"><a href="#">ICSC <span class="expand">»</span></a>
<ul class="child">
           <li class="dropdown parent"><a href="#">1 <span class="expand">»</span></a>
            <ul class="child">
                <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
           <li class="dropdown parent"><a href="#">2 <span class="expand">»</span></a>
            <ul class="child">
               <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
           <li class="dropdown parent"><a href="#">3 <span class="expand">»</span></a>
            <ul class="child">
                <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
           <li class="dropdown parent"><a href="#">4 <span class="expand">»</span></a>
            <ul class="child">
               <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
</ul>
</li>
<li class="dropdown parent"><a href="#">JEE <span class="expand">»</span></a>
<ul class="child">
         <li class="dropdown parent"><a href="#">1 <span class="expand">»</span></a>
            <ul class="child">
                <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
           <li class="dropdown parent"><a href="#">2 <span class="expand">»</span></a>
            <ul class="child">
               <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
           <li class="dropdown parent"><a href="#">3 <span class="expand">»</span></a>
            <ul class="child">
                <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
           <li class="dropdown parent"><a href="#">4 <span class="expand">»</span></a>
            <ul class="child">
               <li><a href="/micro-sessions/micro-sessions/packagedetails/1">Pro</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/2">Classic</a></li>
                <li><a href="/micro-sessions/micro-sessions/packagedetails/4">Pro +</a></li>
           </ul>
         </li>
</ul>
</li><?php */ ?>

<?php
$borads = $this->Common->getBoards();
$classes = $this->Common->getClasses();
if(count($borads) > 0 && count($classes) > 0){
    foreach($borads as $borad){
        ?>
        <li class="dropdown parent"><a href="#"><?= $borad->title; ?><span class="expand">»</span></a>
                <ul class="child">
                <?php
                foreach($classes as $class){
                    $packages = $this->Common->getPackages($borad->id, $class->id);
                    if(count($packages) > 0){
                ?>
                   <li class="dropdown parent"><a href="#"><?= $class->title; ?> <span class="expand">»</span></a>
                    <ul class="child">
                        <?php
                        foreach($packages as $package){
                        ?>
                            <li><a href="/micro-sessions/micro-sessions/packagedetails/<?= $package->id ?>"><?= $package->package_name ?></a></li>
                        <?php } ?>
                   </ul>
                 </li>
                <?php }
                    }
                ?>
                 </li>

               </ul>
        </li>
        <?php
    }
}
?>

</ul>
</li>
<?php } ?>
