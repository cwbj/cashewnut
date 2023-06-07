<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@section('content')
<!-- Your custom  HTML goes here -->
<div class="row mb-20">
    <div class="col-md-3 card mb-3 text-center">
        <a href="{{ url('/admin/works') }}">
            <div class="card-body bg-light sd">
                <h5 class="card-title">Today's Works (Peeling)</h5>
                <span class="angka">{{ number_format($notes_count) }}</span>
                <p>Units</p>
            </div>
        </a>
    </div>
    <div class="col-md-3 card mb-3 text-center">
        <a href="{{ url('/admin/works') }}">
            <div class="card-body bg-light smp">
                <h5 class="card-title">Today's Works (Cleaning)</h5>
                <span class="angka">{{ number_format(0) }}</span>
                <p>Units</p>
            </div>
        </a>
    </div>

    <div class="col-md-3 card mb-3 text-center">
        <a href="{{ url('/admin/works') }}">
            <div class="card-body bg-light sd">
                <h5 class="card-title">Today's Amounts</h5>
                <span class="angka">{{ number_format($notes_count) }}</span>
                <p>grams (g)</p>
            </div>
        </a>
    </div>
    <div class="col-md-3 card mb-3 text-center">
        <a href="{{ url('/admin/students') }}">
            <div class="card-body bg-light smp">
                <h5 class="card-title">Students</h5>
                <span class="angka">{{ number_format($participants_count) }}</span>
                <p>People</p>
            </div>
        </a>
    </div>

    <div class="col-md-4 card mb-3">
        <div class="card mb-20">
            <div class="card-body bg-white">
                <h4 class="card-title">Welcome to Cashewnut App, {{ $orang->name }}!</h4>
                <p>You have been logged in as <b>{{ $hak_akses }}</b>!</p>

                <p>Please check the the works from calendar beside or below. You could click on the icon and the colored section to get to the details page.</p>
 
                <!-- <a class="btn btn-app ungu" href="{{ url('/admin/faq') }}">
                    <i class="fa fa-question-circle"></i> FAQ
                </a> -->
                <a class="btn btn-app ungu" href="{{ url('/admin/users/profile') }}">
                    <i class="fa fa-user"></i> Profile
                </a>

                <!-- ---------- -->
                <hr>
                
            </div>
            
        </div>
    </div>
    <!-- .col-md-6.card -->
    <div class="col-md-8 card mb-3">

        <div class="box box-default box-grafik">
            <div class="box-body" style="padding:25px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="chart-responsive" style="margin:25px 0;">
                            <div id="calendar"></div>
                        </div>
                        <!-- ./chart-responsive -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- .col-md-8 -->

</div>
<!-- ADD A PAGINATION -->
@endsection