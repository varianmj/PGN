<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h5 class="card-title">Pemakaian</h5>
                <small>Informasi Data Pemakaian</small>
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
                    <th>Nama</th>
                    <th>Nilai Pemakaian</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $key => $value): ?>
                <tr>
                    <td class="text-center"><?php echo $key+1 ?></td>
                    <td><?php echo $value['user_fullname'] ?></td>
                    <td><?php echo $value['volume'] ?></td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-warning btn-ubah pop-up" data-bs-toggle="modal" data-bs-target="#modal"
                            href="#modal" data-action="ubah" data-form="form" data-table="user"
                            idnya="<?php echo $value['id'] ?>">
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
                            <input type="hidden" name="id" value="">
                            <div class="form-floating mb-2 column">
                                <select class="form-control" name="user_id" id="selectPelanggan">
                                </select>
                                <div class="invalid-feedback ms-2"></div>
                            </div>
                        </div>

						<div class="form-floating mb-2 column">
                                <input type="text" class="form-control" name="volume" id="volume"
                                    placeholder="volume" name="volume">
                                <label for="volume">Volume</label>
                                <div class="invalid-feedback ms-2"></div>
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
        formulir('pemakaian', 'tambah', 'form');
    });

    $(document).on('click', '.btn-ubah', function() {
        var id = $(this).attr('idnya');
        $('#form input[name=id]').val(id);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/pemakaian/detail') ?>',
            data: 'user_id=' + id,
            dataType: 'json',
            success: function(result) {
                get_pelanggan(result.user_id);
                $('#form input[name=volume]').val(result.volume);
            }
        })
    })

    $(document).on('click', '.ubah', function(e) {
        e.preventDefault();
        formulir('pemakaian', 'ubah', 'form');
    });

})

function tambah() {
    get_pelanggan()
}

function get_pelanggan(selectedId) {
    if (selectedId !== "") {
        $.ajax({
            url: "<?php echo site_url('admin/Pemakaian/getPelanggan') ?>",
            type: 'GET',
            "content_type": 'application/json',
            success: function(res) {
                arr_data = res.data
                let html = '<option value="">- Pilih Pelanggan -</option>'
                arr_data.forEach((item, index) => {
                    let selected = "";
                    if (item.user_id == selectedId) {
                        selected = "selected";
                    }
                    html +=
                        `
						<option value="${item.user_id}" ${selected}>${item.user_fullname}</option>
						`
                });
                $('#selectPelanggan').html(html);
            }
        });
    } else {
        $.ajax({
            url: "<?php echo site_url('admin/Instansi/getInstansi') ?>",
            type: 'GET',
            "content_type": 'application/json',
            success: function(res) {
                arr_data = res.data
                let html = '<option value="" >- Pilih Pelanggan -</option>'
                arr_data.forEach((item, index) => {
                    html +=
                        `
								<option value="${item.user_id}">${item.user_fullname}</option>
							`
                });
                $('#selectPelanggan').html(html);
            }
        });
    }
}
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
