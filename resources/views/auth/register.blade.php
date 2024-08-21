<div class="container">
    <div class="wrapper d-flex align-items-center justify-content-center h-100">
        <div class="card login-form">
            <h5 class="card-title text-center">Login Form</h5>
            <div class="card-body">
                <?php if (!empty(session('resp_msg'))) : ?>
                    <div class="alert alert-success m-3" role="alert">
                        <?= session('resp_msg') ?>
                    </div>
                <?php endif; ?>
                <form action="<?= url('register') ?>" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleinputNama1" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" name="nama" id="exampleinputNama1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                    <div class="sign-up mt-4">
                        if you have an account? <a href="<?= url('login') ?>">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>