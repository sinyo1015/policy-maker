@extends("layouts.base")


@section("menu")
Pihak-Pihak
@endsection

@section("breadcrumb")
Daftar Pihak
@endsection

@section("title")
Daftar Pihak
@endsection

@section("current_page")
Daftar Pihak
@endsection


@section("contents")
<div x-data="__alpineInit()">
    <div class="pb-4">
        <a href="{{route('project_player.create', request()->segment(2))}}" class="btn btn-info">Tambah Pihak</a>
    </div>

    <div class="card border-light shadow-sm components-section">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="policyTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pihak</th>
                            <th>Level</th>
                            <th>Sektor</th>
                            <th>Posisi</th>
                            <th>Power</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetail" style="display: none;" aria-modal="true" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Detail Pihak</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Nama Pihak</label>
                                <input :value="name_det" disabled type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Inisial</label>
                                <input :value="abbrv_det" disabled type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Informasi tambahan mengenai pihak ini</label>
                                <textarea :value="infos_det" disabled name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Sektor</label>
                                <input :value="sector_det" disabled type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Level</label>
                                <input :value="level_det" disabled type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Posisi Pihak</label>
                                <input :value="position_det" disabled type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Kekuatan Pihak</label>
                                <input :value="power_det" disabled type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                </div>
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
        let dt = $("#policyTable").DataTable({
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'level.name',
                    name: 'level.name'
                },
                {
                    data: 'sector.name',
                    name: 'sector.name'
                },
                {
                    data: 'position_label',
                    name: 'position_label'
                },
                {
                    data: 'power_label',
                    name: 'power_label'
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
                                    <li><a @click="detailPlayer" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-eye"></i> Detail</a></li>
                                    <li><a @click="editPlayer" class="dropdown-item rounded-top" href="${row?.edit_link}"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a @click="deletePlayer" class="dropdown-item rounded-top deleteProject" href="#" data-delete="${row?.delete_link}" ><i class="fa fa-trash"></i> Hapus</a></li>
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

    let detailModal = new bootstrap.Modal(document.getElementById('modalDetail'), {
        keyboard: false
    });

    function __alpineInit(){
        return{

            name_det: "",
            abbrv_det: "",
            infos_det: "",
            sector_det: "",
            level_det: "",
            position_det: "",
            power_det: "",


            detailPlayer(e){
                let details = e.currentTarget.getAttribute("data-detail");
                let detail = JSON.parse(details);
                this.name_det = detail?.name;
                this.abbrv_det = detail?.alt_name;
                this.infos_det = detail?.details;
                this.sector_det = detail?.sector?.name;
                this.level_det = detail?.level?.name;
                this.position_det = detail?.position_label;
                this.power_det = detail?.power_label;
                detailModal.show();
            },

            async deletePlayer(e) {
                e.preventDefault();
                let deleteLink = e.currentTarget.getAttribute("data-delete");
                Swal.fire({
                    title: "Konfirmasi Hapus Pihak",
                    text: "Apakah anda ingin menghapus pihak ini? Tindakan tidak dapat diurungkan!",
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