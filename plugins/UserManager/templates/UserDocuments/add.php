<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $userDocument
 */
?>
 <?= $this->Form->create($userDocument, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>

<?php
 echo $this->Form->control('document_type_id', ['options' => \Cake\Core\Configure::read('constants.DOCUMENT_TYPE'),'class' => 'form-control','empty' => 'Select Document Type', 'placeholder' => __('Document Type')]);
    
    $doc_file_path = "";

    if (!empty($userDocument->document_file_path) && !empty($userDocument->document_file) && file_exists("img/".$userDocument->document_file_path . $userDocument->document_file)) {
            $doc_file_path = WWW_ROOT .'img/'. $userDocument->document_file_path."/".$userDocument->document_file;
    }
   echo $this->Form->control('document_file', ['type' => 'file', 'class' => 'dropify', 'data-height' => 30, 'label' => 'Document File' , 'data-default-file' => $doc_file_path]);
?>
<?= $this->Form->end() ?>