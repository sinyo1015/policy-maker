@extends("layouts.base")

@section("menu")
Kebijakan
@endsection

@section("breadcrumb")
Daftar Kebijakan
@endsection

@section("title")
Daftar Kebijakan
@endsection

@section("current_page")
Daftar Kebijakan
@endsection


@section("contents")
<div x-data="__alpineInit()">
    <div class="pb-4">
        <button data-bs-toggle="modal" data-bs-target="#modalTambah" class="btn btn-info">Tambah Tujuan</button>
    </div>
    <div class="card border-light shadow-sm components-section">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="policyTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tujuan</th>
                            <th>Prioritas</th>
                            <th>Agenda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambah" style="display: none;" aria-modal="true" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Tambah Tujuan</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                Berhasil menambahkan tujuan, anda sedang diarahkan ke daftar kebijakan
                            </div>
                        </template>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Definisikan Tujuan</label>
                                <textarea x-model="goal" name="" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Mekanisme</label>
                                <textarea x-model="mechanism" name="" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Indikator</label>
                                <textarea x-model="indicator" name="" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Komentar</label>
                                <textarea x-model="comments" name="" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Agenda Ditujukan Kepada</label>
                                <select x-model="agenda" name="" id="" class="form-control">
                                    <option selected>--Pilih Agenda yang Ditujukan---</option>
                                    <template x-for="(_agenda, i) of agendas">
                                        <option x-bind:value="_agenda.id" x-text="_agenda.name"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Prioritas</label>
                                <div class="row">
                                    <div class="col-3">
                                        <div style="height: 30px; width: 120px;" :style="{'background-color': priority_color}">

                                        </div>
                                        <small>Indikator Prioritas</small>
                                    </div>
                                    <div class="col-9">
                                        <select @change="(e) => priorityChange(e.currentTarget.value)" x-model="priority" name="" id="" class="form-control">
                                            <option selected>--Pilih Agenda yang Ditujukan---</option>
                                            <option value="{{\App\Constants\AgendaPriority::LOW}}">Rendah</option>
                                            <option value="{{\App\Constants\AgendaPriority::MODERATE}}">Menengah</option>
                                            <option value="{{\App\Constants\AgendaPriority::HIGH}}">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
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
                    <h2 class="h6 modal-title">Edit Tujuan</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                Berhasil mengubah tujuan, anda sedang diarahkan ke daftar kebijakan
                            </div>
                        </template>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Definisikan Tujuan</label>
                                <textarea x-model="goal_edit" name="" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Mekanisme</label>
                                <textarea x-model="mechanism_edit" name="" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Indikator</label>
                                <textarea x-model="indicator_edit" name="" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Komentar</label>
                                <textarea x-model="comments_edit" name="" id="" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Agenda Ditujukan Kepada</label>
                                <select x-model="agenda_edit" name="" id="" class="form-control">
                                    <template x-for="(_agenda, i) of agendas">
                                        <option x-bind:value="_agenda.id" x-text="_agenda.name"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Prioritas</label>
                                <div class="row">
                                    <div class="col-3">
                                        <div style="height: 30px; width: 120px" :style="{'background-color': priority_color_edit}">

                                        </div>
                                        <small>Indikator Prioritas</small>
                                    </div>
                                    <div class="col-9">
                                        <select x-model="priority_edit" @change="(e) => priorityChangeEdit(e.currentTarget.value)" name="" id="" class="form-control">
                                            <option selected>--Pilih Agenda yang Ditujukan---</option>
                                            <option value="{{\App\Constants\AgendaPriority::LOW}}">Rendah</option>
                                            <option value="{{\App\Constants\AgendaPriority::MODERATE}}">Menengah</option>
                                            <option value="{{\App\Constants\AgendaPriority::HIGH}}">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
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
                    <h2 class="h6 modal-title">Detail Tujuan</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Definisikan Tujuan</label>
                                <textarea disabled name="" id="goalDetail" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Mekanisme</label>
                                <textarea disabled name="" id="mechanismDetail" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Indikator</label>
                                <textarea disabled name="" id="indicatorDetail" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Komentar</label>
                                <textarea disabled name="" id="commentDetail" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Agenda Ditujukan Kepada</label>
                                <select disabled name="" id="agendaDetail" class="form-control">
                                    @foreach ($agendas as $agenda)
                                    <option value="{{$agenda->id}}">{{$agenda->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="" class="form-label">Prioritas</label>
                                <div class="row">
                                    <div class="col-3">
                                        <div style="height: 30px; width: 120px;" id="priorityColorDetail">

                                        </div>
                                        <small>Indikator Prioritas</small>
                                    </div>
                                    <div class="col-9">
                                        <select disabled name="" id="priorityDetail" class="form-control">
                                            <option selected>--Pilih Agenda yang Ditujukan---</option>
                                            <option value="{{\App\Constants\AgendaPriority::LOW}}">Rendah</option>
                                            <option value="{{\App\Constants\AgendaPriority::MODERATE}}">Menengah</option>
                                            <option value="{{\App\Constants\AgendaPriority::HIGH}}">Tinggi</option>
                                        </select>
                                    </div>
                                </div>
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
    const COLOR_HIGH = "#f00";
    const COLOR_MODERATE = "#f7ff00";
    const COLOR_LOW = "#00ff4c";


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
                    data: 'goal',
                    name: 'goal'
                },
                {
                    data: 'priority_msg',
                    name: 'priority_msg'
                },
                {
                    data: 'agenda_name',
                    name: 'agenda_name'
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
                    targets: [0, 1, 2, 3, 4]
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
            agendas: JSON.parse(`@json($agendas)`),
            goal: "",
            mechanism: "",
            indicator: "",
            agenda: "",
            priority: "",
            is_loading: false,
            is_error: false,
            is_success: false,
            errors: [],
            comments: "",
            priority_color: "#000000",

            goal_edit: "",
            mechanism_edit: "",
            indicator_edit: "",
            agenda_edit: "",
            priority_edit: "",
            is_loading_edit: false,
            is_error_edit: false,
            is_success_edit: false,
            errors_edit: [],
            comments_edit: "",
            policy_id_edit: "",
            priority_color_edit: "#000000",

            priorityChange(val) {
                switch (val) {
                    case "{{\App\Constants\AgendaPriority::LOW}}":
                        this.priority_color = COLOR_LOW;
                        break;
                    case "{{\App\Constants\AgendaPriority::MODERATE}}":
                        this.priority_color = COLOR_MODERATE;
                        break;

                    case "{{\App\Constants\AgendaPriority::HIGH}}":
                        this.priority_color = COLOR_HIGH;
                        break;
                }
            },

            priorityChangeEdit(val) {
                switch (val) {
                    case "{{\App\Constants\AgendaPriority::LOW}}":
                        this.priority_color_edit = COLOR_LOW;
                        break;
                    case "{{\App\Constants\AgendaPriority::MODERATE}}":
                        this.priority_color_edit = COLOR_MODERATE;
                        break;

                    case "{{\App\Constants\AgendaPriority::HIGH}}":
                        this.priority_color_edit = COLOR_HIGH;
                        break;
                }
            },

            detailPolicy(e) {
                let detail = e.currentTarget.getAttribute("data-detail");
                let subDetail = JSON.parse(detail);
                $("#goalDetail").html(subDetail?.goal);
                $("#mechanismDetail").html(subDetail?.mechanism);
                $("#indicatorDetail").html(subDetail?.indicator);
                $("#commentDetail").html(subDetail?.comments);
                $("#agendaDetail").val(subDetail?.agenda_id).change();
                $("#priorityDetail").val(subDetail?.priority).change();
                switch (subDetail?.priority?.toString()) {
                    case "{{\App\Constants\AgendaPriority::LOW}}":
                        $("#priorityColorDetail").css("background-color", COLOR_LOW);
                        break;
                    case "{{\App\Constants\AgendaPriority::MODERATE}}":
                        $("#priorityColorDetail").css("background-color", COLOR_MODERATE);
                        break;

                    case "{{\App\Constants\AgendaPriority::HIGH}}":
                        $("#priorityColorDetail").css("background-color", COLOR_HIGH);
                        break;
                }

                detailModal.show();
            },

            editPolicy(e) {
                let detail = e.currentTarget.getAttribute("data-detail");
                let subDetail = JSON.parse(detail);

                this.goal_edit = subDetail?.goal;
                this.mechanism_edit = subDetail?.mechanism;
                this.indicator_edit = subDetail?.indicator;
                this.agenda_edit = subDetail?.agenda_id;
                this.priority_edit = subDetail?.priority;
                this.comments_edit = subDetail?.comments;
                this.policy_id_edit = subDetail?.id;

                switch (subDetail?.priority?.toString()) {
                    case "{{\App\Constants\AgendaPriority::LOW}}":
                        this.priority_color_edit = COLOR_LOW;
                        break;
                    case "{{\App\Constants\AgendaPriority::MODERATE}}":
                        this.priority_color_edit = COLOR_MODERATE;
                        break;

                    case "{{\App\Constants\AgendaPriority::HIGH}}":
                        this.priority_color_edit = COLOR_HIGH;
                        break;
                }

                editModal.show();
            },

            async sendData() {
                this.is_loading = true;
                this.is_success = false;
                this.is_error = false;
                this.errors = [];
                try {
                    await axios.post("{{route('project_policies.create', $project_id)}}", {
                        _token: "{{csrf_token()}}",
                        goal: this.goal,
                        mechanism: this.mechanism,
                        indicator: this.indicator,
                        agenda_id: this.agenda,
                        priority: this.priority,
                        comments: this.comments,
                        project_id: "{{$project_id}}",
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
                            document.location.href = "{{route('project_policies.index', $project_id)}}";
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
                    await axios.post("{{route('project_policies.update', $project_id)}}", {
                        _token: "{{csrf_token()}}",
                        goal: this.goal_edit,
                        mechanism: this.mechanism_edit,
                        indicator: this.indicator_edit,
                        agenda_id: this.agenda_edit,
                        priority: this.priority_edit,
                        comments: this.comments_edit,
                        policy_id: this.policy_id_edit,
                        project_id: "{{$project_id}}"
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
                            document.location.href = "{{route('project_policies.index', $project_id)}}";
                        }, 1500);
                    }
                }
            },
            async deletePolicy(e) {
                e.preventDefault();
                let deleteLink = e.currentTarget.getAttribute("data-delete");
                Swal.fire({
                    title: "Konfirmasi Hapus Tujuan",
                    text: "Apakah anda ingin menghapus tujuan ini? Tindakan tidak dapat diurungkan!",
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