@extends("layouts.base")


@section("menu")
Pihak-Pihak
@endsection

@section("breadcrumb")
Edit Pihak
@endsection

@section("title")
Edit Pihak
@endsection

@section("current_page")
Edit Pihak
@endsection

@section("contents")
<div x-data="__initAlpine()">
    <div class="card border-light shadow-sm components-section">
        <div class="card-body">
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
                        Berhasil mengubah pihak, anda sedang diarahkan ke daftar pihak
                    </div>
                </template>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="" class="form-label">Nama Pihak</label>
                        <input x-model="player_name" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="" class="form-label">Informasi Tambahan Mengenai Pihak ini</label>
                        <textarea x-model="player_info" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="" class="form-label">Sektor</label>
                        <select x-model="selected_sector" name="" id="" class="form-control">
                            <option selected>--Pilih Sektor--</option>
                            <template x-for="(_sector, i) of sectors">
                                <option :selected="selected_sector == _sector.id" :value="_sector.id" x-text="_sector.name"></option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="" class="form-label">Level</label>
                        <select x-model="selected_level" name="" id="" class="form-control">
                            <option selected>--Pilih Level--</option>
                            <template x-for="(_level, i) of levels">
                                <option :selected="selected_level == _level.id" :value="_level.id" x-text="_level.name"></option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <fieldset class="border p-2">
                        <legend class="float-none w-auto p-2">Posisi Pihak</legend>
                        <center>
                            <i>Untuk menentukan posisi dari pihak ini, tarik slider dibawah ini atau dengan menjawab beberapa kuisioner untuk menentukan lebih tepat</i>
                        </center>
                        <div class="form-group pt-4 pl-3 pr-3">

                            <div class="py-2 p-4">
                                <input @input="(e) => {changeSlider(e.currentTarget.value)}" x-model="position_scale" type="range" class="form-range" min="{{$dataScale->ps_dh}}" max="{{$dataScale->ps_sh}}" step="0.5" id="customRange3">
                            </div>

                            <div class="row mx-center p-4 gap-4">
                                <div class="col-md-3" style="border-style: dotted; background-color: #ff7373;">
                                    <div>
                                        <div class="row p-2">
                                            <div class="col-md-4">
                                                <input @change="() => changeRadioScale('ps_dh')" x-bind:checked="selected_position_scale === 'ps_dh'" type="radio" name="paramScalePosition" id="" class="form-check-input"><br>
                                                <label for="">Tinggi</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input @change="() => changeRadioScale('ps_dmh')" x-bind:checked="selected_position_scale === 'ps_dmh'" type="radio" name="paramScalePosition" id="" class="form-check-input"><br>
                                                <label for="">Sedang</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input @change="() => changeRadioScale('ps_dlh')" x-bind:checked="selected_position_scale === 'ps_dlh'" type="radio" name="paramScalePosition" id="" class="form-check-input"><br>
                                                <label for="">Rendah</label>
                                            </div>
                                        </div>
                                        <div class="py-3">
                                            <center>
                                                <h4>Menolak</h4>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="border-style: dotted;">
                                    <div>
                                        <div class="row p-2">
                                            <div class="col-md-4 mx-auto">
                                                <input @change="() => changeRadioScale('ps_nh')" x-bind:checked="selected_position_scale === 'ps_nh'" type="radio" name="paramScalePosition" id="" class="form-check-input"><br>
                                                <label for="">Netral</label>
                                            </div>
                                        </div>
                                        <div class="py-3">
                                            <center>
                                                <h4>Netral</h4>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3" style="border-style: dotted; background-color: #3fe827;">
                                    <div>
                                        <div class="row p-2">
                                            <div class="col-md-4">
                                                <input @change="() => changeRadioScale('ps_slh')" x-bind:checked="selected_position_scale === 'ps_slh'" type="radio" name="paramScalePosition" id="" class="form-check-input"><br>
                                                <label for="">Rendah</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input @change="() => changeRadioScale('ps_smh')" x-bind:checked="selected_position_scale === 'ps_smh'" type="radio" name="paramScalePosition" id="" class="form-check-input"><br>
                                                <label for="">Sedang</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input @change="() => changeRadioScale('ps_sh')" x-bind:checked="selected_position_scale === 'ps_sh'" type="radio" name="paramScalePosition" id="" class="form-check-input"><br>
                                                <label for="">Tinggi</label>
                                            </div>
                                        </div>
                                        <div class="py-3">
                                            <center>
                                                <h4>Mendukung</h4>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="my-auto">
                                        <button class="btn btn-secondary align-middle">Tentukan via kuisioner</button>
                                    </div>
                                </div>
                            </div>

                            <div class="py-2">
                                <center>
                                    <div class="d-inline-flex">
                                        <label for="">Indikator posisi yang telah ditentukan</label>
                                        <input :value="position_scale" disabled type="text" class="form-control">
                                    </div>
                                </center>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-12 mb-3">
                    <fieldset class="border p-2">
                        <legend class="float-none w-auto p-2">Kekuatan Pihak</legend>
                        <center>
                            <i>Untuk menentukan kekuatan dari pihak ini, tarik slider dibawah ini atau dengan menjawab beberapa kuisioner untuk menentukan lebih tepat</i>
                        </center>
                        <div class="form-group pt-4 pl-3 pr-3">

                            <div class="py-2 p-4">
                                <input @input="(e) => changeSliderPower(parseFloat(e.currentTarget.value))" x-model="power_scale" type="range" class="form-range" min="{{$dataScale->pw_l}}" max="{{$dataScale->pw_h}}" step="0.5" id="customRange3">
                            </div>

                            <div class="row mx-center p-4 gap-4">
                                <div class="col-md-10" style="border-style: dotted;">
                                    <div>
                                        <div class="row p-2">
                                            <div class="col-md-4">
                                                <input :checked="selected_power_scale == 'pw_l'" @change="() => changeRadioScale('pw_l')" type="radio" name="paramScalePower" id="" class="form-check-input"><br>
                                                <label for="">Rendah</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input :checked="selected_power_scale == 'pw_mh'" @change="() => changeRadioScale('pw_mh')" type="radio" name="paramScalePower" id="" class="form-check-input"><br>
                                                <label for="">Sedang</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input :checked="selected_power_scale == 'pw_h'" @change="() => changeRadioScale('pw_h')" type="radio" name="paramScalePower" id="" class="form-check-input"><br>
                                                <label for="">Tinggi</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="my-auto">
                                        <button class="btn btn-secondary align-middle">Tentukan via kuisioner</button>
                                    </div>
                                </div>
                            </div>
                            <div class="py-2">
                                <center>
                                    <div class="d-inline-flex">
                                        <label for="">Indikator kekuatan yang telah ditentukan</label>
                                        <input x-model="power_scale" disabled type="text" class="form-control">
                                    </div>
                                </center>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="float-end">
                <button @click="sendData" :disabled="is_loading" class="btn btn-success text-white">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push("script")
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://unpkg.com/uuid@latest/dist/umd/uuidv4.min.js"></script>
<script>
    function __initAlpine() {
        return {
            is_error: false,
            is_success: false,
            errors: [],
            is_loading: false,
            levels: JSON.parse(`@json($data["levels"])`),
            sectors: JSON.parse(`@json($data["sectors"])`),

            player_name: "{{$player->name}}",
            player_info: "{{$player->details}}",
            selected_sector: "{{$player->sector_id}}",
            selected_level: "{{$player->level_id}}",
            selected_position_scale: "",
            selected_power_scale: "",
            position_scale: parseFloat("{{$player->position}}"),
            power_scale: parseFloat("{{$player->power}}"),

            initScaler(){
                this.changeSlider(this.position_scale);
                this.changeSliderPower(this.power_scale);
            },

            // low <= n <= high
            changeSlider(value) {
                if (value <= parseFloat("{{$dataScale->ps_dh}}")) {
                    console.log("HIT : PS_DH");
                    this.selected_position_scale = "ps_dh";
                    return;
                }
                if (value <= parseFloat("{{$dataScale->ps_dml}}") && value <= parseFloat("{{$dataScale->ps_dmh}}")) {
                    console.log("HIT : PS_DMH")
                    this.selected_position_scale = "ps_dmh";
                    return;
                }
                if (value <= parseFloat("{{$dataScale->ps_dll}}") && value <= parseFloat("{{$dataScale->ps_dlh}}")) {
                    console.log("HIT : PS_DLH")
                    this.selected_position_scale = "ps_dlh";
                    return;
                }
                if (value <= parseFloat("{{$dataScale->ps_nl}}") && value >= parseFloat("{{$dataScale->ps_nh}}")) {
                    console.log("HIT : PS_NH")
                    this.selected_position_scale = "ps_nh";
                    return;
                }
                if (value >= parseFloat("{{$dataScale->ps_sll}}") && value <= parseFloat("{{$dataScale->ps_slh}}")) {
                    console.log("HIT : PS_SLH")
                    this.selected_position_scale = "ps_slh";
                    return;
                }
                if (value >= parseFloat("{{$dataScale->ps_sml}}") && value <= parseFloat("{{$dataScale->ps_smh}}")) {
                    console.log("HIT : PS_SMH")
                    this.selected_position_scale = "ps_smh";
                    return;
                }
                if (value >= parseFloat("{{$dataScale->ps_sh}}")) {
                    console.log("HIT : PS_SH")
                    this.selected_position_scale = "ps_sh";
                    return;
                }
            },

            changeSliderPower(value) {
                if (value <= parseFloat("{{$dataScale->pw_l}}")) {
                    console.log("HIT : PW_L")
                    this.selected_power_scale = "pw_l";
                    return;
                }
                if (value >= parseFloat("{{$dataScale->pw_ml}}") && value <= parseFloat("{{$dataScale->pw_mh}}")) {
                    console.log("HIT : PW_MH")
                    this.selected_power_scale = "pw_mh";
                    return;
                }
                if (value >= parseFloat("{{$dataScale->pw_ml}}")) {
                    console.log("HIT : PW_ML")
                    this.selected_power_scale = "pw_ml";
                    return;
                }
            },

            changeRadioScale(type) {
                switch (type) {
                    case "ps_dh":
                        this.position_scale = "{{$dataScale->ps_dh}}";
                        this.selected_position_scale = "ps_dh";
                        break;
                    case "ps_dmh":
                        this.position_scale = "{{$dataScale->ps_dmh}}";
                        this.selected_position_scale = "ps_dmh";
                        break;
                    case "ps_dlh":
                        this.position_scale = "{{$dataScale->ps_dlh}}";
                        this.selected_position_scale = "ps_dlh";
                        break;
                    case "ps_nh":
                        this.position_scale = "{{$dataScale->ps_nh}}";
                        this.selected_position_scale = "ps_nh";
                        break;
                    case "ps_slh":
                        this.position_scale = "{{$dataScale->ps_slh}}";
                        this.selected_position_scale = "ps_slh";
                        break;
                    case "ps_smh":
                        this.position_scale = "{{$dataScale->ps_smh}}";
                        this.selected_position_scale = "ps_smh";
                        break;
                    case "ps_sh":
                        this.position_scale = "{{$dataScale->ps_sh}}";
                        this.selected_position_scale = "ps_sh";
                        break;
                    case "pw_l":
                        this.power_scale = "{{$dataScale->pw_l}}"
                        this.selected_power_scale = "pw_l";
                        break;
                    case "pw_mh":
                        this.power_scale = "{{$dataScale->pw_mh}}"
                        this.selected_power_scale = "pw_mh";
                        break;
                    case "pw_h":
                        this.power_scale = "{{$dataScale->pw_h}}"
                        this.selected_power_scale = "pw_h";
                        break;
                }
            },

            async sendData() {
                this.is_error = false;
                this.is_success = false;
                this.is_loading = true;
                this.errors = [];
                try {
                    let response = await axios.post("{{route('project_player.edit_action', [$id, $player->id])}}", {
                        "_token": "{{csrf_token()}}",
                        name: this.player_name,
                        details: this.player_info,
                        sector: this.selected_sector,
                        level: this.selected_level,
                        position_scale: this.position_scale,
                        power_scale: this.power_scale
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
                            document.location.href = "{{route('project_player.index', $id)}}";
                        }, 1500);
                    }
                }
            }

        }
    }
</script>

@endpush