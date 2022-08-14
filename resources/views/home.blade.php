@extends('layouts.base')



@section("menu")
Dashboard
@endsection

@section("breadcrumb")
Homepage
@endsection

@section("title")
Homepage
@endsection


@section('contents')
<div class="row">
    <div class="col-md-6 d-none d-md-block">
        <center>
            <i class="fa-solid fa-scale-balanced" style="font-size: 200pt;"></i>
        </center>
    </div>
    <div class="col-md-6">
        <div class="card border-light shadow-sm components-section">
            <div class="card-header">
                <h3>Policy Maker</h3>
            </div>
            <div class="card-body">
                <div class="p-2">
                    <p>Merupakan alat bantu untuk menganalisa kebijakan yang dibuat dan akan diimplementasikan; Menentukan posisi dan kekuatan dari setiap pihak dengan menganalisa dari setiap individu; Mengembangkan strategi politikal, dan; menilai hasil akhir permodelan strategi dimasa yang akan mendatang.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection