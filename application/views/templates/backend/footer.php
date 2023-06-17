<footer class="main-footer">
	<div class="float-right d-none d-sm-block">
		<b>Version</b> 3.2.0
	</div>
	<strong>Copyright &copy; <?= date('Y'); ?> <a href="<?php echo $this->config->item('instagram'); ?>"><?php echo $this->config->item('programmer_name'); ?></a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Page specific script -->
<script>
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"lengthChange": true,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

		//Initialize Select2 Elements
		$('.select2').select2()

		$('[data-toggle="tooltip"]').tooltip()

	});
</script>

<script>
	$(document).ready(function() {
		$('#dokumentasi').click(function(e) {
			e.preventDefault();
			Swal.fire({
				icon: 'warning',
				title: 'Peringatan',
				text: 'Maaf, dokumentasi saat ini belum tersedia.',
				showCancelButton: false,
				confirmButtonText: 'OK'
			});
		});
	});
</script>

</body>

</html>