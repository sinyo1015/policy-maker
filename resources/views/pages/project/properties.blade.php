@extends("layouts.base")

@section("menu")
Proyek
@endsection

@section("breadcrumb")
{{$data?->name}} / Properti Proyek
@endsection

@section("title")
Properti Proyek
@endsection

@section("current_page")
Properti Proyek - {{$data?->name}}
@endsection

@section("contents")
<div x-data="__alpineInit()" x-init="getListProperties(); getQuestionnaires()">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card border-light shadow-sm components-section">
                <div class="card-header">
                    <h5 class="card-title">Jenis List Kategori</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="form-group">Pilih Jenis</label>
                                <select @change="changeLists" x-model="type" name="" id="" class="form-control">
                                    <option></option>
                                    <option value="{{\App\Constants\PropertyListType::CONSEQUENCES}}">Daftar konsekuensi</option>
                                    <option value="{{\App\Constants\PropertyListType::INTERESTS}}">Daftar kepentingan yang ditujukan</option>
                                    <option value="{{\App\Constants\PropertyListType::ON_AGENDAS}}">Daftar agenda yang ditujukan</option>
                                    <option value="{{\App\Constants\PropertyListType::SECTORS}}">Daftar sektor</option>
                                    <option value="{{\App\Constants\PropertyListType::LEVELS}}">Daftar Tingkatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <div class="row">
                                    <label for="" class="form-label">Daftar List</label>
                                </div>
                                <div class="py-2">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input placeholder="Nama Entri" x-model="input" type="text" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <button @click="insertEntry" style="margin-top: -1px;" class="btn btn-success"><i class="fa fa-add"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Daftar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(_display, i) of displayed">
                                                <tr>
                                                    <td x-text="_display.name"></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="card border-light shadow-sm components-section">
                <div class="card-header">
                    <h5 class="card-title">Skala</h5>
                </div>
                <div class="card-body">
                    <div class="py-2">Skala Kekuatan</div>
                    <table class="w-100 table table-bordered">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label for="">Rendah</label>
                                        <input @change="(e) => {changePreviousValue('pos_md', parseFloat(e.currentTarget.value) + 1.0)}" x-model="pos_pt" step="0.1" type="number" class="form-control">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="">Menengah</label>
                                        <div class="d-flex" style="column-gap: 10px;">
                                            <input x-model="pos_md" disabled type="number" name="" id="" class="form-control">
                                            <input x-model="pos_md_2" type="number" name="" id="" class="form-control">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <label for="">Tinggi</label>
                                        <input x-model="pos_pr" type="number" name="" id="" class="form-control">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pt-4">
                        <div class="py-2">Skala Posisi</div>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                <td style="background-color: #ff5858;">
                                        <label for="">Penolakan Tinggi</label>
                                        <div class="d-flex" style="column-gap: 10px;">
                                            <input step="0.1" @change="(e) => changePreviousValue('sp_pm_s', parseFloat(e.currentTarget.value) + 1.0)" x-model="sp_pt" type="number" name="" id="" class="form-control">
                                        </div>
                                    </td>

                                    <td style="background-color: #ff5858b5;">
                                        <label for="">Penolakan Medium</label>
                                        <div class="d-flex" style="column-gap: 10px;">
                                            <input step="0.1" x-model="sp_pm_s" disabled type="number" name="" id="" class="form-control">
                                            <input step="0.1" @change="(e) => changePreviousValue('sp_pr_s', parseFloat(e.currentTarget.value) + 1.0)" x-model="sp_pm" type="number" name="" id="" class="form-control">
                                        </div>
                                    </td>
                                    <td style="background-color: #ff585882;">
                                        <label for="">Penolakan Rendah</label>
                                        <div class="d-flex" style="column-gap: 10px;">
                                            <input step="0.1" x-model="sp_pr_s" disabled type="number" name="" id="" class="form-control">
                                            <input step="0.1" @change="(e) => changePreviousValue('sp_n_s', parseFloat(e.currentTarget.value) + 1.01)" x-model="sp_pr" type="number" name="" id="" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <label for="">Netral</label>
                                        <div class="d-flex" style="column-gap: 10px;">
                                            <input step="0.1" x-model="sp_n_s" disabled type="number" name="" id="" class="form-control">
                                            <input step="0.1" @change="(e) => changePreviousValue('sp_dr_s', parseFloat(e.currentTarget.value) + 0.01)" x-model="sp_n" type="number" name="" id="" class="form-control">
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                <td style="background-color: #1bff004d;">
                                        <label for="">Dukungan Rendah</label>
                                        <div class="d-flex" style="column-gap: 10px;">
                                            <input step="0.1" x-model="sp_dr_s" disabled type="number" name="" id="" class="form-control">
                                            <input step="0.1" @change="(e) => changePreviousValue('sp_dm_s', parseFloat(e.currentTarget.value) + 1.0)" x-model="sp_dr" type="number" name="" id="" class="form-control">
                                        </div>
                                    </td>
                                    <td style="background-color: #1bff007a">
                                        <label for="">Dukungan Medium</label>
                                        <div class="d-flex" style="column-gap: 10px;">
                                            <input step="0.1" x-model="sp_dm_s" disabled type="number" name="" id="" class="form-control">
                                            <input step="0.1" x-model="sp_dm" type="number" name="" id="" class="form-control">
                                        </div>
                                    </td>
                                    
                                    <td style="background-color: #1bff00;">
                                        <div class="form-group">
                                            <label for="">Sangat Mendukung</label>
                                            <input step="0.1" x-model="sp_sm" type="number" name="" id="" class="form-control">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <button x-bind:disabled="is_saving_scales" @click="updateScale" class="btn btn-success text-white"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-12 mb-3">
            <div class="card border-light shadow-sm components-section">
                <div class="card-header">
                    <h5 class="card-title">Kuisioner</h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button @click="() => {changeQuestionnaireType('{{\App\Constants\QuestionnaireType::POSITION_QUESTIONNAIRE}}')}" class="nav-link" id="position-tab" data-bs-toggle="tab" data-bs-target="#position" type="button" role="tab" aria-controls="position" aria-selected="true">Kuisioner Posisi</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button @click="() => {changeQuestionnaireType('{{\App\Constants\QuestionnaireType::POWER_QUESTIONNAIRE}}')}" class="nav-link" id="power-tab" data-bs-toggle="tab" data-bs-target="#power" type="button" role="tab" aria-controls="power" aria-selected="false">Kuisioner Kekuatan</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="position" role="tabpanel" aria-labelledby="position-tab">
                            <div class="table-responsive">
                                <table class="table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 80%">Kuisioner</th>
                                            <th>
                                                <button @click="addEntry" class="btn btn-success btn-sm text-white"><i class="fa fa-add"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(_questionnaire, i) of questionnaire_position">
                                            <tr>
                                                <td>
                                                    <template x-if="_questionnaire.id === null || _questionnaire.id === undefined">
                                                        <textarea x-model="_questionnaire.contents" id="" cols="30" rows="3" class="form-control"></textarea>
                                                    </template>
                                                    <template x-if="_questionnaire.id !== undefined">
                                                        <textarea x-bind:disabled="!_questionnaire.is_edit_mode" x-model="_questionnaire.questionnaire" id="" cols="30" rows="3" class="form-control"></textarea>
                                                    </template>
                                                </td>
                                                <td>
                                                    <template x-if="_questionnaire.id === null || _questionnaire.id === undefined">
                                                        <div class="d-flex" style="column-gap: 10px;">
                                                            <button @click="() => {saveQuestionnaire(i)}" class="btn btn-success text-white"> <i class="fa fa-check"></i> </button>
                                                            <button @click="deleteQuestionnaire('0', _questionnaire.uuid)" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </template>
                                                    <template x-if="_questionnaire.id !== undefined">
                                                        <div class="d-flex" style="column-gap: 10px;">
                                                            <button @click="() => {editContents(i)}" :class="_questionnaire.is_edit_mode ? 'd-none' : 'btn btn-secondary'"> <i class="fa fa-pencil"></i></button>
                                                            <template x-if="_questionnaire.is_edit_mode">
                                                                <button @click="() => {updatePublishedQuestionnaire(i)}" class="btn btn-success text-white"> <i class="fa fa-save"></i></button>
                                                            </template>
                                                            <button @click="() => {deletePubishedQuestionnaire(_questionnaire.id)}" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </template>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="power" role="tabpanel" aria-labelledby="power-tab">
                            <div class="table-responsive">
                                <table class="table table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 80%">Kuisioner</th>
                                            <th>
                                                <button @click="addEntry" class="btn btn-success btn-sm text-white"><i class="fa fa-add"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(_questionnaire, i) of questionnaire_power">
                                            <tr>
                                                <td>
                                                    <template x-if="_questionnaire.id === null || _questionnaire.id === undefined">
                                                        <textarea x-model="_questionnaire.contents" id="" cols="30" rows="3" class="form-control"></textarea>
                                                    </template>
                                                    <template x-if="_questionnaire.id !== undefined">
                                                        <textarea x-bind:disabled="!_questionnaire.is_edit_mode" x-model="_questionnaire.questionnaire" id="" cols="30" rows="3" class="form-control"></textarea>
                                                    </template>
                                                </td>
                                                <td>
                                                    <template x-if="_questionnaire.id === null || _questionnaire.id === undefined">
                                                        <div class="d-flex" style="column-gap: 10px;">
                                                            <button @click="() => {saveQuestionnaire(i)}" class="btn btn-success text-white"> <i class="fa fa-check"></i> </button>
                                                            <button @click="deleteQuestionnaire('1', _questionnaire.uuid)" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </template>
                                                    <template x-if="_questionnaire.id !== undefined">
                                                        <div class="d-flex" style="column-gap: 10px;">
                                                            <button @click="() => {editContents(i)}" :class="_questionnaire.is_edit_mode ? 'd-none' : 'btn btn-secondary'"> <i class="fa fa-pencil"></i></button>
                                                            <template x-if="_questionnaire.is_edit_mode">
                                                                <button @click="() => {updatePublishedQuestionnaire(i)}" class="btn btn-success text-white"> <i class="fa fa-save"></i></button>
                                                            </template>
                                                            <button @click="() => {deletePubishedQuestionnaire(_questionnaire.id)}" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                                                        </div>
                                                    </template>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection


@push("script")
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://unpkg.com/uuid@latest/dist/umd/uuidv4.min.js"></script>
<script>
    function __alpineInit() {
        return {

            is_saving_scales: false,

            sp_sm: 0.0,
            sp_dm: 0.0,
            sp_dm_s: 0.0,
            sp_dr: 0.0,
            sp_dr_s: 0.0,
            sp_n: 0.0,
            sp_n_s: 0.0,
            sp_pr: 0.0,
            sp_pr_s: 0.0,
            sp_pm: 0.0,
            sp_pm_s: 0.0,
            sp_pt: 0.0,

            pos_pt: 0.0,
            pos_md: 0.0,
            pos_md_2: 0.0,
            pos_pr: 0.0,

            consequences: [],
            interests: [],
            on_agendas: [],
            sectors: [],
            levels: [],
            displayed: [],
            type: "",
            input: "",

            questionnaire_position: [],
            questionnaire_power: [],

            questionnaire_type: "",

            changePreviousValue(target, value) {
                this[target] = parseFloat(value);
            },

            async getScales() {
                try{
                    let response = await axios.get(`{{route("project_detail.get_scales", $data->id)}}`);

                    let data = response?.data?.data;

                    this.sp_sm = data?.ps_sh,
                    this.sp_dm = data?.ps_smh,
                    this.sp_dm_s = data?.ps_sml,
                    this.sp_dr = data?.ps_slh,
                    this.sp_dr_s = data?.ps_sll,
                    this.sp_n = data?.ps_nl,
                    this.sp_n_s = data?.ps_nh,
                    this.sp_pr = data?.ps_dll,
                    this.sp_pr_s = data?.ps_dlh,
                    this.sp_pm = data?.ps_dml,
                    this.sp_pm_s = data?.ps_dmh,
                    this.sp_pt = data?.ps_dh,

                    this.pos_pt = data?.pw_l,
                    this.pos_md = data?.pw_ml,
                    this.pos_md_2 = data?.pw_mh,
                    this.pos_pr = data?.pw_h,

                    console.log(data);
                }
                catch(err){

                }
            },

            async updateScale() {
                this.is_saving_scales = true;
                try{
                    await axios.post(`{{route("project_detail.update_scales", $data->id)}}`, {
                        _token : "{{csrf_token()}}",
                        ps_dh: this.sp_pt, //Deny High
                        ps_dmh: this.sp_pm_s, //Deny Medium High
                        ps_dml: this.sp_pm, //Deny Medium Low
                        ps_dlh: this.sp_pr_s, //Deny Low High
                        ps_dll: this.sp_pr, //Deny Low Low
                        ps_nh: this.sp_n_s, //Neutral High 
                        ps_nl: this.sp_n, //Neutral Low
                        ps_sll: this.sp_dr_s, //Support Low Low
                        ps_slh: this.sp_dr, //Support Low High
                        ps_sml: this.sp_dm_s, //Support Medium Low
                        ps_smh: this.sp_dm, //Support Medium High
                        ps_sh: this.sp_sm, //Support High,

                        pw_l: this.pos_pt,
                        pw_ml: this.pos_md,
                        pw_mh: this.pos_md_2,
                        pw_h: this.pos_pr,
                    });

                    this.getScales();
                }
                catch(err){
                    if (err.response.data?.data?.errors?.length > 0) {
                        alert(err.response.data?.data?.errors[0]);
                    } else {
                        alert(err.response.data?.meta?.message);
                    }
                }
                finally{
                    this.is_saving_scales = false;
                }
            },

            async insertEntry() {
                try {
                    await axios.post("{{route('project_detail.insert_entry', $data->id)}}", {
                        name: this.input,
                        type: this.type
                    });
                    this.getListProperties();
                } catch (err) {
                    if (err.response.data?.data?.errors?.length > 0) {
                        alert(err.response.data?.data?.errors[0]);
                    } else {
                        alert(err.response.data?.meta?.message);
                    }
                }
                finally {
                    this.input = "";
                }
            },

            async getListProperties() {
                try {
                    let datas = await axios.get("{{route('project_detail.get_lists', $data->id)}}");
                    this.consequences = datas.data?.data?.consequences;
                    this.interests = datas.data?.data?.interests;
                    this.on_agendas = datas.data?.data?.agendas;
                    this.sectors = datas.data?.data?.sectors;
                    this.levels = datas.data?.data?.levels;

                    this.changeLists();
                    this.getScales();
                } catch (err) {

                }
            },

            changeLists() {
                switch (this.type) {
                    case '0':
                        this.displayed = this.consequences;
                        break;
                    case '1':
                        this.displayed = this.interests;
                        break;
                    case '2':
                        this.displayed = this.on_agendas;
                        break;
                    case '3':
                        this.displayed = this.sectors;
                        break;
                    case '4':
                        this.displayed = this.levels;
                        break;
                }
            },
            changeQuestionnaireType(type) {
                this.questionnaire_type = type;
            },
            addEntry() {
                switch (this.questionnaire_type) {
                    case '0':
                        this.questionnaire_position.push({
                            contents: "",
                            uuid: uuidv4()
                        });
                        break;

                    case '1':
                        this.questionnaire_power.push({
                            contents: "",
                            uuid: uuidv4()
                        });
                        break;
                }

            },
            deleteQuestionnaire(type, uuid) {
                switch (type) {
                    case '0':
                        this.questionnaire_position = this.questionnaire_position.filter((e, i) => e.uuid !== uuid);
                        break;

                    case '1':
                        this.questionnaire_power = this.questionnaire_power.filter((e, i) => e.uuid !== uuid);
                        break;
                }
            },
            deletePubishedQuestionnaire(id) {
                Swal.fire({
                    title: "Konfirmasi Hapus Kuisioner",
                    text: "Apakah anda ingin menghapus kuisioner ini? Tindakan tidak dapat diurungkan!",
                    icon: "question",
                    showCancelButton: true,
                    cancelButtonText: "Batalkan",
                    preConfirm: () => {
                        return axios.delete(`{{route("project_detail.delete_questionnaires", $data->id)}}?questionnaire_id=${id}&type=${this.questionnaire_type}&_token={{csrf_token()}}`)
                            .then(() => {
                                Swal.fire({
                                        title: "Sukses",
                                        text: "Berhasil menghapus data",
                                        toast: true,
                                        timer: 2000,
                                        icon: "success"
                                    })
                                    .then(() => {
                                        this.getQuestionnaires()
                                    })
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                    }
                });
            },
            editContents(idx) {
                switch (this.questionnaire_type) {
                    case '0':
                        this.questionnaire_position[idx].is_edit_mode = true;
                        break;

                    case '1':
                        this.questionnaire_power[idx].is_edit_mode = true;
                        break;
                }
            },
            async saveQuestionnaire(idx) {
                let contents = "";
                switch (this.questionnaire_type) {
                    case '0':
                        contents = this.questionnaire_position[idx].contents;
                        break;

                    case '1':
                        contents = this.questionnaire_power[idx].contents;
                        break;
                }

                try {
                    await axios.post("{{route('project_detail.insert_questionnaire', $data->id)}}", {
                        contents: contents,
                        type: this.questionnaire_type,
                        _token: "{{csrf_token()}}"
                    });
                    this.getQuestionnaires();
                } catch (err) {
                    if (err.response.data?.data?.errors?.length > 0) {
                        alert(err.response.data?.data?.errors[0]);
                    } else {
                        alert(err.response.data?.meta?.message);
                    }
                } finally {
                    this.input = "";
                }
            },
            async updatePublishedQuestionnaire(idx) {
                let contents = {};
                switch (this.questionnaire_type) {
                    case '0':
                        contents = this.questionnaire_position[idx];
                        this.questionnaire_position[idx].is_edit_mode = false;
                        break;

                    case '1':
                        contents = this.questionnaire_power[idx];
                        this.questionnaire_power[idx].is_edit_mode = false;
                        break;
                }

                try {
                    await axios.post("{{route('project_detail.update_questionnaire', $data->id)}}", {
                        questionnaire: contents.questionnaire,
                        type: this.questionnaire_type,
                        questionnaire_id: contents.id,
                        _token: "{{csrf_token()}}"
                    });
                    this.getQuestionnaires();
                } catch (err) {
                    if (err.response.data?.data?.errors?.length > 0) {
                        alert(err.response.data?.data?.errors[0]);
                    } else {
                        alert(err.response.data?.meta?.message);
                    }
                }
            },
            async getQuestionnaires() {
                try {
                    let datas = await axios.get("{{route('project_detail.get_questionnaires', $data->id)}}");
                    this.questionnaire_position = datas?.data?.data?.position_questionnaires;
                    this.questionnaire_power = datas?.data?.data?.power_questionnaires;
                } catch (err) {

                }
            }
        }
    }
</script>
@endpush