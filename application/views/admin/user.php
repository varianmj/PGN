<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h5 class="card-title">User</h5>
                <small>Informasi Data user</small>
            </div>
            <div class="col-md-4 text-end">
                <a onclick="tambah()" class="btn btn-success pop-up" data-bs-toggle="modal" data-bs-target="#modal"
                    href="#modal" data-action="tambah" data-form="form" data-table="user">
                    <i class="bi bi-plus fs-16" data-bs-toggle="tooltip" data-bs-placement="left"
                        data-bs-original-title="Tambah Data"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body overflow-auto">
        <table id="datatables" class="table">
            <thead>
                <tr class="text-center">
                    <th class="text-center">No.</th>
                    <th>Nama user</th>
                    <th>Nama full user</th>
                    <th>Role user</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $key => $value): ?>
                <tr>
                    <td class="text-center"><?php echo $key+1 ?></td>
                    <td><?php echo $value['user_username'] ?></td>
                    <td><?php echo $value['user_fullname'] ?></td>
                    <td><?php echo $value['user_role'] ?></td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-warning btn-ubah pop-up" data-bs-toggle="modal" data-bs-target="#modal"
                            href="#modal" data-action="ubah" data-form="form" data-table="user"
                            idnya="<?php echo $value['user_id'] ?>">
                            <i class="bi bi-pencil-square fs-16" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-original-title="Ubah Data"></i>
                        </a>
                        <a class="btn btn-sm btn-danger btn-hapus"
                            href="<?php echo base_url('admin/user/hapus/').$value['user_id'] ?>">
                            <i class="bi bi-trash fs-16" data-bs-toggle="tooltip" data-bs-placement="left"
                                data-bs-original-title="Hapus Data"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="user_id" value="">
                            <div class="form-floating mb-2 column">
                                <input type="text" class="form-control" name="user_username" id="user_username"
                                    placeholder="user_username" name="user_username">
                                <label for="user_username">username user</label>
                                <div class="invalid-feedback ms-2"></div>
                            </div>
                            <div class="form-floating mb-2 column">
                                <input type="text" class="form-control" name="user_fullname" id="user_fullname"
                                    placeholder="user_fullname" name="user_fullname">
                                <label for="user_fullname">nama full user</label>
                                <div class="invalid-feedback ms-2"></div>
                            </div>
                            <div class="form-floating mb-2 column">
                                <input type="text" class="form-control" name="user_phone_number" id="user_phone_number"
                                    placeholder="user_phone_number" name="user_phone_number">
                                <label for="user_phone_number">no telp</label>
                                <div class="invalid-feedback ms-2"></div>
                            </div>
                            <div class="form-floating mb-2 column">
                                <select class="form-control" name="user_role" id="user_role">
                                    <option value="">- Pilih Role -</option>
                                    <option value="Operator">Operator</option>
                                    <option value="Pelanggan">Pelanggan</option>
                                </select>
                                <div class="invalid-feedback ms-2"></div>
                            </div>

							<div class="form-floating mb-2 column">
								<textarea class="form-control" name="alamat" id="alamat" placeholder="alamat" style="height: 100px;"></textarea>
								<label for="alamat">Alamat</label>
								<div class="invalid-feedback ms-2"></div>
							</div>

                            <div class="form-floating mb-2 column">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="user_password" id="user_password"
                                        placeholder="user_password">
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                    </span>
                                </div>
                                <div class="invalid-feedback ms-2"></div>
                            </div>
                            <div class="form-floating mb-2 column">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" placeholder="password_confirmation"
                                        name="password_confirmation">
                                    <span class="input-group-text" id="togglePassword2">
                                        <i class="bi bi-eye-slash" id="toggleIcon2"></i>
                                    </span>
                                    <div class="invalid-feedback ms-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success action">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(document).on('click', '.tambah', function(e) {
        e.preventDefault();
        formulir('user', 'tambah', 'form');
    });

    $(document).on('click', '.btn-ubah', function() {
        var id = $(this).attr('idnya');
        $('#form input[name=user_id]').val(id);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/user/detail') ?>',
            data: 'user_id=' + id,
            dataType: 'json',
            success: function(result) {
                get_suku(result.user_instansi_id);
                $('#form input[name=user_username]').val(result.user_username);
                $('#form input[name=user_fullname]').val(result.user_fullname);
                $('#form input[name=user_name]').val(result.user_name);
                $('#user_role').val(result.user_role);
            }
        })
    })

    $(document).on('click', '.ubah', function(e) {
        e.preventDefault();
        formulir('user', 'ubah', 'form');
    });

})

// Menampilkan atau menyembunyikan kata sandi pada input user_password saat ikon mata diklik
$(document).on('click', '#togglePassword', function() {
    const passwordField = $('#user_password');
    const passwordToggle = $('#toggleIcon');

    if (passwordField.attr('type') === 'password') {
        passwordField.attr('type', 'text');
        passwordToggle.removeClass('bi-eye-slash').addClass('bi-eye');
    } else {
        passwordField.attr('type', 'password');
        passwordToggle.removeClass('bi-eye').addClass('bi-eye-slash');
    }
});

// Menampilkan atau menyembunyikan kata sandi pada input password_confirmation saat ikon mata diklik
$(document).on('click', '#togglePassword2', function() {
    const confirmPasswordField = $('#password_confirmation');
    const confirmPasswordToggle = $('#toggleIcon2');

    if (confirmPasswordField.attr('type') === 'password') {
        confirmPasswordField.attr('type', 'text');
        confirmPasswordToggle.removeClass('bi-eye-slash').addClass('bi-eye');
    } else {
        confirmPasswordField.attr('type', 'password');
        confirmPasswordToggle.removeClass('bi-eye').addClass('bi-eye-slash');
    }
});
</script>
