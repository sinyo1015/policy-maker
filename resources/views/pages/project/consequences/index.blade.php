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
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetail" style="display: none;" aria-modal="true" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Detail Konsekuensi</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Deskripsi Konsekuensi</label>
                                <textarea :value="desc_detail" disabled name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Dampak Konsekuensi</label>
                                <textarea :value="impact_detail" disabled name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Timing Konsekuensi</label>
                                <textarea :value="timing_detail" disabled name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Konsekuensi ditujukan kepada</label>
                                <input :value="player_detail" disabled type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Jenis Konsekuensi</label>
                                <input :value="consequence_detail" disabled type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Tingkat Kepentingan</label>
                                <input :value="importance_detail" disabled type="text" class="form-control">
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
                                    <li><a @click="detailConsequence" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-eye"></i> Detail</a></li>
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

    let detailModal = new bootstrap.Modal(document.getElementById('modalDetail'), {
        keyboard: false
    });

    function __initAlpine(){
        return{

            desc_detail: "",
            impact_detail: "",
            timing_detail: "",
            player_detail: "",
            consequence_detail: "",
            importance_detail: "",
            
            detailConsequence(e) {
                let details = e.currentTarget.getAttribute("data-detail");
                let detail = JSON.parse(details);

                this.desc_detail = detail?.description;
                this.impact_detail = detail?.size_of_consequence;
                this.timing_detail = detail?.timing_of_consequence;
                this.player_detail = detail?.player?.name;
                this.consequence_detail = detail?.consequence?.name;
                this.importance_detail = detail?.importance;

                detailModal.show();
            },

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