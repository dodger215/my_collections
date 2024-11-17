<?php  include('includes/header.php'); ?>

<div class="row" id="mainForm">
        <div class="col-md-12" id="mainForm">
           <div class="card">
            <div class="card-header">
                <h4>Settings</h4>
            </div>
            <div class="crad-body">
                <form action="code.php" method="post" style="margin: 20px;">
                <?= alertMessage(); ?>
                <?php
                    $settings = getById('settings', 1);
                   ?>
                    <input type="hidden" name="settingId" id="" value="<?= $settings['data']['id'] ?? 'insert'?>">
                   <div class="mb-3">
                    <label for="">Title</label>
                    <input type="text" name="title" id="" class="form-control" value="<?= $settings['data']['title'] ?? ''?>">
                   </div>
                   <div class="mb-3">
                    <label for="">Url</label>
                    <input type="text" name="slug" id="" class="form-control" value="<?= $settings['data']['slug'] ?? ''?>">
                   </div>
                   <div class="mb-3">
                    <label for="">Small Description</label>
                    <input type="text" name="small_description" id="" class="form-control" value="<?= $settings['data']['small_description'] ?? ''?>">
                   </div>
                   <h4 class="my-3">SOE Tags</h4>
                   <div class="mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" id="" rows="3" class="form-control"><?= $settings['data']['meta_description'] ?? ''?></textarea>
                   </div>
                   <div class="mb-3">
                    <label for="">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="" class="form-control" value="<?= $settings['data']['meta_keywords'] ?? ''?>">
                   </div>
                   <h4 class="my-3">Contact Information</h4>
                   <div class="row">
                   <div class="col-md-6 mb-3">
                    <label for="">Email</label>
                    <input type="email" name="email1" id="" class="form-control" value="<?= $settings['data']['email1'] ?? ''?>">
                   </div>
                   <div class="col-md-6 mb-3">
                    <label for="">Email 2</label>
                    <input type="email" name="email2" id="" class="form-control" value="<?= $settings['data']['email2'] ?? ''?>">
                   </div>
                   <div class="col-md-6 mb-3">
                    <label for="">Contact 1</label>
                    <input type="text" name="phone1" id="" class="form-control" value="<?= $settings['data']['phone1'] ?? ''?>">
                   </div>
                   <div class="col-md-6 mb-3">
                    <label for="">Contact 2</label>
                    <input type="text" name="phone2" id="" class="form-control" value="<?= $settings['data']['phone2'] ?? ''?>">
                   </div>
                   <div class="col-md-12 mb-3">
                    <label for="">Address</label>
                    <textarea name="address" id="" rows="3" class="form-control"><?= $settings['data']['address'] ?? ''?></textarea>
                   </div>
                   </div>
                   <div class="mb-3">
                    <button type="submit" name="saveSetting" class="btn btn-primary">Save</button>
                   </div>
                </form>
            </div>
           </div>
        </div>
    </div>
<?php  include('includes/footer.php'); ?>