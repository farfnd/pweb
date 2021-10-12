function showDepartemen(dropdown) {
    const dep_fakultas = {
        scientics: [
            'Fisika',
            'Kimia',
            'Biologi',
            'Matematika',
            'Statistika',
            'Aktuaria',
        ],
        indsys: [
            'Teknik Mesin',
            'Teknik Sistem dan Industri',
            'Teknik Kimia',
            'Teknik Material & Metalurgi',
            'Teknik Fisika',
            'Teknik Pangan',
        ],
        civplan: [
            'Teknik Sipil',
            'Perencanaan Wilayah dan Kota',
            'Arsitektur',
            'Teknik Geomatika',
            'Teknik Lingkungan',
            'Teknik Geofisika',
        ],
        martech: [
            'Teknik Perkapalan',
            'Teknik Transportasi Laut',
            'Teknik Sistem Perkapalan',
            'Teknik Kelautan',
            'Teknik Lepas Pantai',
        ],
        electics: [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknologi Informasi',
            'Teknik Elektro',
            'Teknik Komputer',
            'Teknik Biomedik',
        ],
        creabiz: [
            'Desain Produk Industri',
            'Manajemen Bisnis',
            'Desain Interior',
            'Desain Komunikasi Visual',
            'Studi Pembangunan',
            'Manajemen Teknologi',
        ],
        vocation: [
            'Teknik Infrastruktur Sipil',
            'Teknik Kimia Industri',
            'Teknik Mesin Industri',
            'Teknik Instrumentasi',
            'Teknik Elektro Otomasi',
            'Statistika Bisnis',
        ]
    }

    const fakultas = dropdown.value;

    let departemen = null;
    switch (fakultas) {
        case 'scientics':
            departemen = dep_fakultas.scientics;
            break;
    
        case 'indsys':
            departemen = dep_fakultas.indsys;
            break;
    
        case 'civplan':
            departemen = dep_fakultas.civplan;
            break;
    
        case 'martech':
            departemen = dep_fakultas.martech;
            break;
    
        case 'electics':
            departemen = dep_fakultas.electics;
            break;
    
        case 'creabiz':
            departemen = dep_fakultas.creabiz;
            break;
    
        case 'vocation':
            departemen = dep_fakultas.vocation;
            break;
    
        default:
            break;
    }

    document.getElementById('dropdown-departemen').innerHTML = '';

    departemen.forEach(dep => document.getElementById('dropdown-departemen').innerHTML += `<option>${dep}</option>`);
}

function showJenisVaksin(button) {
    if(button.checked) {
        document.getElementById('dropdown-jenis-vaksin').style.display = "block";
        document.getElementById('dropdown-alasan').style.display = "none";
    } else {
        document.getElementById('dropdown-jenis-vaksin').style.display = "none";
    }
}

function showAlasan(button) {
    if(button.checked) {
        document.getElementById('dropdown-jenis-vaksin').style.display = "none";
        document.getElementById('dropdown-alasan').style.display = "block";
    } else {
        document.getElementById('dropdown-alasan').style.display = "none";
    }
}

function validateForm(event) {
    var valid = true;

    const nama = document.getElementById('nama_lengkap').value;
    if(/\d/.test(nama) || nama == '') {
        valid = false;
        Swal.fire({
            icon: 'error',
            text: 'Periksa kembali nama yang Anda masukkan!',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('nama_lengkap').focus();
                return false;
            } 
        })
    }

    const nrp = document.getElementById('nrp').value;
    if(/[A-Za-z]/.test(nrp) || nrp == '') {
        valid = false;
        Swal.fire({
            icon: 'error',
            text: 'Periksa kembali NRP yang Anda masukkan!',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('nrp').focus();
                return false;
            } 
        })
    }

    const fakultas = document.getElementById('fakultas').value;
    if(fakultas == "0") {
        valid = false;
        Swal.fire({
            icon: 'error',
            text: 'Harap pilih fakultas terlebih dahulu!',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('fakultas').focus();
                return false;
            } 
        })
    } else {
        if(document.getElementById('dosis_1').checked == false &&
        document.getElementById('dosis_2').checked == false &&
        document.getElementById('belum_vaksin').checked == false) {
            valid = false;
            Swal.fire({
                icon: 'error',
                text: 'Harap pilih status vaksinasi terlebih dahulu!',
            }).then((result) => {
                if (result.isConfirmed) {
                    return false;
                } 
            })
        } else {
            const jenis_vaksin = document.getElementById('jenis_vaksin').value;
            if((document.getElementById('dosis_1').checked ||
            document.getElementById('dosis_2').checked) && jenis_vaksin == "0") {
                valid = false;
                Swal.fire({
                    icon: 'error',
                    text: 'Harap pilih jenis vaksin terlebih dahulu!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('jenis_vaksin').focus();
                        return false;
                    } 
                })
            } else {
                const alasan = document.getElementById('alasan').value;
                if (document.getElementById('belum_vaksin').checked && alasan == "0") {
                    valid = false;
                    Swal.fire({
                        icon: 'error',
                        text: 'Harap pilih alasan belum vaksin terlebih dahulu!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('alasan').focus();
                            return false;
                        } 
                    })
                }
            }
        }
    }
    
    if(valid){
        Swal.fire(
            "",
            'Data berhasil terkirim!',
            'success'
        ).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            } 
        })
    }
}