@extends('components.aplikasi')
@section('konten')
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="index.html" class="logo">
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
            <!-- End Logo Header -->
            @include('components.navbar')
            <!-- Sidebar -->
            @include('components.sidebar')

            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Barang Table</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="/home">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="/barang">Tabel Barang </a>
                                </li>

                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Barang Table</h4>
                                    </div>
                                    <div class="mt-2">
                                        <a href="" class="btn btn-danger tombol-tambah mt-1 ml-2" data-toggle="modal"
                                            data-target="#exampleModal" style="float: right;"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="mr-2 bi bi-plus-square-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0" />
                                            </svg><span class="btn-tambah-barang">Add Iventory</span></a>

                                        <a href="{{ url('barang/export') }}"
                                            class="btn border  border-dark   btn-warning mb-5 mt-1 ml-2 "
                                            style="float: right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="mr-2 bi bi-arrow-down-square-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0" />
                                            </svg><span>Export Excel</span></a>
                                    </div>
                                    <div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <select name="kategori_barang" id="kategori_barang"
                                                    class="form-control ml-3">
                                                    <option value="" disabled selected>Pilih Kategori</option>
                                                    @foreach ($kategori as $item)
                                                        <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" id="min_jumlah" min="1" class="form-control"
                                                    placeholder="Minimal Stok">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" id="max_jumlah" min="1" class="form-control"
                                                    placeholder="Maximal Stok">
                                            </div>
                                            <div class="col-md-3 ">
                                                <input type="number" id="min_harga" min="1" class="form-control"
                                                    placeholder="Minimal Harga">
                                            </div>
                                            <div class="col-md-3 ml-3 mt-3">
                                                <input type="number" id="max_harga" min="1" class="form-control"
                                                    placeholder="Maximal harga Harga">
                                            </div>
                                            <div class="col-md-3 mt-3">
                                                <button id="filter" class="btn btn-primary">Filter</button>
                                                <button id="reset" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="barangTable" class="display table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Kategori</th>
                                                        <th>Stok</th>
                                                        <th>Harga Satuan</th>
                                                        <th class="col-md-3">Aksi</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </main>

        </div>
    </div>
    </div>
    {{-- modal tambah --}}
    @include('components.barangModals')
@section('script')
    <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#barangTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('barang.datatables') }}",
                    type: 'GET',
                    data: function(d) {
                        d.kategori = $('#kategori_barang').val();
                        d.min_jumlah = $('#min_jumlah').val();
                        d.max_jumlah = $('#max_jumlah').val();
                        d.min_harga = $('#min_harga').val(); // Filter min harga
                        d.max_harga = $('#max_harga').val();
                        console.log('Kategori:', d.kategori);
                        console.log('Min Jumlah:', d.min_jumlah);
                        console.log('Max Jumlah:', d.max_jumlah);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'kategori',
                        name: 'kategori'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#filter').click(function() {
                table.draw();
            });

            $('#reset').on('click', function() {
                $('#kategori_barang').val('');
                $('#min_jumlah').val('');
                $('#max_jumlah').val('');
                $('#min_harga').val(''); // Reset min harga
                $('#max_harga').val('');
                table.ajax.reload();
            });
        });

        // METODE ADD
        $(document).ready(function() {
            // Event listener untuk tombol simpan
            $('.tombol-simpan').on('click', function() {
                var form = $('#tambahBarangForm');
                var url = "{{ route('barang.store') }}"; // URL untuk store data barang

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: form.serialize(), // Mengirimkan data form
                    success: function(response) {
                        if (response.success) {
                            // Jika sukses, tampilkan notifikasi
                            $('#exampleModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message
                            }).then(() => {
                                // Tutup modal
                                $('#modalTitleEdit').text('Tambah Data Barang');
                                $('#nama_barang').val(''); // Kosongkan input field
                                $('#kategori_id').val('');
                                $('#jumlah').val('');
                                $('#harga').val('');

                                // Refresh tabel atau lakukan tindakan lain
                                $('#barangTable').DataTable().ajax.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan!',
                            text: 'Silakan coba lagi.'
                        });
                    }
                });
            });
        });

        // METODE SHOW
        $('body').on('click', '.btn-show-barang', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: '/barang/' + id,
                type: 'GET',
                success: function(response) {
                    // Tampilkan detail data dalam modal atau area lain
                    $('#showModal').modal('show');
                    $('#showModal .modal-body').html(`
                    <p><strong>Nama Barang:</strong> ${response.result.nama_barang}</p>
                    <p><strong>Kategori:</strong> ${response.result.kategori.kategori}</p>
                    <p><strong>Jumlah:</strong> ${response.result.jumlah}</p>
                    <p><strong>Harga:</strong> ${response.result.harga}</p>`)
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengambil data.',
                    });
                }
            });
        });

        // METODE EDIT 
        $(document).on('click', '.btn-edit-barang', function() {
            var id = $(this).data('id');
            $.get('{{ url('barang') }}/' + id + '/edit', function(data) {
                $('#editModal #id').val(data.barang.id);
                $('#editModal #nama_barang').val(data.barang.nama_barang);
                $('#editModal #kategori_id').val(data.barang.kategori_id);
                $('#editModal #jumlah').val(data.barang.jumlah);
                $('#editModal #harga').val(data.barang.harga);
                $('#editModal').modal('show');
            });
        });

        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ url('barang') }}/' + $('#editModal #id').val(),
                method: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#editModal').modal('hide');
                        $('#barangTable').DataTable().ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });

        // delete

        $(document).on('click', '.btn-delete-barang', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Anda yakin?',
                text: "Data akan dihapus secara permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ url('barang') }}/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#barangTable').DataTable().ajax.reload();
                                Swal.fire(
                                    'Dihapus!',
                                    response.message,
                                    'success'
                                );
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Terjadi kesalahan. Silakan coba lagi.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
@endsection
