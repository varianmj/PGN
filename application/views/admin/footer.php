</section>
</main>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Zenyer</span></strong>. All Rights Reserved 2023
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS -->
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/apexcharts.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/bootstrap.bundle.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/sweetalert2.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/chart.umd.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/echarts.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/simple-datatables.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/validate.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/datatables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/datatables.bootstrap5.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/buffer.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/filetype.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/piexif.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/sortable.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/fileinput.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/lightbox.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/vendor/tinymce.min.js') ?>"></script>x
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/select2.min.js') ?>"></script>

<!-- Main JS -->
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/main.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/admin/js/custom.js') ?>"></script>

<script>
$(document).ready(function() {
    var pesan = '<?php echo $this->session->flashdata('pesan') ?>';
    if (pesan != '') {
        notif(pesan);
    }

    $('.select2').select2({
        theme: 'bootstrap-5'
    });
})
</script>
</body>

</html>
