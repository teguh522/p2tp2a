<div class="auth-main particles_js">
    <div class="auth_div vivify popIn">
        <div class="auth_brand">
            <a class="navbar-brand" href="javascript:void(0);">
                P2TP2A
            </a>
        </div>
        <div class="card">
            <div class="body">
                <?php if ($this->session->flashdata('msg')) : ?>
                    <?php echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                <?php endif; ?>
                <p class="lead">Buat Akun</p>
                <form method="POST" id="form-registrasi" action="<?php echo base_url() ?>auth/register_action" class="form-auth-small m-t-20">
                    <div class="form-group">
                        <input type="email" name="email" required class="form-control round" placeholder="Your email">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" required data-parsley-minlength="6" class="form-control round" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-round btn-block">Daftar</button>
                    <div class="mt-4">
                        <span>Sudah punya akun? <a href="<?php echo base_url() ?>auth">Masuk</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</div>
<!-- END WRAPPER -->