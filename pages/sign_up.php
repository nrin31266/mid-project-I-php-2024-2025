<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Sign Up</h2>
                    <form action="index.php" method="post" class="mb-4">
                        <input type="hidden" name="action" value="handle-sign-up">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input minlength="8" type="text" name="username" class="form-control" id="username"
                                value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input minlength="8"  type="password" name="password" class="form-control" id="password" required value="<?php echo htmlspecialchars($password ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label for="re-password">Re-enter Password</label>
                            <input minlength="8" type="password" name="re-password" class="form-control" id="re-password" required value="<?php echo htmlspecialchars($re_password ?? ''); ?>">
                        </div>


                        <div class="d-grid gap-2 mt-2">
                            <button type="submit" class="btn btn-success btn-block">Sign Up</button>
                        </div>
                    </form>

                    <form action="index.php" method="get">
                        <input type="hidden" name="action" value="login">
                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-text btn-block" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>