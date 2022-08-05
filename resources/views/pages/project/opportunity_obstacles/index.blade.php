@extends("layouts.base")

@section("menu")
Strategi
@endsection

@section("breadcrumb")
Daftar Kesempatan dan Rintangan
@endsection

@section("title")
Daftar Kesempatan dan Rintangan
@endsection

@section("current_page")
Daftar Kesempatan dan Rintangan
@endsection

@section("contents")
<div x-data="__alpineInit()">
    <div class="pb-4">
        <button data-bs-toggle="modal" data-bs-target="#modalTambah" class="btn btn-info">Tambah Entri</button>
    </div>

    <div class="card border-light shadow-sm components-section">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100" id="tabelOps">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pihak</th>
                            <th>Kesempatan</th>
                            <th>Rintangan</th>
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
                    <h2 class="h6 modal-title">Tambah Entri</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                Berhasil menambahkan entri, anda sedang diarahkan ke daftar entri
                            </div>
                        </template>
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="">Pihak</label>
                            <select x-model="player_id" name="" id="" class="form-control">
                                <option selected>--Pilih Pihak--</option>
                                <template x-for="(_player, i) of players">
                                    <option :value="_player.id" x-text="_player.name"></option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Kesempatan</label>
                                <textarea x-model="opportunity" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Rintangan</label>
                                <textarea x-model="obstacle" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Komentar</label>
                                <textarea x-model="comments" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input x-model="need_more_investivigation" type="checkbox" name="" id="">
                                <label for="">Butuh penyelidikan lebih lanjut?</label>
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
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetail" style="display: none;" aria-modal="true" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Detail Entri</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="">Pihak</label>
                            <select disabled name="" id="playerDetail" class="form-control">
                                <template x-for="(_player, i) of players">
                                    <option :value="_player.id" x-text="_player.name"></option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Kesempatan</label>
                                <textarea disabled name="" id="opportunityDetail" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Rintangan</label>
                                <textarea disabled name="" id="obstacleDetail" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Komentar</label>
                                <textarea disabled name="" id="commentDetail" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input disabled type="checkbox" name="" id="needMoreInvestivigationDetail">
                                <label for="">Butuh penyelidikan lebih lanjut?</label>
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
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEdit" style="display: none;" aria-modal="true" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">Edit Entri</h2><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                Berhasil mengubah entri, anda sedang diarahkan ke daftar entri
                            </div>
                        </template>
                    </div>
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="">Pihak</label>
                            <select name="" class="form-control" x-model="player_id_edit">
                                <template x-for="(_player, i) of players">
                                    <option :value="_player.id" x-text="_player.name"></option>
                                </template>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Kesempatan</label>
                                <textarea x-model="opportunity_edit" name="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Rintangan</label>
                                <textarea x-model="obstacle_edit" name="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Komentar</label>
                                <textarea x-model="comments_edit" name="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input x-model="need_more_investivigation_edit" type="checkbox" name="">
                                <label for="">Butuh penyelidikan lebih lanjut?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="sendDataEdit" type="button" class="btn btn-success text-white"><i class="fa fa-save"></i> Simpan</button>
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
        let dt = $("#tabelOps").DataTable({
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
                    data: 'opportunity',
                    name: 'opportunity'
                },
                {
                    data: 'comments',
                    name: 'comments'
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
                                    <li><a @click="detailOps" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-eye"></i> Detail</a></li>
                                    <li><a @click="editOps" class="dropdown-item rounded-top" data-detail='${JSON.stringify(row)}' href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a @click="deleteOps" class="dropdown-item rounded-top deleteProject" href="#" data-delete="${row?.delete_link}" ><i class="fa fa-trash"></i> Hapus</a></li>
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
            player_id: "",
            opportunity: "",
            obstacle: "",
            comments: "",
            need_more_investivigation: false,

            id_ops: "",
            player_id_edit: "",
            opportunity_edit: "",
            obstacle_edit: "",
            comments_edit: "",
            need_more_investivigation_edit: false,

            is_loading: false,
            is_success: false,
            is_error: false,
            errors: [],
            is_loading_edit: false,
            is_success_edit: false,
            is_error_edit: false,
            errors_edit: [],


            players: JSON.parse(`@json($players)`),

            async sendData() {
                this.is_loading = true;
                this.is_success = false;
                this.is_error = false;
                this.errors = [];
                try {
                    await axios.post("{{route('project_opp_obs.create', $id)}}", {
                        _token: "{{csrf_token()}}",
                        player_id: this.player_id,
                        opportunity: this.opportunity,
                        obstacle: this.obstacle,
                        comments: this.comments,
                        need_more_investivigation: this.need_more_investivigation,
                        project_id: "{{$id}}",
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
                            document.location.href = "{{route('project_opp_obs.index', $id)}}";
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
                    await axios.post("{{route('project_opp_obs.edit_action', $id)}}", {
                        _token: "{{csrf_token()}}",
                        ops_id: this.id_ops,
                        player_id: this.player_id_edit,
                        opportunity: this.opportunity_edit,
                        obstacle: this.obstacle_edit,
                        comments: this.comments_edit,
                        need_more_investivigation: this.need_more_investivigation_edit
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
                            document.location.href = "{{route('project_opp_obs.index', $id)}}";
                        }, 1500);
                    }
                }
            },
            async deleteOps(e) {
                e.preventDefault();
                let deleteLink = e.currentTarget.getAttribute("data-delete");
                Swal.fire({
                    title: "Konfirmasi Hapus Entri",
                    text: "Apakah anda ingin menghapus entri ini? Tindakan tidak dapat diurungkan!",
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
            },
            detailOps(e) {
                let detail = e.currentTarget.getAttribute("data-detail");
                let subDetail = JSON.parse(detail);
                $("#playerDetail").val(subDetail?.player?.id).change();
                $("#opportunityDetail").val(subDetail?.opportunity);
                $("#obstacleDetail").val(subDetail?.obstacle);
                $("#commentDetail").val(subDetail?.comments);
                $("#needMoreInvestivigationDetail").prop("checked", subDetail?.is_more_research_needed === 1);

                detailModal.show();
            },

            editOps(e) {
                let detail = e.currentTarget.getAttribute("data-detail");
                let subDetail = JSON.parse(detail);

                this.id_ops = subDetail?.id;
                this.player_id_edit = subDetail?.player?.id;
                this.opportunity_edit = subDetail?.opportunity;
                this.obstacle_edit = subDetail?.obstacle;
                this.comments_edit = subDetail?.comments;
                this.need_more_investivigation_edit = subDetail?.is_more_research_needed;

                editModal.show();
            }
        }
    }
</script>

@endpush