@extends("layouts.base")

@section("menu")
Pihak-Pihak
@endsection

@section("breadcrumb")
Konsekuensi
@endsection

@section("title")
Konsekuensi
@endsection

@section("current_page")
Konsekuensi
@endsection

@section("contents")
<div x-data="__initAlpine()">
    <div class="pb-4">
        <a href="{{route('project_consequences.create', request()->segment(2))}}" class="btn btn-info">Tambah Konsekuensi</a>
    </div>
    <div class="card border-light shadow-sm components-section">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="consequenceTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipe Konsekuensi</th>
                            <th>Pihak</th>
                            <th>Besaran</th>
                            <th>Waktu</th>
                            <th>Tingkat Kepentingan</th>
                        </tr>
                    </thead>
                </table>
            </div>
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
<script src="https://unpkg.com/alpinejs" defer></script>

<script>
    $(document).ready(function() {
        let dt = $("#consequenceTable").DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'consequence.name',
                    name: 'consequence.name'
                },
                {
                    data: 'player.name',
                    name: 'player.name'
                },
                {
                    data: 'size_of_consequence',
                    name: 'size_of_consequence'
                },
                {
                    data: 'timing_of_consequence',
                    name: 'timing_of_consequence'
                },
                {
                    data: 'player_id',
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
                                    <li><a @click="editPlayer" class="dropdown-item rounded-top" href="${row?.edit_link}"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a @click="deleteConsequences" class="dropdown-item rounded-top deleteProject" href="#" data-delete="${row?.delete_link}" ><i class="fa fa-trash"></i> Hapus</a></li>
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
                    targets: [0, 1, 2, 3, 4, 5]
                },

            ]
        });
    });

    function __initAlpine(){
        return{
            async deleteConsequences(e) {
                e.preventDefault();
                let deleteLink = e.currentTarget.getAttribute("data-delete");
                Swal.fire({
                    title: "Konfirmasi Hapus Konsekuensi",
                    text: "Apakah anda ingin menghapus konsekuensi ini? Tindakan tidak dapat diurungkan!",
                    icon: "question",
                    showCancelButton: true,
                    cancelButtonText: "Batalkan",
                    preConfirm: () => {
                        return axios.delete(`${deleteLink}&_token={{ csrf_token() }}`)
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
            }
        }
    }
</script>

@endpush