@extends('layouts.master')
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            {{ session('success') }}
        </div>
    @elseif(session('failed'))
        <div class="alert alert-danger alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            {{ session('failed') }}
        </div>
    @endif
    <div class="row mb-5 d-print-none">

        <div class="col-md-12">
            <div class="card shadow-lg ">
                <div class="card-body p-3">
                    <h5>{{ $title }}</h5>

                </div>

            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <!-- Button trigger modal -->
                <div class="col-md-4 mt-2 mx-3">
                    <button type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModalMessage">
                        Tambah
                    </button>
                </div>

                <div class="card-body  pt-0 pb-2">
                    <div class=" p-0">
                        <table id="table_id">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 align-middle text-center">
                                        Nama Kategori
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">
                                        Kode Kategori</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 align-middle text-center">
                                        Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class=" text-center text-xs font-weight-bold">{{ $dt->nama_kategori }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $dt->kode_kategori }}</p>
                                        </td>


                                        <td class="align-middle text-center">
                                            <button class="btn btn-outline-dark btn-sm editKtg" ktg-id="{{ $dt->id }}"
                                                data-jenis="edit">
                                                edit
                                            </button>
                                            <a href="#" class="btn btn-outline-danger btn-sm hapus-ktg"
                                                ktg-id="{{ $dt->id }}" ktg-nama="{{ $dt->nama_kategori }}">
                                                hapus</a>


                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/simpan-kategori" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nama Kategori:</label>
                                <input type="text" class="form-control" id="recipient-name" name="nama_kategori">
                                @error('nama_kategori')
                                    <script>
                                        $(document).ready(function() {
                                            $(function() {
                                                $('#exampleModalMessage').modal({
                                                    show: true
                                                });
                                            });
                                        });
                                    </script>
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Kode Kategori:</label>
                                <input type="text" class="form-control" id="recipient-kode" value="{{ $kode }}"
                                    name="kode_kategori" readonly>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary "
                            onclick="argon.showSwal('success-message')">Simpan</button>
                        {{-- <button type="submit" class="btn bg-gradient-primary">Simpan</button> --}}
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/simpan-kategori" method="POST">
                            @csrf
                            <input type="hidden" name="kateg_id" id="kateg_id" value="">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nama Kategori:</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori">
                                @error('nama_kategori')
                                    <span class="help-block text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Kode Kategori:</label>
                                <input type="text" class="form-control" id="kode_kategori" value=""
                                    name="kode_kategori" readonly>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary "
                            onclick="argon.showSwal('success-message')">Simpan</button>
                        {{-- <button type="submit" class="btn bg-gradient-primary">Simpan</button> --}}
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

@stop
@section('foot')
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();

            let url = '/edit-kategori'
            // let ktg_id = $(this).val();
            $(document).on('click', '.editKtg', function() {
                var ktg_id = $(this).attr('ktg-id');
                $('#editModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/update-kategori/" + ktg_id,
                    success: function(response) {
                        console.log(response);
                        $('#nama_kategori').val(response.data.nama_kategori);
                        $('#kode_kategori').val(response.data.kode_kategori);
                        $('#kateg_id').val(response.data.id);
                    }
                });
            })

        });



        // Swal.fire(
        //     'Good job!',
        //     'You clicked the button!',
        //     'success'
        // )
        $('.hapus-ktg').click(function() {
            var kategori_id = $(this).attr('ktg-id');
            var kategori_nama = $(this).attr('ktg-nama');
            Swal.fire({
                title: 'Yakin ?',
                text: "Mau dihapus data kategori " + kategori_nama,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#825ee4',
                cancelButtonColor: '#f5365c',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/hapus-kategori/" + kategori_id;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )

                }
            })
        })
    </script>
@endsection
