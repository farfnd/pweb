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
            <button type="button" class="btn btn-primary mb-2 float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-user-plus"></i>&nbsp;Tambah baru</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
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
            if(!dataGuru.nama.length ||
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

            if(!flag){
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
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: 'Periksa kembali data yang Anda masukkan',
                    heightAuto: false
                });
            }
        });
    </script>
</body>

</html>