@extends('base')

@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')

    {{--    @php--}}
    {{--        dd($work_hours->toArray());--}}
    {{--    @endphp--}}

    <div class="container mt-3">
        <h5> لیست ساعات کاری شرکت {{$company->name}} </h5>

        <table class="table table-hover mt-5 my-table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">روز</th>
                <th scope="col">تاریخ</th>
                <th scope="col">ساعت ورود</th>
                <th scope="col">ساعت خروج</th>
                <th scope="col">جمع ساعت فعالیت</th>
                <th scope="col">تاریخ بروزرسانی</th>
                <th scope="col">عملیات</th>
            </tr>
            </thead>
            <tbody id="table-body"></tbody>
        </table>

        <div class="">{{ $work_hours->links() }}</div>

        <div class="modal fade" id="update_work_hour_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ویرایش ساعت کاری</h5>
{{--                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
                    </div>
                    <div class="modal-body my-2">
{{--                        <div class="d-flex justify-content-center align-items-center text-center">--}}
{{--                            <div class="col text-nowrap">کد کاربر: <span class="user-code fw-bolder ticket-data"></span></div>--}}
{{--                            <hr class="col">--}}
{{--                            <div class="col text-nowrap">کد تیکت: <span class="ticket-code fw-bolder ticket-data"></span></div>--}}
{{--                            <hr class="col">--}}
{{--                            <div class="col text-nowrap">کد درس: <span class="lesson-code fw-bolder ticket-data"></span></div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-content-center align-items-center text-center">--}}
{{--                            <div class="col text-nowrap">نام درس: <span class="lesson-name fw-bolder ticket-data"></span></div>--}}
{{--                            <hr class="col">--}}
{{--                            <div class="col text-nowrap">نام کاربر: <span class="user-name fw-bolder ticket-data"></span></div>--}}
{{--                        </div>--}}
{{--                        <fieldset class="py-3 px-4 pm-3 mt-4">--}}
{{--                            <legend class="fw-bolder" style="font-size: 18px">شرح درخواست</legend>--}}
{{--                            <p class="description ticket-data px-3"></p>--}}
{{--                        </fieldset>--}}
                        <form class="needs-validation" id="update_work_hour_form" novalidate>
                            <div class="form-group mt-3 mx-2">
                                <label for="modal-date">تاریخ</label>
                                <input id="modal-date" class="form-input flex-group form-control" type="text" name="start" required>

                                <label for="modal-start-time">ساعت ورود</label>
                                <input id="modal-start-time" class="form-input flex-group form-control" type="text" name="start" required>

                                <label for="modal-end-time">ساعت خروج</label>
                                <input id="modal-end-time" class="form-input flex-group form-control" type="text" name="start" required>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="update_work_hour_form" id="edit-btn" data-row-id="" type="submit" class="btn btn-success">ویرایش</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        var work_hours = {
            ...@json($work_hours)
        }.data

        var csrf_token = "{{ csrf_token() }}"

    </script>

    <script type="module" src="{{ asset('js/work_hours/index.js') }}"></script>
@endsection
