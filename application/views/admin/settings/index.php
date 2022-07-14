<?php
$site = json_decode($site->content);
$link301 = json_decode($link301->content);
$social = json_decode($social->content);
$email = json_decode($email->content);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2 d-flex">
                            SETTING
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="m-portlet m-portlet--tabs">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active show" data-key="data_seo" data-toggle="tab" href="#tab_general" role="tab" aria-selected="true">
                                    <i class="la la-search"></i>
                                    Thông tin SEO
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-key="data_301" data-toggle="tab" href="#tab_301" role="tab" aria-selected="true">
                                    <i class="la la-angellist"></i>
                                    301 url
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" data-key="data_social" href="#tab_social" role="tab" aria-selected="false">
                                    <i class="la la-facebook"></i>
                                    Mạng xã hội
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link" data-toggle="tab" data-key="data_email" href="#tab_email" role="tab" aria-selected="false">
                                    <i class="la la-cog"></i>
                                    Cấu hình email
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab_general" role="tabpanel">
                            <div class="tab-content">
                                <form action="" method="post">
                                    <input type="hidden" name="type" value="site">
                                    <div class="form-group">
                                        <label>Tên Website</label>
                                        <input name="title" placeholder="Tên Website" class="form-control" type="text" value="<?= $site->title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tiêu đề SEO</label>
                                        <input name="meta_title" placeholder="Tiêu đề SEO" class="form-control" type="text" value="<?= $site->meta_title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả SEO Website</label>
                                        <textarea name="meta_description" placeholder="Mô tả SEO Website" class="form-control"><?= $site->meta_description; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Từ khóa SEO Website</label>
                                        <input name="meta_keyword" placeholder="Từ khóa SEO Website" class="form-control" type="text" value="<?= $site->meta_keyword; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ trụ sở chính</label>
                                        <input name="address" class="form-control" value="<?= $site->address; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Domain</label>
                                        <input name="domain" class="form-control" value="<?= $site->domain; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Hotline</label>
                                        <input name="phone" class="form-control" value="<?= $site->phone; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Lưu">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_301" role="tabpanel">
                            <div class="tab-content">
                                <form action="" method="post">
                                    <input type="hidden" name="type" value="link301">
                                    <div class="form-group">
                                        <label>Danh sách url cần 301</label>
                                        <textarea name="content" rows="20" class="form-control" type="text"><?= $link301->content; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Lưu">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_social" role="tabpanel">
                            <div class="tab-content">
                                <form action="" method="post">
                                    <input type="hidden" name="type" value="social">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input name="facebook" class="form-control" value="<?= $social->facebook; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Google</label>
                                        <input name="google" class="form-control" value="<?= $social->google; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input name="twitter" class="form-control" value="<?= $social->twitter; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Youtube</label>
                                        <input name="youtube" class="form-control" value="<?= $social->youtube; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Instagram</label>
                                        <input name="instagram" class="form-control" value="<?= $social->instagram; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Pinterest</label>
                                        <input name="pinterest" class="form-control" value="<?= $social->pinterest; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Linkedin</label>
                                        <input name="linkedin" class="form-control" value="<?= $social->linkedin; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Zalo</label>
                                        <input name="zalo" class="form-control" value="<?= $social->zalo; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Telegram</label>
                                        <input name="telegram" class="form-control" value="<?= $social->telegram; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Lưu">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_email" role="tabpanel">
                            <div class="tab-content">
                                <form action="" method="post">
                                    <input type="hidden" name="type" value="email">
                                    <div class="form-group">
                                        <label>Email quản trị</label>
                                        <input type="text" name="email_admin" placeholder="Email quản trị" class="form-control" value="<?= $email->email_admin; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Lưu">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>