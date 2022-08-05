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
<div x-data="__alpineInit()">
    <div class="pb-4">
        <button data-bs-toggle="modal" data-bs-target="#modalTambah" class="btn btn-info">Tambah Strategi</button>
    </div>

    <div class="py-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h5 class="card-title">Strategi Kekuatan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped w-100" id="powerStrategy">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Label</th>
                                <th>Isi Strategi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h5 class="card-title">Strategi Posisi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped w-100" id="positionStrategy">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Label</th>
                                <th>Isi Strategi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h5 class="card-title">Strategi Pihak</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped w-100" id="playerStrategy">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Label</th>
                                <th>Isi Strategi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h5 class="card-title">Strategi Persepsi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped w-100" id="perceptionStrategy">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Label</th>
                                <th>Isi Strategi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah" style="display: none;" aria-modal="true" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Tambah Strategi</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="py-1">
                        <template x-if="is_error">
                            <div class="alert alert-danger">
                                Terjadi Kesalahan: <br>
                                <ul>
                                    <template x-for="(_err, i) of errors">
                                        <li x-text="_err"></li>
                                    </template>
                                </ul>
                            </div>
                        </template>
                        <template x-if="is_success">
                            <div class="alert alert-success">
                                Berhasil menambahkan strategi, anda sedang diarahkan ke daftar strategi
                            </div>
                        </template>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Jenis Strategi</label>
                                <select x-model="strategy_type" name="" id="" class="form-control">
                                    <option selected></option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::POWER}}">Kekuatan</option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::POSITION}}">Posisi</option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::PLAYER}}">Pihak</option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::PERCEPTION}}">Persepsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Jenis Dukungan Strategi</label>
                                <select x-model="support_type" name="" id="" class="form-control">
                                    <option selected></option>
                                    <option value="{{\App\Constants\Strategies\StrategyType::SUPPORT}}">Mendukung</option>
                                    <option value="{{\App\Constants\Strategies\StrategyType::NON_MOBILIZED}}">Netral</option>
                                    <option value="{{\App\Constants\Strategies\StrategyType::OPPOSITION}}">Oposisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Label Strategi</label>
                                <input x-model="label" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Isi Strategi</label>
                                <textarea x-model="contents" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button x-bind:disabled="is_loading" @click="sendData" type="button" class="btn btn-success text-white">Simpan</button>
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit" style="display: none;" aria-modal="true" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Edit Strategi</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="py-1">
                        <template x-if="is_error_edit">
                            <div class="alert alert-danger">
                                Terjadi Kesalahan: <br>
                                <ul>
                                    <template x-for="(_err, i) of errors_edit">
                                        <li x-text="_err"></li>
                                    </template>
                                </ul>
                            </div>
                        </template>
                        <template x-if="is_success_edit">
                            <div class="alert alert-success">
                                Berhasil mengubah strategi, anda sedang diarahkan ke daftar strategi
                            </div>
                        </template>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Jenis Strategi</label>
                                <select x-model="strategy_type_edit" name="" id="" class="form-control">
                                    <option selected></option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::POWER}}">Kekuatan</option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::POSITION}}">Posisi</option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::PLAYER}}">Pihak</option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::PERCEPTION}}">Persepsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Jenis Dukungan Strategi</label>
                                <select x-model="support_type_edit" name="" id="" class="form-control">
                                    <option selected></option>
                                    <option value="{{\App\Constants\Strategies\StrategyType::SUPPORT}}">Mendukung</option>
                                    <option value="{{\App\Constants\Strategies\StrategyType::NON_MOBILIZED}}">Netral</option>
                                    <option value="{{\App\Constants\Strategies\StrategyType::OPPOSITION}}">Oposisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Label Strategi</label>
                                <input x-model="label_edit" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Isi Strategi</label>
                                <textarea x-model="contents_edit" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button x-bind:disabled="is_loading_edit" @click="sendDataEdit" type="button" class="btn btn-success text-white">Simpan</button>
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
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
                                <label for="">Jenis Strategi</label>
                                <select disabled name="" id="strategyTypeDetail" class="form-control">
                                    <option selected></option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::POWER}}">Kekuatan</option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::POSITION}}">Posisi</option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::PLAYER}}">Pihak</option>
                                    <option value="{{\App\Constants\Strategies\StrategyCategory::PERCEPTION}}">Persepsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Jenis Dukungan Strategi</label>
                                <select disabled name="" id="supportTypeDetail" class="form-control">
                                    <option selected></option>
                                    <option value="{{\App\Constants\Strategies\StrategyType::SUPPORT}}">Mendukung</option>
                                    <option value="{{\App\Constants\Strategies\StrategyType::NON_MOBILIZED}}">Netral</option>
                                    <option value="{{\App\Constants\Strategies\StrategyType::OPPOSITION}}">Oposisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Label Strategi</label>
                                <input disabled id="strategyLabelType" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Isi Strategi</label>
                                <textarea disabled name="" id="strategyContentType" cols="30" rows="3" class="form-control"></textarea>
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
        let dt = $("#powerStrategy").DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}?category={{App\Constants\Strategies\StrategyCategory::POWER}}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'label',
                    name: 'label'
                },
                {
                    data: 'text',
                    name: 'text'
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
                                    <li><a @click="detailPolicy" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-eye"></i> Detail</a></li>
                                    <li><a @click="editPolicy" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a @click="deletePolicy" class="dropdown-item rounded-top deleteProject" href="#" data-delete="${row?.delete_link}" ><i class="fa fa-trash"></i> Hapus</a></li>
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

            ]
        });
        let dt2 = $("#positionStrategy").DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}?category={{App\Constants\Strategies\StrategyCategory::POSITION}}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'label',
                    name: 'label'
                },
                {
                    data: 'text',
                    name: 'text'
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
                                    <li><a @click="detailPolicy" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-eye"></i> Detail</a></li>
                                    <li><a @click="editPolicy" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a @click="deletePolicy" class="dropdown-item rounded-top deleteProject" href="#" data-delete="${row?.delete_link}" ><i class="fa fa-trash"></i> Hapus</a></li>
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

            ]
        });
        let dt3 = $("#playerStrategy").DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}?category={{App\Constants\Strategies\StrategyCategory::PLAYER}}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'label',
                    name: 'label'
                },
                {
                    data: 'text',
                    name: 'text'
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
                                    <li><a @click="detailPolicy" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-eye"></i> Detail</a></li>
                                    <li><a @click="editPolicy" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a @click="deletePolicy" class="dropdown-item rounded-top deleteProject" href="#" data-delete="${row?.delete_link}" ><i class="fa fa-trash"></i> Hapus</a></li>
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

            ]
        });
        let dt4 = $("#perceptionStrategy").DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}?category={{App\Constants\Strategies\StrategyCategory::PERCEPTION}}',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'label',
                    name: 'label'
                },
                {
                    data: 'text',
                    name: 'text'
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
                                    <li><a @click="detailPolicy" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-eye"></i> Detail</a></li>
                                    <li><a @click="editPolicy" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a @click="deletePolicy" class="dropdown-item rounded-top deleteProject" href="#" data-delete="${row?.delete_link}" ><i class="fa fa-trash"></i> Hapus</a></li>
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

            ]
        });
    });

    let editModal = new bootstrap.Modal(document.getElementById('modalEdit'), {
        keyboard: false
    });
    let detailModal = new bootstrap.Modal(document.getElementById('modalDetail'), {
        keyboard: false
    });


    function __alpineInit() {
        return {
            contents: "",
            label: "",
            strategy_type: "",
            support_type: "",

            contents_edit: "",
            label_edit: "",
            strategy_type_edit: "",
            support_type_edit: "",
            strategy_id_edit: "",

            is_loading: false,
            is_error: false,
            is_success: false,
            errors: [],

            is_loading_edit: false,
            is_error_edit: false,
            is_success_edit: false,
            errors_edit: [],


            detailPolicy(e) {
                let detail = e.currentTarget.getAttribute("data-detail");
                let subDetail = JSON.parse(detail);
                $("#strategyLabelType").val(subDetail?.label);
                $("#strategyContentType").html(subDetail?.text);
                $("#strategyTypeDetail").val(subDetail?.category).change();
                $("#supportTypeDetail").val(subDetail?.type).change();

                detailModal.show();
            },

            editPolicy(e) {
                let detail = e.currentTarget.getAttribute("data-detail");
                let subDetail = JSON.parse(detail);

                this.contents_edit = subDetail?.text;
                this.label_edit = subDetail?.label;
                this.strategy_type_edit = subDetail?.category;
                this.support_type_edit = subDetail?.type;
                this.strategy_id_edit = subDetail?.id;
                
                editModal.show();
            },

            async sendData() {
                this.is_loading = true;
                this.is_success = false;
                this.is_error = false;
                this.errors = [];
                try {
                    await axios.post("{{route('project_strategies.create_action', $id)}}", {
                        _token: "{{csrf_token()}}",
                        strategy_type: this.strategy_type,
                        support_type: this.support_type,
                        label: this.label,
                        contents: this.contents
                    });

                    this.is_success = true;
                } catch (err) {
                    if (err.response.data?.data?.errors?.length > 0) {
                        this.errors = err.response.data?.data?.errors;
                    } else {
                        this.errors.push(err.response.data?.meta?.message);
                    }
                    this.is_error = true;
                } finally {
                    this.is_loading = false;
                    window.scrollTo(0, 0);
                    if (!this.is_error) {
                        setTimeout(() => {
                            document.location.href = "{{route('project_strategies.index', $id)}}";
                        }, 1500);
                    }
                }
            },
            async sendDataEdit() {
                this.is_loading_edit = true;
                this.is_success_edit = false;
                this.is_error_edit = false;
                this.errors_edit = [];
                try {
                    await axios.post("{{route('project_strategies.edit_action', $id)}}", {
                        _token: "{{csrf_token()}}",
                        strategy_type: this.strategy_type_edit,
                        support_type: this.support_type_edit,
                        label: this.label_edit,
                        contents: this.contents_edit,
                        strategy_id: this.strategy_id_edit,
                    });

                    this.is_success_edit = true;
                } catch (err) {
                    if (err.response.data?.data?.errors?.length > 0) {
                        this.errors_edit = err.response.data?.data?.errors;
                    } else {
                        this.errors_edit.push(err.response.data?.meta?.message);
                    }
                    this.is_error_edit = true;
                } finally {
                    this.is_loading_edit = false;
                    window.scrollTo(0, 0);
                    if (!this.is_error_edit) {
                        setTimeout(() => {
                            document.location.href = "{{route('project_strategies.index', $id)}}";
                        }, 1500);
                    }
                }
            },
            async deletePolicy(e) {
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