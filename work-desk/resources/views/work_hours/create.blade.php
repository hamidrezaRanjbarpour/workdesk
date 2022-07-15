@extends('base')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
        <h3>ثبت ساعت کاری</h3>

        @if($errors->any())
            {!! implode('', $errors->all('<span class="text text-danger">:message</span>')) !!}
        @endif

        <form class="mt-5" action="{{ route('working_hours.store') }}" method="POST">
            @csrf
            <div>

                <label for="company_name">نام شرکت</label>
                <select id="company_name" name="company_id" class="form-select" aria-label="Default select example">
                    <option value="0">انتخاب نام شرکت</option>
                </select>

            </div>
            <div class="col-12 d-flex">
                <div class="col-6">
                    <label for="name">ساعت ورود</label>
                    <input class="form-input flex-group form-control" type="text" name="start" value="{{old('start')}}" required>
                    <button type="button" class="btn date-btn btn-outline-secondary">الان!</button>
                </div>
                <div class="col-6">
                    <label for="name">ساعت خروج</label>
                    <input class="form-input flex-group form-control" type="text" name="end" value="{{old('end')}}">
                    <button type="button" class="btn date-btn btn-outline-secondary">الان!</button>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-sm-end justify-content-lg-center">
                <button type="submit" class="my-btn btn btn-outline-primary">ثبت</button>
            </div>
        </form>

    </div>

@endsection

@section('script')
    <script src="{{ asset('js/work_hours/create.js') }}"></script>
@endsection
