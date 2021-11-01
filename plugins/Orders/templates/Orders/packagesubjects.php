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
                        <h2><i class="glyphicon glyphicon-list-alt"></i>Microsessions for <?= ucfirst($package_name);?></h2>
                    </div>
                    <div class="col-sm-3">
                        <h2><?= $this->Html->link('Back', ['action' => 'packagehistory'], ['class' => 'namme']) ?> </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                    <div class="col-md-12">
                        <table class="table table-bordered ssTable">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Microsession</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php if (!empty($teacherStudentMappings->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                              
                                foreach ($teacherStudentMappings as $course): 
 
                                    ?>
                                <tr>
                                      <td>
                                        <p class="sstopic"><?= $course->subjects['title']; ?></p>
                                    </td> 
                                    <td>
                                        <?= $this->Html->link(ucfirst($course->micro_sessions['title']), [
'controller' => 'MicroSessions', 'action' => 'schedulecourse', 'plugin' => 'MicroSessions',
                                        $course->micro_sessions['id']], ['class' => 'namme']) ?>
                                    </td>

                                </tr>
                                <?php $i++; endforeach; ?>
                                <?php else: ?>
                                    <tr> <td colspan='20' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>