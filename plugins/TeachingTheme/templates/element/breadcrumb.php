<?php

use Cake\Utility\Text;
use Cake\Utility\Inflector;
$act = strtolower(trim($this->request->getParam('action')));
$ctrl = Text::slug(Inflector::underscore($this->request->getParam('controller')));
$slugedAct = Text::slug(Inflector::underscore($this->request->getParam('action')));
$singular = str_replace("-", " ",ucfirst(Inflector::singularize($ctrl)));
$plural = str_replace("-", " ",ucfirst(Inflector::pluralize($ctrl)));
switch ($act) {
    case 'index' :
        $this->Breadcrumbs->add($plural, '', array('class' => 'breadcrumb-item active'));
        break;
    case 'add' :
        $id = $this->request->getParam('pass.0');
        $this->Breadcrumbs->add($plural, ['controller' => $ctrl], ['class'=> 'breadcrumb-item']);
        $this->Breadcrumbs->add($id?'Edit '.$singular:'Add '.$singular, '', array('class' => 'breadcrumb-item active'));
        break;
    case 'edit' :
        $this->Breadcrumbs->add($plural, ['controller' => $ctrl], ['class'=> 'breadcrumb-item']);
        $this->Breadcrumbs->add('Edit '.$singular, '', array('class' => 'breadcrumb-item active'));
        break;
    case 'view' :
        $this->Breadcrumbs->add($plural, ['controller' => $ctrl], ['class'=> 'breadcrumb-item']);
        $this->Breadcrumbs->add('View '.$singular, '', array('class' => 'breadcrumb-item active'));
        break;

    default :
        $this->Breadcrumbs->add($plural, ['controller' => $ctrl], ['class'=> 'breadcrumb-item']);
        $this->Breadcrumbs->add(ucfirst($act), '', array('class' => 'breadcrumb-item active'));
}
$this->Breadcrumbs->prepend(
    '<i class="fa fa-dashboard"></i> Home',
    ['controller' => 'Dashboards', 'action' => 'index','plugin' => 'AdminUserManager'], ['class'=> 'breadcrumb-item']
);
echo $this->Breadcrumbs->render(
    ['class' => 'breadcrumb']
);
?>

