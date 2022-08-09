@extends("layouts.base")

@section("menu")
Strategi
@endsection

@section("breadcrumb")
Ubah Strategi
@endsection

@section("title")
Ubah Strategi
@endsection

@section("current_page")
Ubah Strategi
@endsection

@section("contents")
<div x-data="__initAlpine()" x-init="init">
    <div class="py-4">
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
                            Berhasil mengubah strategi, anda sedang diarahkan ke daftar strategi
                        </div>
                    </template>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Nama Pihak</label>
                        <select x-ref="select" name="" id="selectPlayer" class="form-control">
                            <optgroup label="Supporter">
                                @foreach ($players->support as $player)
                                <option data-position="{{\App\Constants\Strategies\StrategyType::SUPPORT}}" value="{{$player->id}}">{{$player->name}}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Netral">
                                @foreach ($players->neutral as $player)
                                <option data-position="{{\App\Constants\Strategies\StrategyType::NON_MOBILIZED}}" value="{{$player->id}}">{{$player->name}}</option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Oposisi">
                                @foreach ($players->opposition as $player)
                                <option data-position="{{\App\Constants\Strategies\StrategyType::OPPOSITION}}" value="{{$player->id}}">{{$player->name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Posisi pihak</label>
                            <input x-model="player_pos_txt" disabled type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Kesempatan yang disampaikan oleh pihak</label>
                            <textarea x-model="player_opportunities" disabled name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Rintangan yang disampaikan oleh pihak</label>
                            <textarea x-model="player_obstacles" disabled name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Pilih Strategi yang Disarankan</label>
                        <div style="height: 300px; overflow-y: scroll;">
                            <ul style="list-style: none">
                                <template x-if="strategies?.length <= 0">
                                    <span>Tidak ada strategi yang tersedia</span>
                                </template>
                                <template x-for="(_strategy, i) of strategies">
                                    <li>
                                        <input type="radio" :selected="selected_strategy == _strategy.id ? 'true' : 'false'" :value="_strategy.id" x-model="selected_strategy" name="selected_strategy" id=""> <span x-text="_strategy.text"></span>
                                    </li>
                                </template>

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="">Definisikan aksi yang akan dilakukan dengan strategi yang dipilih</label>
                            <textarea x-model="player_actions" name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Analisa terhadap tantangan terhadap aksi yang dimasukkan</label>
                            <textarea x-model="player_challanges" name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Analisa terhadap timeline terhadap aksi yang dimasukkan</label>
                            <textarea x-model="player_timelines" name="" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="form-group">
                            <label for="">Probabilitas Kesuksesan</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <input x-model="probability" type="range" name="" id="" class="form-range">
                                </div>
                                <div class="col-md-2">
                                    <input :value="probability" disabled type="text" class="form-control">
                                </div>
                            </div>
                        </div>
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
</div>
@endsection

@push("header")
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push("script")
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/alpinejs" defer></script>
<script>
    $(document).ready(function() {
        $('#selectPlayer').select2();
    });

    function __initAlpine() {
        return {
            is_error: false,
            is_success: false,
            errors: [],
            is_loading: false,
            player: "{{$strategy->player_id}}",
            player_pos: "",
            player_pos_txt: "{{$strategy->position_label}}",
            player_obstacles: "",
            player_opportunities: "",
            player_actions: "{{$strategy->strategy_action}}",
            player_challanges: "{{$strategy->challanges}}",
            player_timelines: "{{$strategy->timelines}}",
            select2: null,
            selected_strategy: "{{$strategy->predefined_strategy_id}}",
            strategies: [],
            probability: "{{$strategy->probability}}",

            init() {
                this.select2 = $(this.$refs.select).select2();
                let select = $(this.$refs.select).get(0);
                let pos = select.options[select.selectedIndex].getAttribute("data-position");
                this.select2.val(this.player).trigger("change")
                this.getStrategies(pos);
                this.getPlayerDetail(this.player);
                this.select2.on("select2:select", (event) => {
                    this.player = event.target.value;
                    this.player_pos = event.target.options[event.target.selectedIndex].getAttribute("data-position");
                    this.player_pos_txt = this.getPlayerPos(this.player_pos);
                });
                this.$watch("player_pos", () => {
                    this.getPlayerDetail(this.player);
                    this.getStrategies(this.player_pos);
                });
            },

            getPlayerPos(type) {
                switch (type) {
                    case "{{\App\Constants\Strategies\StrategyType::SUPPORT}}":
                        return "Mendukung";
                    case "{{\App\Constants\Strategies\StrategyType::NON_MOBILIZED}}":
                        return "Netral";
                    case "{{\App\Constants\Strategies\StrategyType::OPPOSITION}}":
                        return "Menolak";
                }
            },

            async getStrategies(type) {
                try {
                    let response = await axios.get(`{{route('project_predefined_strategy.get_strategies', $id)}}?strategy_type=${type}`);
                    let strategies = response.data?.data;
                    this.strategies = strategies;
                } catch (err) {
                    //Ignore
                }
            },

            async getPlayerDetail(id) {
                this.player_opportunities = "";
                this.player_obstacles = "";
                try {
                    let response = await axios.get(`{{route('project_predefined_strategy.get_opses', $id)}}?player_id=${id}`);
                    let data = response.data?.data;

                    for (const entry of data) {
                        this.player_opportunities += entry?.opportunity + `;\n`;
                        this.player_obstacles += entry?.obstacle + `;\n`;
                    }
                } catch (err) {
                    //Ignore
                }
            },

            async sendData() {
                this.is_error = false;
                this.is_success = false;
                this.is_loading = true;
                this.errors = [];
                try {
                    let response = await axios.post("{{route('project_predefined_strategy.edit_action', [$id, $strategyId])}}", {
                        "_token": "{{csrf_token()}}",
                        player_id: this.player,
                        selected_strategy_id: this.selected_strategy,
                        strategy_actions: this.player_actions,
                        challanges: this.player_challanges,
                        timelines: this.player_timelines,
                        probability: this.probability
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
                            document.location.href = "{{route('project_predefined_strategy.index', $id)}}";
                        }, 1500);
                    }
                }
            },

            onPlayerChange(e) {
                console.log(e);
            }
        }
    }
</script>
@endpush