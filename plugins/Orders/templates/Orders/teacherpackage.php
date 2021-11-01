<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $orders
 */
$this->layout = "authdefault";
?>
<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>Purchase history</h2>
            <p>Teaching Bharat's Micro Session order history</p>
        </div>
    </div>
</div>
 <section class="White79">
    <div class="container">
        <div class="col-sm-12">
        <?= $this->Flash->render() ?>
        <div class="form-group">
          <ul class="nav nav-tabs">
              <li >
                <?= $this->Html->link('Purchase history', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'index'], ['escape' => false]); ?>
            </li>
              <li >
                <?= $this->Html->link('Micro Sessions', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'microsession'], ['escape' => false]); ?>
            </li>            
              <li>
                <?= $this->Html->link('Master session', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'session'], ['escape' => false]); ?>
            </li>           
       
             <li class="active">
                <?= $this->Html->link('Packages', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'teacherpackage'], ['escape' => false]); ?>
            </li>
           
            </ul>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered ssTable">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name.</th>                        
                        <th>Package</th>
                        <th>Subject</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($orders->toArray())):
                         $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);                       
                         $isMicrosession=false; 
                         $package='';
                         $order_courses = '';
                         $plan='';
                        foreach ($orders as $order):  
                        // echo "<pre>"                        ;
                        // print_r($order);
                        // die();
                        $package=$order->packages['package_name']? $order->packages['package_name']: ""; 
                        $student=$order->user['first_name'].' '.$order->user['last_name'];
                        $subject=$order->subjects['title'];
                            
                          
                            ?>
                     <tr>
                            <td><?= $this->Number->format($i)?>.</td>
                            <td><?= $student ?></td>                                            
                            <td><?= $package ?></td>                            
                            <td><?= $subject ?></td>                           
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> 
                                <td colspan='11' align='center' class="tbodyNotFound" style="text-align:center;"> 
                                    <strong>Record Not Available</strong> 
                                </td> 
                            </tr>
                        <?php endif; ?>
                  </tbody>
                </table>
            </div>
            <div class="pagination-sec d-flex justify-content-between flex-wrap align-items-center">
                <?php 
                $totalCount = $this->Paginator->params()['count'] ?? 0;
                if($totalCount > \Cake\Core\Configure::read('Setting.PAGE_LIMIT')){
                    echo $this->element('pagination');
                }
                 ?>
            </div>
        </div>
    </div>
</section>

<?php
$this->assign('title', 'Purchase history');
$this->Html->meta(
    'keywords', 'Purchase history', ['block' => true]
);
$this->Html->meta(
    'description', 'Purchase history', ['block' => true]
);
?>