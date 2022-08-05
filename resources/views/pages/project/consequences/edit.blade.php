@extends("layouts.base")

@section("menu")
Pihak-Pihak
@endsection

@section("breadcrumb")
Edit Konsekuensi
@endsection

@section("title")
Edit Konsekuensi
@endsection

@section("current_page")
Edit Konsekuensi
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
                        Berhasil mengubah konsekuensi, anda sedang diarahkan ke daftar konsekuensi
                    </div>
                </template>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="">Deskripsi Konsekuensi</label>
                        <textarea x-model="description" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="">Dampak Konsekuensi</label>
                        <textarea x-model="impact" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="">Timing Konsekuensi</label>
                        <textarea x-model="timing" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Konsekuensi ditujukan kepada</label>
                    <select x-model="target" name="" id="" class="form-control">
                        <template x-for="(_player, i) of players">
                            <option :value="_player.id" x-text="_player.name"></option>
                        </template>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Jenis Konsekuensi</label>
                    <select x-model="type" name="" id="" class="form-control">
                        <template x-for="(_consequence, i) of consequences">
                            <option :value="_consequence.id" x-text="_consequence.name"></option>
                        </template>
                    </select>
                </div>
                <div class="col-md-8">
                    <fieldset class="border p-2">
                        <legend class="float-none w-auto p-2">Tingkat Kepentingan</legend>
                        <div class="row ml-4">
                            <div class="col-4">
                                <span>Indikator Kepentingan</span>
                                <div :style="{'background-color' : color}" style="width: 100px; height: 30px;">

                                </div>
                            </div>
                            <div class="col-8">
                                <div class="gx-2 d-inline-flex" style="gap: 10px;">
                                    <div>
                                        <input class="form-check-input" type="radio" x-model="importance" :value="{{\App\Constants\ImportanceLevel::UNKNOWN}}">
                                        <label class="form-check-label" for="flexRadioDefault2">Tidak Diketahui</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" x-model="importance" :value="{{\App\Constants\ImportanceLevel::LOW}}">
                                        <label class="form-check-label" for="flexRadioDefault2">Rendah</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" x-model="importance" :value="{{\App\Constants\ImportanceLevel::MEDIUM}}">
                                        <label class="form-check-label" for="flexRadioDefault2">Menengah</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" x-model="importance" :value="{{\App\Constants\ImportanceLevel::HIGH}}">
                                        <label class="form-check-label" for="flexRadioDefault2">Tinggi</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="float-end">
                <button @click="sendData" :disabled="is_loading" class="btn btn-success text-white"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push("script")
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://unpkg.com/uuid@latest/dist/umd/uuidv4.min.js"></script>
<script>
    const UNKNOWN = "{{\App\Constants\ImportanceLevel::UNKNOWN}}";
    const LOW_COLOR = "{{\App\Constants\ImportanceLevel::LOW_COLOR}}";
    const MEDIUM_COLOR = "{{\App\Constants\ImportanceLevel::MEDIUM_COLOR}}";
    const HIGH_COLOR = "{{\App\Constants\ImportanceLevel::HIGH_COLOR}}";

    function __initAlpine() {
        return {
            is_error: false,
            is_success: false,
            is_loading: false,
            errors: [],

            description: "{{$data->description}}",
            impact: "{{$data->size_of_consequence}}",
            timing: "{{$data->timing_of_consequence}}",
            target: "{{$data->player_id}}",
            type: "{{$data->consequence_id}}",
            importance: "{{$data->importance}}",

            color: "#abcdef",

            players: JSON.parse(`@json($players)`),
            consequences: JSON.parse(`@json($consequences)`),

            async sendData() {
                this.is_error = false;
                this.is_success = false;
                this.is_loading = true;
                this.errors = [];
                try {
                    let response = await axios.post("{{route('project_consequences.edit_action', [$id, $data->id])}}", {
                        "_token": "{{csrf_token()}}",
                        description: this.description,
                        impact: this.impact,
                        timing: this.timing,
                        target: this.target,
                        type: this.type,
                        importance: this.importance,
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
                            document.location.href = "{{route('project_consequences.index', $id)}}";
                        }, 1500);
                    }
                }
            }

        }
    }
</script>
@endpush