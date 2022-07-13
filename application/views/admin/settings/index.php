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
                                <form action="" id="data_seo">
                                    <input type="hidden" value="data_seo" name="key_setting">
                                    <div class="form-group">
                                        <label>Tên Website</label>
                                        <input name="title" placeholder="Tên Website" class="form-control" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Tiêu đề SEO</label>
                                        <input name="meta_title" placeholder="Tiêu đề SEO" class="form-control" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả SEO Website</label>
                                        <textarea name="meta_description" placeholder="Mô tả SEO Website" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Từ khóa SEO Website</label>
                                        <input name="meta_keyword" placeholder="Từ khóa SEO Website" class="form-control" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ trụ sở chính</label>
                                        <input name="address" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Domain</label>
                                        <input name="domain" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Hotline</label>
                                        <input name="phone" class="form-control" value="">
                                    </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_301" role="tabpanel">
                            <div class="tab-content">
                                <form action="" id="data_301">
                                    <input type="hidden" value="data_301" name="key_setting">
                                    <div class="form-group">
                                        <label>Danh sách url cần 301</label>
                                        <textarea name="content" rows="20" class="form-control" type="text"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_social" role="tabpanel">
                            <div class="tab-content">
                                <form action="" id="data_social">
                                    <input type="hidden" value="data_social" name="key_setting">
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input name="facebook" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Google</label>
                                        <input name="google" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Twitter</label>
                                        <input name="twitter" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Youtube</label>
                                        <input name="youtube" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Instagram</label>
                                        <input name="instagram" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Pinterest</label>
                                        <input name="pinterest" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Linkedin</label>
                                        <input name="Linkedin" class="form-control" value="">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_email" role="tabpanel">
                            <div class="tab-content">
                                <form action="" id="data_email">
                                    <input type="hidden" value="data_email" name="key_setting">
                                    <div class="form-group">
                                        <label>Email quản trị</label>
                                        <input type="text" name="email_admin" placeholder="Email quản trị" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Name From</label>
                                        <input type="text" name="name_from" placeholder="Name Form" class="form-control" value="">
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