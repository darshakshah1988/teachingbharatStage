<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $listing
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Listing') ?>  
        </h1>
        <small><?php echo __('Here you can view listing Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row listings view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($listing->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Listing'), ['action' => 'add', $listing->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Code') ?></th>
                    <td><?= h($listing->code) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Listing Type') ?></th>
                    <td><?= $listing->has('listing_type') ? $this->Html->link($listing->listing_type->title, ['controller' => 'ListingTypes', 'action' => 'view', $listing->listing_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Parent Listing') ?></th>
                    <td><?= $listing->has('parent_listing') ? $this->Html->link($listing->parent_listing->title, ['controller' => 'Listings', 'action' => 'view', $listing->parent_listing->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($listing->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($listing->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Tag Line') ?></th>
                    <td><?= h($listing->tag_line) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Protocol') ?></th>
                    <td><?= h($listing->protocol) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Domain Name') ?></th>
                    <td><?= h($listing->domain_name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Registration No') ?></th>
                    <td><?= h($listing->registration_no) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Logo') ?></th>
                    <td><?= h($listing->logo) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Logo Dir') ?></th>
                    <td><?= h($listing->logo_dir) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Logo Type') ?></th>
                    <td><?= h($listing->logo_type) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Banner') ?></th>
                    <td><?= h($listing->banner) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Banner Dir') ?></th>
                    <td><?= h($listing->banner_dir) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Banner Type') ?></th>
                    <td><?= h($listing->banner_type) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Thumb Image') ?></th>
                    <td><?= h($listing->thumb_image) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Thumb Image Dir') ?></th>
                    <td><?= h($listing->thumb_image_dir) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Thumb Image Type') ?></th>
                    <td><?= h($listing->thumb_image_type) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Address Line 1') ?></th>
                    <td><?= h($listing->address_line_1) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Address Line 2') ?></th>
                    <td><?= h($listing->address_line_2) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Postcode') ?></th>
                    <td><?= h($listing->postcode) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Latitude') ?></th>
                    <td><?= h($listing->latitude) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Longitude') ?></th>
                    <td><?= h($listing->longitude) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Short Description') ?></th>
                    <td><?= h($listing->short_description) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Title') ?></th>
                    <td><?= h($listing->meta_title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Keyword') ?></th>
                    <td><?= h($listing->meta_keyword) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Description') ?></th>
                    <td><?= h($listing->meta_description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($listing->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Admin User Id') ?></th>
                    <td><?= $this->Number->format($listing->admin_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Logo Size') ?></th>
                    <td><?= $this->Number->format($listing->logo_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Banner Size') ?></th>
                    <td><?= $this->Number->format($listing->banner_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Thumb Image Size') ?></th>
                    <td><?= $this->Number->format($listing->thumb_image_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Location Id') ?></th>
                    <td><?= $this->Number->format($listing->location_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sort Order') ?></th>
                    <td><?= $this->Number->format($listing->sort_order) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registration Date') ?></th>
                    <td>
                        <?php if ($listing->registration_date) {
                                echo $listing->registration_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($listing->created) {
                                echo $listing->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($listing->modified) {
                                echo $listing->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Is Visible') ?></th>
                    <td><?= $listing->is_visible ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $listing->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($listing->description)); ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>



<?php if (!empty($listing->admin_users)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Admin Users') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Listing Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Middle Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Mobile') ?></th>
                            <th><?= __('Dob') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Profile Photo') ?></th>
                            <th><?= __('Photo Dir') ?></th>
                            <th><?= __('Photo Size') ?></th>
                            <th><?= __('Photo Type') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('Is Supper Admin') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Is Verified') ?></th>
                            <th><?= __('Login Count') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($listing->admin_users as $adminUsers) : ?>
                        <tr>
                            <td><?= h($adminUsers->id) ?></td>
                            <td><?= h($adminUsers->listing_id) ?></td>
                            <td><?= h($adminUsers->title) ?></td>
                            <td><?= h($adminUsers->first_name) ?></td>
                            <td><?= h($adminUsers->middle_name) ?></td>
                            <td><?= h($adminUsers->last_name) ?></td>
                            <td><?= h($adminUsers->mobile) ?></td>
                            <td><?= h($adminUsers->dob) ?></td>
                            <td><?= h($adminUsers->email) ?></td>
                            <td><?= h($adminUsers->profile_photo) ?></td>
                            <td><?= h($adminUsers->photo_dir) ?></td>
                            <td><?= h($adminUsers->photo_size) ?></td>
                            <td><?= h($adminUsers->photo_type) ?></td>
                            <td><?= h($adminUsers->password) ?></td>
                            <td><?= h($adminUsers->is_supper_admin) ?></td>
                            <td><?= h($adminUsers->status) ?></td>
                            <td><?= h($adminUsers->is_verified) ?></td>
                            <td><?= h($adminUsers->login_count) ?></td>
                            <td><?= h($adminUsers->created) ?></td>
                            <td><?= h($adminUsers->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'AdminUsers', 'action' => 'view', $adminUsers->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'AdminUsers', 'action' => 'edit', $adminUsers->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $adminUsers->id), 'data-url'=> $this->Url->build(['controller' => 'AdminUsers', 'action' => 'delete', $adminUsers->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
<?php if (!empty($listing->academic_years)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Academic Years') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Listing Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Start Date') ?></th>
                            <th><?= __('End Date') ?></th>
                            <th><?= __('Classification') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($listing->academic_years as $academicYears) : ?>
                        <tr>
                            <td><?= h($academicYears->id) ?></td>
                            <td><?= h($academicYears->listing_id) ?></td>
                            <td><?= h($academicYears->title) ?></td>
                            <td><?= h($academicYears->start_date) ?></td>
                            <td><?= h($academicYears->end_date) ?></td>
                            <td><?= h($academicYears->classification) ?></td>
                            <td><?= h($academicYears->created) ?></td>
                            <td><?= h($academicYears->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'AcademicYears', 'action' => 'view', $academicYears->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'AcademicYears', 'action' => 'edit', $academicYears->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $academicYears->id), 'data-url'=> $this->Url->build(['controller' => 'AcademicYears', 'action' => 'delete', $academicYears->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
<?php if (!empty($listing->institution_types)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Institution Types') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Listing Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Sort Order') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($listing->institution_types as $institutionTypes) : ?>
                        <tr>
                            <td><?= h($institutionTypes->id) ?></td>
                            <td><?= h($institutionTypes->listing_id) ?></td>
                            <td><?= h($institutionTypes->title) ?></td>
                            <td><?= h($institutionTypes->sort_order) ?></td>
                            <td><?= h($institutionTypes->created) ?></td>
                            <td><?= h($institutionTypes->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'InstitutionTypes', 'action' => 'view', $institutionTypes->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'InstitutionTypes', 'action' => 'edit', $institutionTypes->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $institutionTypes->id), 'data-url'=> $this->Url->build(['controller' => 'InstitutionTypes', 'action' => 'delete', $institutionTypes->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
<?php if (!empty($listing->listing_details)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Listing Details') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Listing Id') ?></th>
                            <th><?= __('Listing Type Category Id') ?></th>
                            <th><?= __('Institution Type Id') ?></th>
                            <th><?= __('Classification') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($listing->listing_details as $listingDetails) : ?>
                        <tr>
                            <td><?= h($listingDetails->id) ?></td>
                            <td><?= h($listingDetails->listing_id) ?></td>
                            <td><?= h($listingDetails->listing_type_category_id) ?></td>
                            <td><?= h($listingDetails->institution_type_id) ?></td>
                            <td><?= h($listingDetails->classification) ?></td>
                            <td><?= h($listingDetails->created) ?></td>
                            <td><?= h($listingDetails->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ListingDetails', 'action' => 'view', $listingDetails->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'ListingDetails', 'action' => 'edit', $listingDetails->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $listingDetails->id), 'data-url'=> $this->Url->build(['controller' => 'ListingDetails', 'action' => 'delete', $listingDetails->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
<?php if (!empty($listing->child_listings)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Listings') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Admin User Id') ?></th>
                            <th><?= __('Code') ?></th>
                            <th><?= __('Listing Type Id') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Tag Line') ?></th>
                            <th><?= __('Protocol') ?></th>
                            <th><?= __('Domain Name') ?></th>
                            <th><?= __('Registration No') ?></th>
                            <th><?= __('Registration Date') ?></th>
                            <th><?= __('Logo') ?></th>
                            <th><?= __('Logo Dir') ?></th>
                            <th><?= __('Logo Size') ?></th>
                            <th><?= __('Logo Type') ?></th>
                            <th><?= __('Banner') ?></th>
                            <th><?= __('Banner Dir') ?></th>
                            <th><?= __('Banner Size') ?></th>
                            <th><?= __('Banner Type') ?></th>
                            <th><?= __('Thumb Image') ?></th>
                            <th><?= __('Thumb Image Dir') ?></th>
                            <th><?= __('Thumb Image Size') ?></th>
                            <th><?= __('Thumb Image Type') ?></th>
                            <th><?= __('Location Id') ?></th>
                            <th><?= __('Address Line 1') ?></th>
                            <th><?= __('Address Line 2') ?></th>
                            <th><?= __('Postcode') ?></th>
                            <th><?= __('Latitude') ?></th>
                            <th><?= __('Longitude') ?></th>
                            <th><?= __('Short Description') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Meta Title') ?></th>
                            <th><?= __('Meta Keyword') ?></th>
                            <th><?= __('Meta Description') ?></th>
                            <th><?= __('Is Visible') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Sort Order') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($listing->child_listings as $childListings) : ?>
                        <tr>
                            <td><?= h($childListings->id) ?></td>
                            <td><?= h($childListings->admin_user_id) ?></td>
                            <td><?= h($childListings->code) ?></td>
                            <td><?= h($childListings->listing_type_id) ?></td>
                            <td><?= h($childListings->parent_id) ?></td>
                            <td><?= h($childListings->title) ?></td>
                            <td><?= h($childListings->slug) ?></td>
                            <td><?= h($childListings->tag_line) ?></td>
                            <td><?= h($childListings->protocol) ?></td>
                            <td><?= h($childListings->domain_name) ?></td>
                            <td><?= h($childListings->registration_no) ?></td>
                            <td><?= h($childListings->registration_date) ?></td>
                            <td><?= h($childListings->logo) ?></td>
                            <td><?= h($childListings->logo_dir) ?></td>
                            <td><?= h($childListings->logo_size) ?></td>
                            <td><?= h($childListings->logo_type) ?></td>
                            <td><?= h($childListings->banner) ?></td>
                            <td><?= h($childListings->banner_dir) ?></td>
                            <td><?= h($childListings->banner_size) ?></td>
                            <td><?= h($childListings->banner_type) ?></td>
                            <td><?= h($childListings->thumb_image) ?></td>
                            <td><?= h($childListings->thumb_image_dir) ?></td>
                            <td><?= h($childListings->thumb_image_size) ?></td>
                            <td><?= h($childListings->thumb_image_type) ?></td>
                            <td><?= h($childListings->location_id) ?></td>
                            <td><?= h($childListings->address_line_1) ?></td>
                            <td><?= h($childListings->address_line_2) ?></td>
                            <td><?= h($childListings->postcode) ?></td>
                            <td><?= h($childListings->latitude) ?></td>
                            <td><?= h($childListings->longitude) ?></td>
                            <td><?= h($childListings->short_description) ?></td>
                            <td><?= h($childListings->description) ?></td>
                            <td><?= h($childListings->meta_title) ?></td>
                            <td><?= h($childListings->meta_keyword) ?></td>
                            <td><?= h($childListings->meta_description) ?></td>
                            <td><?= h($childListings->is_visible) ?></td>
                            <td><?= h($childListings->status) ?></td>
                            <td><?= h($childListings->sort_order) ?></td>
                            <td><?= h($childListings->created) ?></td>
                            <td><?= h($childListings->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Listings', 'action' => 'view', $childListings->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'Listings', 'action' => 'edit', $childListings->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $childListings->id), 'data-url'=> $this->Url->build(['controller' => 'Listings', 'action' => 'delete', $childListings->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
<?php if (!empty($listing->roles)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Roles') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Listing Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Sort Order') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($listing->roles as $roles) : ?>
                        <tr>
                            <td><?= h($roles->id) ?></td>
                            <td><?= h($roles->listing_id) ?></td>
                            <td><?= h($roles->title) ?></td>
                            <td><?= h($roles->sort_order) ?></td>
                            <td><?= h($roles->created) ?></td>
                            <td><?= h($roles->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $roles->id), 'data-url'=> $this->Url->build(['controller' => 'Roles', 'action' => 'delete', $roles->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
