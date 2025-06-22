<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')
        
        <!-- Success Message -->
        @if (session('status') === 'password-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Password updated successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="current_password" class="form-label">Current Password</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="current-password">
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="current_password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('current_password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="password" class="form-label">New Password</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="password-strength-meter mt-3 mb-4">
            <h6>Password Strength:</h6>
            <div class="progress">
                <div id="password-strength" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted mt-2 d-block">
                <i class="fas fa-info-circle me-1"></i> Use at least 8 characters with a mix of letters, numbers & symbols
            </small>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-key me-2"></i> Update Password
            </button>
        </div>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                
                // Toggle password visibility
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.querySelector('i').classList.remove('fa-eye');
                    this.querySelector('i').classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    this.querySelector('i').classList.remove('fa-eye-slash');
                    this.querySelector('i').classList.add('fa-eye');
                }
            });
        });
        
        // Password strength meter
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('password-strength');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Calculate strength
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]/)) strength += 15;
            if (password.match(/[A-Z]/)) strength += 15;
            if (password.match(/[0-9]/)) strength += 15;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 15;
            if (password.length >= 12) strength += 15;
            
            // Cap at 100
            strength = Math.min(strength, 100);
            
            // Update UI
            strengthBar.style.width = strength + '%';
            strengthBar.setAttribute('aria-valuenow', strength);
            
            // Set color based on strength
            if (strength < 30) {
                strengthBar.className = 'progress-bar bg-danger';
            } else if (strength < 70) {
                strengthBar.className = 'progress-bar bg-warning';
            } else {
                strengthBar.className = 'progress-bar bg-success';
            }
        });
    });
</script>

<style>
    .toggle-password {
        cursor: pointer;
    }
    
    .password-strength-meter .progress {
        height: 10px;
        border-radius: 5px;
    }
</style>