@extends("layouts.base")


@section("menu")
Pihak-Pihak
@endsection

@section("breadcrumb")
Edit Ketertarikan
@endsection

@section("title")
Edit Ketertarikan
@endsection

@section("current_page")
Edit Ketertarikan
@endsection


@section("contents")
<div x-data="__alpineInit()">
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
                        Berhasil mengubah interest, anda sedang diarahkan ke daftar interest
                    </div>
                </template>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="">Pihak</label>
                        <select x-model="player" name="" id="" class="form-control">
                            <template x-for="(_player, i) of players">
                                <option :selected="_player.id == player" :value="_player.id" x-text="_player.name"></option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for="">Tipe of Interest</label>
                        <select x-model="interest_type" name="" id="" class="form-control">
                            <template x-for="(_interest, i) of interests">
                                <option :selected="_interest.id == interest_type" :value="_interest.id" x-text="_interest.name"></option>
                            </template>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-group">
                        <label for="">Interest</label>
                        <textarea x-model="interest" name="" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-8">
                    <fieldset class="border p-2">
                        <legend class="float-none w-auto p-2">Tingkat Prioritas</legend>
                        <div class="row ml-4">
                            <div class="col-4">
                                <span>Indikator Prioritas</span>
                                <div :style="{'background-color' : color}" style="width: 100px; height: 30px;">

                                </div>
                            </div>
                            <div class="col-8">
                                <div class="gx-2 d-inline-flex" style="gap: 10px;">
                                    <div>
                                        <input class="form-check-input" type="radio" x-model="priority" :value="{{\App\Constants\PriorityLevel::LOW}}">
                                        <label class="form-check-label" for="flexRadioDefault2">Rendah</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" x-model="priority" :value="{{\App\Constants\PriorityLevel::MEDIUM}}">
                                        <label class="form-check-label" for="flexRadioDefault2">Menengah</label>
                                    </div>
                                    <div>
                                        <input class="form-check-input" type="radio" x-model="priority" :value="{{\App\Constants\PriorityLevel::HIGH}}">
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

<script>
    function __alpineInit() {
        return {
            player: "{{$data->player_id}}",
            interest: "{{$data->interest}}",
            interest_type: "{{$data->interest_id}}",
            priority: "{{$data->priority}}",

            is_error: false,
            is_success: false,
            errors: [],
            is_loading: false,

            players: JSON.parse(`@json($players)`),
            interests: JSON.parse(`@json($interests)`),

            color: "#abcdef",

            async sendData() {
                this.is_error = false;
                this.is_success = false;
                this.is_loading = true;
                this.errors = [];
                try {
                    let response = await axios.post("{{route('project_interests.edit_action', [$id, $data->id])}}", {
                        "_token": "{{csrf_token()}}",
                        player : this.player,
                        interest : this.interest,
                        interest_type : this.interest_type,
                        priority : this.priority
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
                            document.location.href = "{{route('project_interests.index', $id)}}";
                        }, 1500);
                    }
                }
            }
        }
    }
</script>

@endpush