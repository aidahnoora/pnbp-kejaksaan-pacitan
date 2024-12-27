@extends('layouts.main')

@section('title', 'Bidang')

@section('css')
<style>
    .custom-swal-height {
        height: 350px;
        max-height: 80vh;
    }
</style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bidang</h4>
                        <div style="float: right">
                            <a href="/bidang-tambah" class="btn btn-success btn-sm">
                                Tambah Data
                            </a>
                        </div>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="data-table">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" width="50">No.</th>
                                        <th>Nama Bidang</th>
                                        <th>Alias</th>
                                        <th class="text-center" width="100">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bidangs as $item)
                                    <tr id="index_{{ $item->id_bidang }}">
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $item->nama_bidang }}</td>
                                        <td>{{ $item->alias }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('bidang-edit', $item->id_bidang) }}" class="btn btn-sm btn-primary">
                                                Edit
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="delete-confirm"
                                                data-id="{{ $item->id_bidang }}">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#data-table').DataTable();
        } )
    </script>
    <script>
        $('body').on('click', '#delete-confirm', function() {
            let post_id = $(this).data('id');
            let token = $("meta[name='csrf-token']").attr("content");

            swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus!',
                customClass: {
                    popup: 'custom-swal-height'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('oke');

                    $.ajax({
                        url: `/bidang-delete/${post_id}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: true,
                                timer: 3000
                            });

                            $(`#index_${post_id}`).remove();
                        }
                    });
                }
            })
        });
    </script>
@endsection
