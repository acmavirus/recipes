<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="card-body pt-0">
                        <div class="p-2">
                            <form class="form-horizontal" action="<?php echo base_url('admin'); ?>" method="POST"><input type="hidden" name="csrf_name_nkb" value="71458913fd2c4ead3013111692bcc0f1" />
                                <div class="mb-3"><label for="username" class="form-label">Username</label><input type="text" name="username" class="form-control" id="username" placeholder="Enter username"></div>
                                <div class="mb-3"><label class="form-label">Password</label>
                                    <div class="input-group auth-pass-inputgroup"><input type="password" name="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon"><button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button></div>
                                </div>
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="remember-check"><label class="form-check-label" for="remember-check">Remember me </label></div>
                                <div class="mt-3 d-grid"><button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>