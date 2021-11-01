 <div class="TeacherBlueBg">
        <div class="container">
            <div class="col-md-12">
                <?= $this->Flash->render() ?>
                <div class="col-md-12 Tbox"  style="text-align: center;"> 
                    <div class="col-md-12">
                        <h3 >Thank You!</h3>
                    </div>
                    <p>We received your application.</p>
                    <p>For application status, please write to <a href="mailto:<?= \Cake\Core\Configure::read("Setting.ADMIN_EMAIL") ?>"><?= \Cake\Core\Configure::read("Setting.ADMIN_EMAIL") ?></a></p>
                   
                </div>

            </div>
        </div>
    </div>

<?php
$this->assign('title', 'Thank You');
$this->Html->meta(
    'keywords', 'Teacher Registration', ['block' => true]
);
$this->Html->meta(
    'description', 'Teacher Registration', ['block' => true]
);

?>