<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <h2><i class="glyphicon glyphicon-list-alt"></i>My Micro Sessions</h2>
                    </div>
                    <div class="col-sm-3">
                        <?= $this->Html->link("Add A Micro Session", ['action' => 'add'], ['class' => 'btn mybtn btn-block']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                <?= $this->Flash->render() ?>
                    <div class="col-md-12">
                        <table class="table table-bordered ssTable">
                            <thead>
                                <tr>
                                   <th>Name</th>
                                    <th>Email</th>                                    
                                  
                                    <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                             <?php 
                                foreach ($teacher as $tech): 
                                //if($tech->username!=''):
                                    ?>
                                <tr>
                                    <td>
                                        <?= $this->Html->link($tech->first_name.' '.$tech->last_name, ['action' => 'teachersession', $tech->id], ['class' => 'name']) ?>
                                    </td>
                                    <td>
                                        <?=$this->Html->link($tech->username, ['action' => 'teachersession'], ['class' => 'name']) ?>
                                    </td>
                                    
                                    
                                </tr>
                                <?php  
                            //endif;
                            endforeach; ?>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>


<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css
'],['block' => true]);
echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js', 'https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js'],['block' => true]);
echo $this->Html->script(['common'], ['block' => true]); ?>

