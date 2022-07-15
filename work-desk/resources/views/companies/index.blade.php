@extends('base')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container mt-3">
        <h3>لیست شرکت ها</h3>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">کد</th>
                <th scope="col">نام</th>
                <th scope="col">حقوق ماهانه</th>
                <th scope="col">جمع ساعت کاری ماهانه</th>
                <th scope="col">تاریخ بروزرسانی</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->salary }}</td>
                    <td>{{ $company->full_time_in_hours }}</td>
                    <td>{{ $company->updated_at }}</td>
                    <td>
                        <button type="submit" class="btn btn-outline-primary">ویرایش</button>
                        <button type="submit" class="btn btn-outline-primary">حذف</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
