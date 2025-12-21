<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="glass-card p-5" style="max-width: 500px; width: 100%;">
        <div class="text-center mb-4">
            <h2 class="text-white fw-bold">Create Account</h2>
            <p class="text-muted">Join the community today</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger py-2"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="/register" method="POST">
            <div class="mb-3">
                <label class="form-label text-white">Full Name</label>
                <input type="text" name="full_name" class="form-control bg-transparent text-white border-secondary" required>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label text-white">Username</label>
                    <input type="text" name="username" class="form-control bg-transparent text-white border-secondary" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label text-white">Email Address</label>
                <input type="email" name="email" class="form-control bg-transparent text-white border-secondary" required>
            </div>
            <div class="mb-4">
                <label class="form-label text-white">Password</label>
                <input type="password" name="password" class="form-control bg-transparent text-white border-secondary" required>
            </div>
            <button type="submit" class="btn btn-primary-glow w-100 mb-3">Create Account</button>
            
            <div class="text-center">
                <a href="/login" class="text-decoration-none text-muted small">Already have an account? <span class="text-white">Sign in</span></a>
            </div>
        </form>
    </div>
</div>
