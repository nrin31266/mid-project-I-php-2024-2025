<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center mb-4">Login</h1>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="handle-sign-in">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" required value="<?php echo htmlspecialchars($username ?? ''); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required value="<?php echo htmlspecialchars($password ?? ''); ?>">
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    <div class="text-center mt-3">
                        <form action="index.php" method="get">
                            <input type="hidden" name="action" value="sign_up">
                            <button class="btn btn-text w-100" type="submit">Sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>