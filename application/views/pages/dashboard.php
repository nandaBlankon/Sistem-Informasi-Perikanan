<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= ucwords($title); ?>.</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?= $kapal->num_rows(); ?></h3>

							<p>Data Kapal</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="<?= site_url('data-kapal.html'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-success">
						<div class="inner">
							<h3><?= $nelayan->num_rows(); ?></h3>

							<p>Data Nelayan</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="<?= site_url('data-nelayan.html'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-warning">
						<div class="inner">
							<h3><?= $tpi->num_rows(); ?></h3>

							<p>Data TPI</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="<?= site_url('data-tpi.html'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-danger">
						<div class="inner">
							<h3><?= $ikan->num_rows(); ?></h3>

							<p>Data Ikan</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="<?= site_url('data-ikan.html'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
		</div>

	</section>
	<!-- /.content -->

</div>
<!-- /.content-wrapper -->