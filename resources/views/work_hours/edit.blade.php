@extends('base')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <h3>ویرایش ساعت کاری</h3>
        <form class="mt-5" action="{{ route('working_hours.store') }}" method="POST">
            @csrf
            <label for="name">ساعت ورود</label>
            <input class="form-input form-control" id="name" type="text" name="name"
                   aria-label="default input example" required>
            <div class="col-12 d-flex">
                <div class="col-6">
                    <label for="name">ساعت خروج</label>
                    <input class="form-input flex-group form-control" type="number" name="salary" required>
                </div>
                <div class="col-6">
                    <label for="name">نام شرکت</label>
                    <input class="form-input flex-group form-control" type="number" name="full_time_in_hours" required>
                </div>
                <div class="col-6">
                    <label for="name">نام پروژه</label>
                    <input class="form-input flex-group form-control" type="number" name="full_time_in_hours" required>
                </div>
                <div class="col-6">
                    <label for="name">تسک های مربوطه</label>
                    <input class="form-input flex-group form-control" type="number" name="full_time_in_hours" required>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-sm-end justify-content-lg-center">
                <button type="submit" class="btn btn-outline-primary">ثبت</button>
            </div>
        </form>

    </div>

@endsection
