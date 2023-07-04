<!-- Portfolio Start -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="position-relative d-inline text-primary ps-4"><?= $title; ?></h6>
            <h2 class="mt-2">Luangkan waktu sejenak untuk mengisi kuesioner berikut <br><?php $this->view('messages') ?></h2>
        </div>
        <div class="row g-4">
            <div class="col-md-12">
                <div class="alert alert-info text-black">
                    <ul>Petunjuk
                        <li>Pilihlah jawaban yang sesuai dengan pendapat anda.</li>
                        <li>
                            Keterangan pernyataan sebagai berikut: <br>
                            <small>
                                1. SS = Sangat Setuju (Point = 5) <br>
                                2. S = Setuju (Point = 4) <br>
                                3. RR = Ragu-ragu (Point = 3) <br>
                                4. TS = Tidak Setuju (Point = 2) <br>
                                5. STS = Sangat Tidak Setuju (Point = 1)
                            </small>
                        </li>
                    </ul>
                </div>
                <div class="alert alert-danger text-black">
                    Petunjuk Pengisian Survei <br>
                    1. Lengkapi dulu biodata singkat anda dikolom sebelah kiri anda <br>
                    2. Kemudian lanjut memilih jawaban sesuai dengan pendapat anda dikolom sebelah kanan anda <br>
                    3. Klik tombol "Kirim Survei" untuk mengakhiri Pengisian Survei
                </div>
            </div>
            <form action="<?= site_url('home/proses'); ?>" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                Mohon isi biodata anda dibawah
                            </div>
                            <div class="card-body">
                                <!-- <input type="hidden" id="ip_address" name="ip_address"> -->
                                <div class="form-group">
                                    <label for="nama">Nama lengkap anda</label>
                                    <input type="text" name="nama" id="nama" class="form-control" value="<?= set_value('nama'); ?>" autofocus>
                                    <?= form_error('nama') ?>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="alamat">Alamat lengkap anda</label>
                                    <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Jl. Abc Desa Def Kecamatan Ghi Kabupaten Jkl"><?= set_value('alamat'); ?></textarea>
                                    <?= form_error('alamat') ?>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">Email aktif anda</label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?= set_value('email'); ?>">
                                    <?= form_error('email') ?>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">Kapal tempat anda bekerja </label>
                                    <select name="kapal_id" id="kapal_id" class="form-control">
                                        <option value="">Pilih Kapal</option>
                                        <?php foreach ($ships->result() as $ship) : ?>
                                            <option value="<?= $ship->kapal_id; ?>">Kapal <?= ucwords($ship->kapal_nama); ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <?= form_error('kapal_id') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered table-hover table-primary">
                            <thead>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th class="text-center">Pilihan Jawaban</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($row->result() as $data) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data->pertanyaan_text; ?></td>
                                        <td style="font-size: x-small;">
                                            <input type="hidden" name="pertanyaan_id[]" value="<?= $data->pertanyaan_id; ?>">
                                            <select name="jawaban_isi[]" id="jawaban_isi" class="form-control form-select-sm">
                                                <option value="">Pilih Jawaban</option>
                                                <option value="SS">Sangat Setuju</option>
                                                <option value="S">Setuju</option>
                                                <option value="RR">Ragu-Ragu</option>
                                                <option value="TS">Tidak Setuju</option>
                                                <option value="STS">Sangat Tidak Setuju</option>
                                            </select>
                                            <?= form_error('jawaban_isi[]') ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <button type="submit" id="btnSave" class="btn btn-primary"><i class="fa fa-save"></i> Kirim Survei</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Portfolio End -->

<script>
    window.addEventListener('DOMContentLoaded', function() {
        var ipAddressInput = document.getElementById('ip_address');
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://api.ipify.org?format=json', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                ipAddressInput.value = response.ip;
            }
        };
        xhr.send();
    });
</script>