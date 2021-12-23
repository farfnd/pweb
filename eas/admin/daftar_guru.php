<?php

include '../config.php';

session_start();

if (!isset($_SESSION['user']['nama'])) {
    header("Location: /login.php");
} else if ($_SESSION['user']['role'] == 'siswa') {
    header("Location: /siswa");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Admin | Daftar Guru</title>
</head>

<body>
    <?php echo "<h1>Selamat Datang, " . $_SESSION['user']['nama'] . "!" . "</h1>"; ?>
    <div class="row mb-3">
        <div class="col-sm-6">
            <h2>Daftar Guru</h2>
        </div>
        <div class="col-sm-6 float-end">
            <button type="button" class="btn btn-primary mb-2 float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-user-plus"></i>&nbsp;Tambah baru</button>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nama Guru</th>
                <th scope="col">Kode</th>
                <th scope="col">Usia</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $sql = "SELECT * FROM users WHERE role = 'guru'";
                $query = mysqli_query($db, $sql);

                while ($guru = mysqli_fetch_array($query)) {
                    echo '<tr>';
                    echo '<td>' . $guru['nama'] . '<br>' . $guru['id'] . '</td>';
                    echo '<td>' . $guru['kode_guru'] . '</td>';

                    $origin = date_create($guru['tanggal_lahir']);
                    $target = date_create();
                    $interval = date_diff($origin, $target);
                    echo '<td>' . $interval->format('%y Tahun') . '</td>';

                    echo '<td>' . $guru['kelas'] . '<br>' . $guru['mapel'] . '</td>';

                    echo '<td>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-primary mb-2 w-100" data-bs-toggle="modal" data-bs-target="#readModal" onclick="readData(' . $guru['id'] . ')">Lihat Detail</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-warning mb-2 w-100" data-bs-toggle="modal" data-bs-target="#editModal" onclick="getData(' . $guru['id'] . ')">Edit</a>
                                    </div>
                                    <div class="col-sm-6">
                                        <button type="button" class="btn btn-danger mb-2 w-100" onclick="deleteData(' . $guru['id'] . ')">Hapus</a>
                                    </div>
                                </div>
                            </td>';
                    echo '</tr>';
                }
            } else {
                die("Method not allowed");
            }

            ?>
        </tbody>
    </table>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModal">Tambah Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="daftar_guru.php" method="post" id="formAddGuru">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama lengkap Anda" required>
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Surabaya" required>
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="id" id="id" placeholder="51000xxx" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    <label for="id">NIP</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="kode_guru" id="kode_guru" placeholder="AA" required minlength="2" maxlength="2">
                                    <label for="kode_guru">Kode</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-select form-floating mb-3" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option label="Pilih jenis kelamin" hidden></option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="agama">Agama</label>
                                <select class="form-select mb-3" name="agama" id="agama" required>
                                    <option label="Pilih agama" hidden></option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Khonghucu">Khonghucu</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kelas">Kelas</label>
                                <select class="form-select mb-3" name="kelas" id="kelas" required>
                                    <option label="Pilih kelas" hidden></option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="mapel" id="mapel" placeholder="Bahasa Indonesia">
                                    <label for="mapel">Mapel</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Alamat Anda" name="alamat" id="alamat" style="height: 100px" required></textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Pas foto</label>
                            <input class="form-control" type="file" name="foto" id="foto" accept=".png, .jpg, .jpeg">
                            <img src="" style="max-height: 100px; width: auto" id="previewImg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" name="submit" id="submit-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="readModal" tabindex="-1" aria-labelledby="readModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="readModalLabel">Lihat Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama" id="nama_read" placeholder="Nama lengkap Anda" disabled>
                        <label for="nama">Nama Lengkap</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir_read" placeholder="Surabaya" disabled disabled>
                                <label for="tempat_lahir">Tempat Lahir</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir_read" disabled>
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="id" id="id_read" placeholder="51000xxx" disabled oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                <label for="id">NIP</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="kode_guru" id="kode_guru_read" placeholder="AA" disabled minlength="2" maxlength="2">
                                <label for="kode_guru">Kode</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-select form-floating mb-3" name="jenis_kelamin" id="jenis_kelamin_read" disabled>
                                <option label="Pilih jenis kelamin" hidden></option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="agama">Agama</label>
                            <select class="form-select mb-3" name="agama" id="agama_read" disabled>
                                <option label="Pilih agama" hidden></option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Khonghucu">Khonghucu</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="kelas">Kelas</label>
                            <select class="form-select mb-3" name="kelas" id="kelas_read" disabled>
                                <option label="Pilih kelas" hidden></option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="mapel" id="mapel_read" placeholder="Bahasa Indonesia" disabled>
                                <label for="mapel">Mapel</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Alamat Anda" name="alamat" id="alamat_read" style="height: 100px" disabled></textarea>
                        <label for="alamat">Alamat</label>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Pas foto</label><br>
                        <img src="" style="max-height: 100px; width: auto" id="previewImg_read">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="U_guru.php" method="post" id="form-edit">
                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama" id="nama_edit" placeholder="Nama lengkap Anda" required>
                            <label for="nama">Nama Lengkap</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir_edit" placeholder="Surabaya" required>
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir_edit" required>
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="id" id="id_edit" placeholder="51000xxx" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    <label for="id">NIP</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="kode_guru" id="kode_guru_edit" placeholder="AA" required minlength="2" maxlength="2">
                                    <label for="kode_guru">Kode</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-select form-floating mb-3" name="jenis_kelamin" id="jenis_kelamin_edit" required>
                                    <option label="Pilih jenis kelamin" hidden></option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="agama">Agama</label>
                                <select class="form-select mb-3" name="agama" id="agama_edit" required>
                                    <option label="Pilih agama" hidden></option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Khonghucu">Khonghucu</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kelas">Kelas</label>
                                <select class="form-select mb-3" name="kelas" id="kelas_edit" required>
                                    <option label="Pilih kelas" hidden></option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="mapel" id="mapel_edit" placeholder="Bahasa Indonesia">
                                    <label for="mapel">Mapel</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Alamat Anda" name="alamat" id="alamat_edit" style="height: 100px" required></textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Pas foto</label>
                            <input class="form-control" type="file" name="foto" id="foto_edit" accept=".png, .jpg, .jpeg">
                            <img src="" style="max-height: 100px; width: auto" id="previewImg_edit">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" name="submit" id="edit-btn">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="/logout.php" class="btn btn-primary">Logout</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/330b1f288e.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $('#foto').change(function(e) {
            if (e.target.files && e.target.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImg').addClass('mt-3');
                    $('#previewImg').attr('src', e.target.result);
                }

                reader.readAsDataURL(e.target.files[0]); // convert to base64 string
            }
        });

        $('#submit-btn').on('click', () => {
            var form = $('#formAddGuru')[0];
            var fd = new FormData(form);

            let dataGuru = {
                nama: $('#nama').val(),
                tempat_lahir: $('#tempat_lahir').val(),
                tanggal_lahir: $('#tanggal_lahir').val(),
                id: $('#id').val(),
                kode_guru: $('#kode_guru').val(),
                jenis_kelamin: $('#jenis_kelamin').val(),
                agama: $('#agama').val(),
                kelas: $('#kelas').val(),
                mapel: $('#mapel').val(),
                alamat: $('#alamat').val(),
                foto: $('#foto')[0].files[0]
            }

            let flag = false;
            if (!dataGuru.nama.length ||
                !foto ||
                !dataGuru.jenis_kelamin.length ||
                !dataGuru.tempat_lahir.length ||
                !dataGuru.tanggal_lahir.length ||
                !dataGuru.id.length ||
                !dataGuru.kode_guru.length ||
                !dataGuru.kelas.length ||
                !dataGuru.mapel.length ||
                !dataGuru.agama.length ||
                !dataGuru.alamat.length) flag = true

            if (!flag) {
                fd.append('nama', dataGuru.nama);
                fd.append('tempat_lahir', dataGuru.tempat_lahir);
                fd.append('tanggal_lahir', dataGuru.tanggal_lahir);
                fd.append('id', dataGuru.id);
                fd.append('kode_guru', dataGuru.kode_guru);
                fd.append('jenis_kelamin', dataGuru.jenis_kelamin);
                fd.append('kelas', dataGuru.kelas);
                fd.append('mapel', dataGuru.mapel);
                fd.append('agama', dataGuru.agama);
                fd.append('alamat', dataGuru.alamat);
                fd.append('foto', dataGuru.foto);

                $.ajax({
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    url: "C_guru.php",
                    data: fd,
                    success: function(resultData) {
                        console.log(resultData);
                        form.reset();
                        $('#previewImg').attr('src', '');
                        Swal.fire({
                            icon: 'success',
                            title: 'Tambah guru berhasil',
                            text: 'Data berhasil terkirim',
                            heightAuto: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: 'Periksa kembali data yang Anda masukkan',
                    heightAuto: false
                });
            }
        });

        const readData = (id => {
            $('#form-edit')[0].reset();
            $.ajax({
                type: 'GET',
                url: "R_guru.php?id=" + id,
                success: function(resultData) {
                    let data = JSON.parse(resultData);
                    $('#edit-btn').data('id', id);
                    $('#nama_read').val(data.nama);
                    $('#previewImg_read').attr('src', `/images/${data.foto}`);
                    $('#previewImg_read').addClass('mt-3');
                    $('#jenis_kelamin_read option[value=' + data.jenis_kelamin + ']').attr('selected', 'selected');
                    $('#agama_read option[value=' + data.agama + ']').attr('selected', 'selected');
                    $('#kelas_read option[value=' + data.kelas + ']').attr('selected', 'selected');
                    $('#tempat_lahir_read').val(data.tempat_lahir);
                    $('#tanggal_lahir_read').val(data.tanggal_lahir);
                    $('#id_read').val(data.id);
                    $('#kode_guru_read').val(data.kode_guru);
                    $('#mapel_read').val(data.mapel);
                    $('#alamat_read').val(data.alamat);
                }
            });
        });

        const getData = (id => {
            $('#form-edit')[0].reset();
            $.ajax({
                type: 'GET',
                url: "R_guru.php?id=" + id,
                success: function(resultData) {
                    let data = JSON.parse(resultData);
                    $('#edit-btn').data('id', id);
                    $('#nama_edit').val(data.nama);
                    $('#previewImg_edit').attr('src', `/images/${data.foto}`);
                    $('#previewImg_edit').addClass('mt-3');
                    $('#jenis_kelamin_edit option[value=' + data.jenis_kelamin + ']').attr('selected', 'selected');
                    $('#agama_edit option[value=' + data.agama + ']').attr('selected', 'selected');
                    $('#kelas_edit option[value=' + data.kelas + ']').attr('selected', 'selected');
                    $('#tempat_lahir_edit').val(data.tempat_lahir);
                    $('#tanggal_lahir_edit').val(data.tanggal_lahir);
                    $('#id_edit').val(data.id);
                    $('#kode_guru_edit').val(data.kode_guru);
                    $('#mapel_edit').val(data.mapel);
                    $('#alamat_edit').val(data.alamat);
                }
            });
        });

        $('#edit-btn').on('click', () => {
            var form = $('#form-edit')[0];
            var fd = new FormData(form);
            let dataGuru = {
                nama: $('#nama_edit').val(),
                tempat_lahir: $('#tempat_lahir_edit').val(),
                tanggal_lahir: $('#tanggal_lahir_edit').val(),
                id: $('#id_edit').val(),
                kode_guru: $('#kode_guru_edit').val(),
                jenis_kelamin: $('#jenis_kelamin_edit').val(),
                agama: $('#agama_edit').val(),
                kelas: $('#kelas_edit').val(),
                mapel: $('#mapel_edit').val(),
                alamat: $('#alamat_edit').val()
            }

            let flag = false;
            if (!dataGuru.nama.length ||
                !dataGuru.jenis_kelamin.length ||
                !dataGuru.tempat_lahir.length ||
                !dataGuru.tanggal_lahir.length ||
                !dataGuru.id.length ||
                !dataGuru.kode_guru.length ||
                !dataGuru.kelas.length ||
                !dataGuru.mapel.length ||
                !dataGuru.agama.length ||
                !dataGuru.alamat.length) flag = true

            if (!flag) {
                fd.append('nama', dataGuru.nama);
                fd.append('tempat_lahir', dataGuru.tempat_lahir);
                fd.append('tanggal_lahir', dataGuru.tanggal_lahir);
                fd.append('id', dataGuru.id);
                fd.append('kode_guru', dataGuru.kode_guru);
                fd.append('jenis_kelamin', dataGuru.jenis_kelamin);
                fd.append('kelas', dataGuru.kelas);
                fd.append('mapel', dataGuru.mapel);
                fd.append('agama', dataGuru.agama);
                fd.append('alamat', dataGuru.alamat);


                var file = $('#foto')[0].files[0]
                if (file) fd.append('foto', file);

                $.ajax({
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    url: "U_guru.php",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(resultData) {
                        console.log(resultData);
                        Swal.fire({
                            icon: 'success',
                            title: 'Edit data berhasil',
                            text: 'Data berhasil diperbarui',
                            heightAuto: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.reset();
                                location.reload();
                            }
                        })
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: 'Periksa kembali data yang Anda masukkan',
                    heightAuto: false
                });
            }
        });

        const deleteData = (id => {
            Swal.fire({
                title: 'Apakah Anda yakin akan menghapus data guru?',
                text: "Tindakan ini tidak bisa dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#0d6efd',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: "D_guru.php?id=" + id,
                        success: function(resultData) {
                            console.log(resultData);
                            Swal.fire({
                                icon: 'success',
                                title: 'Hapus data berhasil',
                                text: 'Data berhasil dihapus',
                                heightAuto: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        }
                    });
                }
            })
        });
    </script>
</body>

</html>