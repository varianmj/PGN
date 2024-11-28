<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

				<img src="<?php echo base_url('assets/admin/img/' . (!empty($profile['user_image_url']) ? $profile['user_image_url'] : 'profile-placeholder.jpg')); ?>" alt="Profile"
                        class="rounded-circle">
                    <h2><?php echo $profile['user_fullname']?></h2>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Overview</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#profile-change-password">Ganti Password</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque
                                temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae
                                quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Username</div>
                                <div class="col-lg-9 col-md-8"><?php echo $profile['user_username']?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8"><?php echo $profile['user_fullname']?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?php echo $profile['user_email']?></div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form method="post" id="formProfil">
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                        Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        <img src="<?php echo base_url('assets/admin/img/' . (!empty($profile['user_image_url']) ? $profile['user_image_url'] : 'profile-placeholder.jpg')); ?>"
                                            alt="Profile" id="profileImg">
                                        <div class="pt-2">
                                            <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"
                                                id="uploadBtn"><i class="bi bi-upload"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i
                                                    class="bi bi-trash" id="removeImageBtn"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <input type="file" name="file" id="imageFile" style="display: none;"
                                    accept=".jpeg, .jpg, .png">

                                <div class="row mb-3">
                                    <label for="user_username" class="col-md-4 col-lg-3 col-form-label">username</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="user_username" type="text" class="form-control" id="user_username"
                                            value="<?php echo $profile['user_username'] ?>">
                                    </div>
                                </div>
								
                                <div class="row mb-3">
                                    <label for="nama_lengkap" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="nama_lengkap" type="text" class="form-control" id="nama_lengkap"
                                            value="<?php echo $profile['user_fullname'] ?>">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9 column">
                                        <input name="email" type="email" class="form-control" id="Email"
                                            value="<?php echo $profile['user_email'] ?>">
                                        <div class="invalid-feedback ms-2"> </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form method="post" id="formPassword">

                                <div class="row mb-3">
                                    <label for="old_password" class="col-md-4 col-lg-3 col-form-label">Password
                                        Lama</label>
                                    <div class="col-md-8 col-lg-9 column">
                                        <input name="old_password" type="password" class="form-control <?php echo form_error('old_password') != '' ? 'is-invalid' : '' ?>" id="old_password">
                                        <div class="invalid-feedback ms-2"> <?php echo form_error('old_password', '<small>', '</small>') ?></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="new_password" class="col-md-4 col-lg-3 col-form-label">Password
                                        Baru</label>
                                    <div class="col-md-8 col-lg-9 column">
                                        <input name="new_password" type="password"
                                            class="form-control <?php echo form_error('new_password') != '' ? 'is-invalid' : '' ?>"
                                            id="old_password" id="new_password">
											<div class="invalid-feedback ms-2"> <?php echo form_error('old_password', '<small>', '</small>') ?></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password_confirmation"
                                        class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password Baru</label>
                                    <div class="col-md-8 col-lg-9 column">
                                        <input name="password_confirmation" type="password"
                                            class="form-control <?php echo form_error('password_confirmation') != '' ? 'is-invalid' : '' ?>"
                                            id="old_password" id="password_confirmation">
											<div class="invalid-feedback ms-2"> <?php echo form_error('old_password', '<small>', '</small>') ?></div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    var previousProfileImageUrl = $('#profileImg').attr('src');

    $('#uploadBtn').click(function(e) {
        e.preventDefault();
        $('#imageFile').click();
    });

    $('#imageFile').change(function() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#profileImg').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    });

    $('#removeImageBtn').click(function(e) {
        e.preventDefault();

        $('#imageFile').val('');

        $('#profileImg').attr('src', previousProfileImageUrl);
    });

    $('#formProfil').on('submit', function(e) {
        e.preventDefault();
        formulir('Account', 'ubah', 'formProfil');
    });

    $('#formPassword').on('submit', function(e) {
        e.preventDefault();
        formulir('Account', 'ubahPassword', 'formPassword');
    });
});
</script>
