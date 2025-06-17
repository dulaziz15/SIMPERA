{{-- https://bootdey.com/img/Content/avatar/avatar1.png --}}
<div class="container mt-4">
    <div class="row g-4">
        @foreach ($user as $usr)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card user-card">
                    <div class="card-body p-0">
                        <!-- Profile Header -->
                        <div class="profile-header"
                            style="background: linear-gradient(135deg, #3f43fd 0%, #5d62f0 100%);">
                            <div class="avatar-container">
                                <img src="{{ $usr->profil?->foto_profil ? asset('storage/foto_profil/' . $usr->profil->foto_profil) : ('https://bootdey.com/img/Content/avatar/avatar1.png') }}"
                                    alt="{{ $usr->nama_pengguna }}" class="profile-avatar">
                            </div>
                        </div>

                        <!-- User Details -->
                        <div class="user-details text-center p-4">
                            <h5 class="mb-1">{{ $usr->nama_pengguna }}</h5>
                            <p class="text-muted mb-3">{{ $usr->peran->nama ?? 'User' }}</p>
                            <p class="text-muted mb-3">{{ $usr->surel }}</p>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-outline-primary me-2"
                                    onclick="modalAction('/user/{{ $usr->id_pengguna }}/show')">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="modalAction('/user/{{ $usr->id_pengguna }}/confirm')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="social-links d-flex justify-content-center p-3 border-top">
                            <a href="mailto:{{ $usr->surel }}" class="social-icon mx-2" data-bs-toggle="tooltip" title="Email">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('css')
    <style>
        /* User Card Styles */
        .user-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            height: 120px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-end;
            padding-bottom: 60px;
        }

        .avatar-container {
            position: absolute;
            bottom: -50px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .user-details {
            margin-top: 50px;
        }

        .social-links {
            background-color: #f9f9f9;
        }

        .social-icon {
            color: #6c757d;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            color: #3f43fd;
            transform: scale(1.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .profile-header {
                height: 100px;
                padding-bottom: 50px;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
            }

            .user-details {
                margin-top: 40px;
                padding: 1.5rem !important;
            }
        }

        @media (max-width: 576px) {
            .profile-header {
                height: 80px;
                padding-bottom: 40px;
            }

            .profile-avatar {
                width: 70px;
                height: 70px;
                border-width: 3px;
            }

            .user-details h5 {
                font-size: 1rem;
            }

            .user-details p {
                font-size: 0.8rem;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Initialize tooltips
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });

        // Function to handle delete confirmation
        function confirmDelete(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'There was a problem deleting the user.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush
