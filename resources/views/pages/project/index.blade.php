@extends("layouts.base")

@section("menu")
Proyek
@endsection

@section("breadcrumb")
{{$data?->name}}
@endsection

@section("title")
{{$data?->name}}
@endsection


@section("contents")
<div class="p-2">
    <div class="row g-4">
        <div class="col-md-6">
            <h4>Informasi Proyek</h4>
            <div class="pt-2">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row" style="width: 10%;">Nama Proyek</th>
                                        <td>{{$data?->name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nama Analis</th>
                                        <td>{{$data?->analyst_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nama Klien</th>
                                        <td>{{$data?->client_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tanggal Kebijakan</th>
                                        <td>{{$data?->policy_date}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tanggal Analisis</th>
                                        <td>{{$data?->analysis_date}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Keterangan</th>
                                        <td>{{$data?->description}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Menu Utama</h4>

            <div class="pt-2">
                <div class="row mb-3">
                    <div class="card rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="align-middle">
                                        <i class="fa fa-times" style="font-size: 48pt;"></i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <h5>A. Kebijakan</h5>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, saepe?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="card rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="align-middle">
                                        <i class="fa fa-times" style="font-size: 48pt;"></i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <h5>B. Pihak-Pihak</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="card rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="align-middle">
                                        <i class="fa fa-times" style="font-size: 48pt;"></i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <h5>C. Strategi</h5>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est, at similique. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="card rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="align-middle">
                                        <i class="fa fa-times" style="font-size: 48pt;"></i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <h5>D. Impact</h5>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est, at similique. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="card rounded">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="align-middle">
                                        <i class="fa fa-times" style="font-size: 48pt;"></i>
                                    </span>
                                </div>
                                <div class="col-md-10">
                                    <h5>E. Report</h5>
                                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est, at similique. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection