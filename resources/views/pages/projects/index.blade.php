@extends("layouts.base")

@section("menu")
Proyek
@endsection

@section("current_page")
Daftar Proyek
@endsection


@section("contents")
<div class="pb-4">
    <a class="btn btn-info" href="{{route('project.create')}}">Tambah Proyek</a>
</div>
<div class="card border-light shadow-sm components-section">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped w-100" id="projectsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Proyek</th>
                        <th>Analis</th>
                        <th>Klien</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection


@push("header")
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
<style>
    .dataTables_paginate.paging_simple_numbers {
        padding-top: 50px;
    }

    div[role="status"].dataTables_info {
        padding-top: 50px;
    }
</style>
@endpush

@push("script")
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        let dt = $("#projectsTable").DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'analyst_name',
                    name: 'analyst_name'
                },
                {
                    data: 'client_name',
                    name: 'client_name'
                },
                {
                    data: 'created_at_text',
                    name: 'created_at_text'
                },
                {
                    data: 'project_id',
                    orderable: false,
                    searchable: false,
                    width: '15%',
                    render: (data, type, row) => {
                        return `
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-secondary">Aksi</button> 
                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg> 
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu py-0" aria-labelledby="dropdownMenuReference" style="">
                                    <li><a class="dropdown-item rounded-top deleteProject" href="#" data-delete="${row?.delete_link}" ><i class="fa fa-trash"></i> Hapus</a></li>
                                    <li><a class="dropdown-item rounded-top" href="${row?.edit_link}"><i class="fa fa-pencil"></i> Edit</a></li>
                                </ul>
                            </div>
                        `;
                    }
                },
            ],
            columnDefs: [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {
                    className: "align-middle",
                    targets: [0, 1, 2, 3, 4]
                },

            ]
        });
        $(document).on("click", ".deleteProject", function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Konfirmasi Hapus Proyek",
                text: "Apakah anda ingin menghapus proyek ini? Tindakan tidak dapat diurungkan!",
                icon: "question",
                showCancelButton: true,
                cancelButtonText: "Batalkan",
                preConfirm: () => {
                    return axios.delete(`${$(e.currentTarget).data("delete")}&_token={{ csrf_token() }}`)
                        .then(() => {
                            Swal.fire({
                                    title: "Sukses",
                                    text: "Berhasil menghapus data",
                                    toast: true,
                                    timer: 2000,
                                    icon: "success"
                                })
                                .then(() => {
                                    location.reload();
                                })
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                }
            });
        });
    });
</script>

@endpush