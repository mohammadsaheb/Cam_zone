@extends('layouts.app')

@section('content')
<div class="container profile-container py-5">
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-lg-3">
            <div class="profile-sidebar">
                <h4 class="text-center mb-3">{{ Auth::user()->name }}</h4>
                <p class="text-center text-muted mb-4">
                    <span class="badge bg-secondary">
                        {{ ucfirst(Auth::user()->user_type ?? 'User') }}
                    </span>
                </p>
                
                <div class="profile-menu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#personal-info" class="nav-link active" data-bs-toggle="tab">
                                <i class="fas fa-user me-2"></i> Personal Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#update-password" class="nav-link" data-bs-toggle="tab">
                                <i class="fas fa-lock me-2"></i> Update Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#delete-account" class="nav-link" data-bs-toggle="tab">
                                <i class="fas fa-user-times me-2"></i> Delete Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link text-danger border-0 bg-transparent">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Profile Content -->
        <div class="col-lg-9">
            <div class="profile-content">
                <div class="tab-content">
                    <!-- Personal Information Tab -->
                    <div class="tab-pane fade show active" id="personal-info">
                        <div class="content-card">
                            <div class="card-header-custom">
                                <h5>
                                    <i class="fas fa-user me-2"></i>
                                    Profile Information
                                </h5>
                                <p class="text-muted mb-0">Update your account's profile information and email address.</p>
                            </div>
                            <div class="card-body-custom">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>
                    
                    <!-- Update Password Tab -->
                    <div class="tab-pane fade" id="update-password">
                        <div class="content-card">
                            <div class="card-header-custom">
                                <h5>
                                    <i class="fas fa-lock me-2"></i>
                                    Update Password
                                </h5>
                                <p class="text-muted mb-0">Ensure your account is using a long, random password to stay secure.</p>
                            </div>
                            <div class="card-body-custom">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>
                    
                    <!-- Delete Account Tab -->
                    <div class="tab-pane fade" id="delete-account">
                        <div class="content-card">
                            <div class="card-header-custom">
                                <h5>
                                    <i class="fas fa-user-times me-2"></i>
                                    Delete Account
                                </h5>
                                <p class="text-muted mb-0">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                            </div>
                            <div class="card-body-custom">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-container {
        margin-top: 20px;
    }
    
    .profile-sidebar {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        padding: 25px;
    }
    
    .profile-menu {
        margin-top: 20px;
    }
    
    .profile-menu .nav-link {
        color:  #6c757d;
        padding: 12px 15px;
        border-radius: 5px;
        transition: all 0.3s;
    }
    
    .profile-menu .nav-link:hover {
        background-color: #f8f9fa;
    }
    
    .profile-menu .nav-link.active {
        background-color:  #6c757d;
        color: #fff;
    }
    
    .content-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 20px;
    }
    
    .card-header-custom {
        background-color: #f8f9fa;
        padding: 20px 25px;
        border-bottom: 1px solid #eee;
    }
    
    .card-header-custom h5 {
        margin-bottom: 5px;
        color: #333;
    }
    
    .card-body-custom {
        padding: 25px;
    }
    
    .form-label {
        font-weight: 600;
        color: #444;
    }
    
    .btn-primary {
        background-color:  #6c757d;
        border-color: #6c757d;
    }
    
    .btn-primary:hover {
        background-color:  #6c757d;
        border-color:  #6c757d;
    }
    
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
    }
    
    /* Camera-themed Tab Transition */
    .tab-pane {
        transition: opacity 0.3s ease-in-out;
    }
    
    .tab-pane.fade {
        opacity: 0;
    }
    
    .tab-pane.fade.show {
        opacity: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle tab switching via URL hash
        let hash = window.location.hash;
        if (hash) {
            $('.nav-tabs a[href="' + hash + '"]').tab('show');
        }
        
        // Update URL hash when tab changes
        $('.nav-tabs a').on('shown.bs.tab', function(e) {
            window.location.hash = e.target.hash;
        });
        
        // Smooth scrolling to tabs
        $('.profile-menu a').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');
            $('html, body').animate({
                scrollTop: $('.profile-content').offset().top - 100
            }, 300);
        });
    });
</script>
@endsection