  <?php 
$this->Paginator->setTemplates([
   // 'number' => '<li class="page-item"><a href="{{url}}">{{text}}</a></li>',
    'nextActive' => '<li class="page-item next"><a class="page-link" rel="next" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="page-item next disabled"><a class="page-link" href="" onclick="return false;">{{text}}</a></li>',
    'prevActive' => '<li class="page-item prev"><a class="page-link" rel="prev" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="page-item prev disabled"><a class="page-link" href="" onclick="return false;">{{text}}</a></li>',
    'first' => '<li class="page-item first"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'last' => '<li class="page-item last"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="">{{text}}</a></li>',
]);
  ?>
  <span class="currently-txt"><?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of {{count}} total, starting on record {{start}}, ending on {{end}}'); ?></span>
    <ul class="pagination">
        <?= $this->Paginator->first('<< First') ?>
        <?= $this->Paginator->prev('Previous') ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next('Next') ?>
        <?= $this->Paginator->last('Last >>') ?>
        <!-- <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-double-left"></i></a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-double-right"></i></a></li> -->
    </ul>



