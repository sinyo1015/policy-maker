@extends("layouts.base")

@section("menu")
Proyek
@endsection

@section("current_page")
Buat Proyek
@endsection


@section("contents")
<div x-data="_alpineInit()">
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
                Berhasil menambahkan proyek, anda sedang diarahkan ke daftar project
            </div>
        </template>
    </div>
    <div class="card border-light shadow-sm components-section">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Nama Proyek <small style="color: red">*</small></label>
                        <input x-model="project_name" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Nama Analis</label>
                        <input x-model="analyst_name" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Keterangan Proyek</label>
                        <textarea x-model="project_desc" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Nama Klien</label>
                        <input x-model="client_name" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Tanggal Kebijakan</label>
                        <input x-model="policy_date" type="text" class="form-control" id="policyDate">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Tanggal Analisis</label>
                        <input x-model="analisis_date" type="text" class="form-control" id="analysisDate">
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <label for="">Implementation Period Labels</label>
                <div class="row">
                    <template x-for="(_impl, i) of implementation_periods_labels">
                        <div class="col-md-12">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <input x-model="_impl.name" type="text" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex">
                                        <template x-if="i != 0" class="ml-4">
                                            <button @click="deleteImplementationLabel(_impl.uuid)" class="btn btn-danger">Hapus</button>
                                        </template>
                                        <template x-if="i == 0" class="ml-4">
                                            <button @click="addImplementationLabel" class="btn btn-success text-white"><i class="fa fa-add"></i> Tambah</button>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button x-bind:disabled="is_loading" @click="sendData" class="btn btn-success text-white"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>
</div>
@endsection


@push("script")
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://unpkg.com/uuid@latest/dist/umd/uuidv4.min.js"></script>
<script>
    let policyDateEl = document.querySelector("#policyDate");
    let analysisDateEl = document.querySelector("#analysisDate");

    const policyDate = new Datepicker(policyDateEl, {
        format : "yyyy-mm-dd"
    });
    const analysisDate = new Datepicker(analysisDateEl, {
        format : "yyyy-mm-dd"
    });

    function _alpineInit() {
        return {
            project_name: "",
            analyst_name: "",
            project_desc: "",
            client_name: "",
            policy_date: "",
            analisis_date: "",
            implementation_periods_labels: [{
                name: "",
                uuid: -1
            }],
            is_error: false,
            is_success: false,
            is_loading: false,
            errors: [],

            addImplementationLabel() {
                this.implementation_periods_labels.push({
                    name: "",
                    uuid: uuidv4()
                });
            },

            deleteImplementationLabel(uuid) {
                this.implementation_periods_labels = this.implementation_periods_labels.filter((e, i) => {
                    return e.uuid !== uuid
                });
            },

            async sendData() {
                this.is_error = false;
                this.is_success = false;
                this.is_loading = true;
                this.errors = [];
                try {
                    let response = await axios.post("{{route('project.create_action')}}", {
                        "_token": "{{csrf_token()}}",
                        project_name: this.project_name,
                        analyst_name: this.analyst_name,
                        description: this.project_desc,
                        client_name: this.client_name,
                        policy_date: policyDate.getDate("yyyy-mm-dd"),
                        analysis_date: analysisDate.getDate("yyyy-mm-dd"),
                        implementation_periods_labels: this.implementation_periods_labels
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
                    if(!this.is_error){
                        setTimeout(() => {
                            document.location.href = "{{route('project.index')}}";
                        }, 1500);
                    }
                }
            }
        }


    }
</script>
@endpush