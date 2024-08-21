@extends('components.aplikasi')

@section('konten')
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">
                <img src="{{ asset('img/logo.svg') }}" alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            @include('components.navbar')
            @include('components.sidebar')
            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Tambah Pengiriman</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form id="pengirimanForm">
                                            @csrf
                                            <div class="form-group">
                                                <label for="barang">Pilih Barang:</label>
                                                <select name="barang_id" id="barang_id" onchange="updateBarangDetails()"
                                                    class="form-control" required>
                                                    <option value="">-- Pilih Barang --</option>
                                                    @foreach ($barang as $barang)
                                                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="stok">Stok Tersedia:</label>
                                                <input type="number" name="stok" id="stok" class="form-control"
                                                    readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="harga_satuan">Harga Satuan:</label>
                                                <input type="text" name="harga_satuan" id="harga_satuan"
                                                    class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="jumlah">Jumlah yang Dikirim:</label>
                                                <input type="number" name="jumlah" id="jumlah" class="form-control"
                                                    min="1" step="1" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="total_harga">Total Harga:</label>
                                                <input type="text" name="total_harga" id="total_harga"
                                                    class="form-control" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="pengirim">Pengirim:</label>
                                                <input type="text" name="pengirim" id="pengirim" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="penerima">Penerima:</label>
                                                <select name="penerima" id="penerima" class="form-control" required>
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @section('pengiriman')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.getElementById('pengirimanForm').addEventListener('submit', function(e) {
                    e.preventDefault(); // Prevent default form submission

                    const formData = new FormData(this);

                    fetch("{{ route('pengiriman.store') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: data.success,
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "{{ route('pengiriman.index') }}";
                                    }
                                });
                            } else if (data.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.error,
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat mengirim data.',
                                confirmButtonText: 'OK'
                            });
                        });
                });

                function updateBarangDetails() {
                    const barangId = document.getElementById('barang_id').value;
                    const stokInput = document.getElementById('stok');
                    const hargaSatuanInput = document.getElementById('harga_satuan');
                    const jumlahInput = document.getElementById('jumlah');

                    // Fetch barang details based on selected ID
                    fetch(`/pengiriman/get-barang/${barangId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.stok) {
                                stokInput.value = data.stok;
                                hargaSatuanInput.value = data.harga;
                                jumlahInput.setAttribute('max', data.stok);
                            } else {
                                stokInput.value = '';
                                hargaSatuanInput.value = '';
                                jumlahInput.removeAttribute('max');
                            }
                        });
                }

                document.getElementById('jumlah').addEventListener('input', function() {
                    const jumlah = parseInt(this.value, 10) || 0; // Pastikan jumlah adalah angka
                    const stok = parseInt(document.getElementById('stok').value, 10) || 0;
                    const hargaSatuan = parseFloat(document.getElementById('harga_satuan').value) || 0;
                    const totalHargaInput = document.getElementById('total_harga');

                    if (jumlah > stok) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian!',
                            text: 'Jumlah tidak boleh melebihi stok yang tersedia.',
                            confirmButtonText: 'OK'
                        });
                        this.value = stok;
                    } else {
                        totalHargaInput.value = jumlah * hargaSatuan;
                    }
                });
            </script>
        @endsection
    </div>
@endsection
