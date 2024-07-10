@extends('base')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <h3>ثبت شرکت</h3>
        <form class="mt-5" action="{{ route('companies.store') }}" method="POST">
            @csrf
            <label for="name">نام</label>
            <input class="form-input form-control" id="name" type="text" name="name" placeholder="نام"
                   aria-label="default input example" required>
            <div class="col-12 d-flex">
                <div class="col-6">
                    <label for="name">حقوق ماهانه</label>
                    <input class="form-input flex-group form-control" type="number" name="salary"
                           placeholder="حقوق ماهانه" required>
                </div>
                <div class="col-6">
                    <label for="name">جمع ساعت کاری ماهانه</label>
                    <input class="form-input flex-group form-control" type="number" name="full_time_in_hours"
                           placeholder="جمع ساعت کاری ماهانه" required>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-sm-end justify-content-lg-center">
                <button type="submit" class="btn btn-outline-primary">ثبت</button>
            </div>
        </form>

    </div>

@endsection
