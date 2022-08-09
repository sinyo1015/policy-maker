@extends("layouts.base")

@section("menu")
Strategi
@endsection

@section("breadcrumb")
Daftar Strategi
@endsection

@section("title")
Daftar Strategi
@endsection

@section("current_page")
Daftar Strategi
@endsection

@section("contents")
<div x-data="__initAlpine()">
    <div class="pb-4">
        <a href="{{route('project_predefined_strategy.create', $id)}}" class="btn btn-info">Tambah Strategi</a>
    </div>
    <div class="py-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="strategyTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pihak</th>
                                <th>Strategi dan Aksi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetail" style="display: none;" aria-modal="true" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Detail Strategi</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Pihak</label>
                                <input :value="player" disabled type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Posisi pihak</label>
                                <input :value="position" disabled type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Kesempatan yang disampaikan oleh pihak</label>
                                <textarea :value="chances" disabled name="" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Rintangan yang disampaikan oleh pihak</label>
                                <textarea :value="obstacles" disabled name="" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Strategi yang dipilih</label>
                                <textarea :value="selected_strategies" disabled name="" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Definisi aksi yang akan dilakukan dengan strategi yang dipilih</label>
                                <textarea :value="strategy_actions" disabled name="" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Analisa terhadap tantangan terhadap aksi yang dimasukkan</label>
                                <textarea :value="challanges" disabled name="" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Analisa terhadap timeline terhadap aksi yang dimasukkan</label>
                                <textarea :value="timelines" disabled name="" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Persentase akan keberhasilan strategi ini</label>
                                <input :value="percentage" disabled type="text" class="form-control">
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
        let dt = $("#strategyTable").DataTable({
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
                    data: 'player.name',
                    name: 'player.name'
                },
                {
                    data: 'strategy_action',
                    name: 'strategy_action'
                },
                {
                    data: 'sub_policy_id',
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
                                    <li><a @click="detailStrategy" class="dropdown-item rounded-top" href="${row?.detail_link}"><i class="fa fa-eye"></i> Detail</a></li>
                                    <li><a @click="editStrategy" class="dropdown-item rounded-top" href="${row?.edit_link}"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a @click="deleteStrategy" class="dropdown-item rounded-top deleteProject" href="#" data-delete="${row?.delete_link}" ><i class="fa fa-trash"></i> Hapus</a></li>
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
                    targets: [0, 1, 2, 3]
                },
                {
                    "max-width": "10%",
                    "word-break": "break-word",
                    "targets": 2
                }

            ]
        });
    });

    let detailModal = new bootstrap.Modal(document.getElementById('modalDetail'), {
        keyboard: false
    });

    function __initAlpine() {
        return {

            player : "",
            position: "",
            chances: "",
            obstacles: "",
            selected_strategies: "",
            strategy_actions: "",
            challanges: "",
            timelines: "",
            percentage: "",


            async detailStrategy(e) {
                e.preventDefault();
                let detailLink = e.currentTarget.getAttribute("href");
                axios.get(detailLink)
                    .then((res) => {

                        let data = res?.data?.data;
                        this.player  =  data?.player?.name;
                        this.position =  data?.position_label;
                        this.chances = ""; 
                        this.obstacles = "";
                        for(const oops of data?.player?.oops){
                            this.chances +=  oops?.opportunity + ";\n";
                            this.obstacles +=  oops?.obstacle + ";\n";
                        }
                        this.selected_strategies =  data?.strategy?.text;
                        this.strategy_actions =  data?.strategy_action;
                        this.challanges =  data?.challanges;
                        this.timelines =  data?.timelines;
                        this.percentage =  data?.probability;

                        detailModal.show();
                    })
                    .catch((err) => {

                    });
            },

            async deleteStrategy(e) {
                e.preventDefault();
                let deleteLink = e.currentTarget.getAttribute("data-delete");
                Swal.fire({
                    title: "Konfirmasi Hapus Strategi",
                    text: "Apakah anda ingin menghapus strategi ini? Tindakan tidak dapat diurungkan!",
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