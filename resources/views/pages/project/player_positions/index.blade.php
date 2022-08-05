@extends("layouts.base")


@section("menu")
Pihak-Pihak
@endsection

@section("breadcrumb")
Peta Posisi Pihak
@endsection

@section("title")
Peta Posisi Pihak
@endsection

@section("current_page")
Peta Posisi Pihak
@endsection

@section("contents")
<div class="card border-light shadow-sm components-section">
    <div class="card-body">
        <div class="table-responsive">
            <table class="w-100">
                <tr>
                    <td style="width: 14%">
                        <div style="border-style: solid; min-height: 300px; background-color: {{\App\Constants\PositionScale::HIGH_SUPPORT_COLOR}}">
                            <div class="p-2">
                                <h5>Support Tinggi</h5>
                            </div>
                            <div style="border-bottom: 3px solid #333;"></div>
                            <div class="pt-4">
                                <table class="w-100">
                                    @foreach($data[\App\Constants\PositionScale::HIGH_SUPPORT] as $highSupport)
                                    <tr>
                                        <td class="p-2">
                                            <div style="background-color: grey; color: white; text-align: center;" class="mb-3">{{$highSupport->name}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </td>
                    <td style="width: 14%">
                        <div style="border-style: solid; min-height: 300px; background-color: {{\App\Constants\PositionScale::MEDIUM_SUPPORT_COLOR}}">
                            <div class="p-2">
                                <h5>Support Medium</h5>
                            </div>
                            <div style="border-bottom: 3px solid #333;"></div>
                            <div class="pt-4">
                                <table class="w-100">
                                    @foreach($data[\App\Constants\PositionScale::MEDIUM_SUPPORT] as $mediumSupport)
                                    <tr>
                                        <td class="p-2">
                                            <div style="background-color: grey; color: white; text-align: center;" class="mb-3">{{$mediumSupport->name}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </td>
                    <td style="width: 14%">
                        <div style="border-style: solid; min-height: 300px; background-color: {{\App\Constants\PositionScale::LOW_SUPPORT_COLOR}}">
                            <div class="p-2">
                                <h5>Support Rendah</h5>
                            </div>
                            <div style="border-bottom: 3px solid #333;"></div>
                            <div class="pt-4">
                                <table class="w-100">
                                    @foreach($data[\App\Constants\PositionScale::LOW_SUPPORT] as $lowSupport)
                                    <tr>
                                        <td class="p-2">
                                            <div style="background-color: grey; color: white; text-align: center;" class="mb-3">{{$lowSupport->name}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </td>
                    <td style="width: 14%">
                        <div style="border-style: solid; min-height: 300px;">
                            <div class="p-2">
                                <h5>Netral</h5>
                            </div>
                            <div style="border-bottom: 3px solid #333;"></div>
                            <div class="pt-4">
                                <table class="w-100">
                                    @foreach($data[\App\Constants\PositionScale::NON_MOBILIZED] as $neutralSupport)
                                    <tr>
                                        <td class="p-2">
                                            <div style="background-color: grey; color: white; text-align: center;" class="mb-3">{{$neutralSupport->name}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </td>
                    <td style="width: 14%">
                        <div style="border-style: solid; min-height: 300px; background-color: {{\App\Constants\PositionScale::LOW_OPOSITION_COLOR}}">
                            <div class="p-2">
                                <h5>Oposisi Rendah</h5>
                            </div>
                            <div style="border-bottom: 3px solid #333;"></div>
                            <div class="pt-4">
                                <table class="w-100">
                                    @foreach($data[\App\Constants\PositionScale::LOW_OPOSITION] as $lowOposition)
                                    <tr>
                                        <td class="p-2">
                                            <div style="background-color: grey; color: white; text-align: center;" class="mb-3">{{$lowOposition->name}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </td>
                    <td style="width: 14%">
                        <div style="border-style: solid; min-height: 300px; background-color: {{\App\Constants\PositionScale::MEDIUM_OPOSITION_COLOR}}">
                            <div class="p-2">
                                <h5>Oposisi Medium</h5>
                            </div>
                            <div style="border-bottom: 3px solid #333;"></div>
                            <div class="pt-4">
                                <table class="w-100">
                                    @foreach($data[\App\Constants\PositionScale::MEDIUM_OPOSITION] as $mediumOposition)
                                    <tr>
                                        <td class="p-2">
                                            <div style="background-color: grey; color: white; text-align: center;" class="mb-3">{{$mediumOposition->name}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </td>
                    <td style="width: 14%">
                        <div style="border-style: solid; min-height: 300px; background-color: {{\App\Constants\PositionScale::HIGH_OPOSITION_COLOR}}">
                            <div class="p-2">
                                <h5>Oposisi Tinggi</h5>
                            </div>
                            <div style="border-bottom: 3px solid #333;"></div>
                            <div class="pt-4">
                                <table class="w-100">
                                    @foreach($data[\App\Constants\PositionScale::HIGH_OPOSITION] as $highOposition)
                                    <tr>
                                        <td class="p-2">
                                            <div style="background-color: grey; color: white; text-align: center;" class="mb-3">{{$highOposition->name}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection