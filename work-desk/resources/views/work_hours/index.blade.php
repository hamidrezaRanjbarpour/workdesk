@extends('base')

@section('title', 'ساعات کاری')
@section('css')
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container mt-5">
        <h5> لیست ساعات کاری شرکت {{$company->name}} </h5>

{{--        <form action="{{ route('working_hours.index', $company->id) }}" method="GET">--}}
            <div class="d-flex justify-content-end">

                <div class="col-lg-3 col-sm-6 d-flex flex-row align-items-end">

                    <div class="">
                        <label for="select_month">ماه</label>
                        <select id="select_month" class="form-select" aria-label="Default select example">
                            <option value="0">همه</option>
                            <option value="1">فروردین</option>
                            <option value="2">اردیبهشت</option>
                            <option value="3">خرداد</option>
                            <option value="4">تیر</option>
                            <option value="5">مرداد</option>
                            <option value="6">شهریور</option>
                            <option value="7">مهر</option>
                            <option value="8">آبان</option>
                            <option value="9">آذر</option>
                            <option value="10">دی</option>
                            <option value="11">بهمن</option>
                            <option value="12">اسفند</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="select_year">سال</label>
                        <select id="select_year" class="form-select"
                                aria-label="Default select example">
                            <option value="0">همه</option>
                            <option value="1400">1400</option>
                            <option value="1401">1401</option>
                        </select>
                    </div>

                    <div class="">
                        <button type="button" id="date-filter" class="btn btn-primary">اعمال</button>
                    </div>
                </div>
            </div>
        </form>

        <div>تعداد روزهای فعالیت: <span>{{ $number_of_working_days }}</span></div>
        <div>مجموع ساعات فعالیت: <span>{{ $total_activity_duration }}</span></div>

        <table class="table table-hover mt-5 my-table">
            <thead>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">روز</th>
                <th scope="col">تاریخ</th>
                <th scope="col">ساعت ورود</th>
                <th scope="col">ساعت خروج</th>
                <th scope="col">تعداد ساعت فعالیت</th>
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
                        <form class="needs-validation" id="update_work_hour_form" novalidate>
                            <div class="form-group mt-3 mx-2">
                                <div>
                                    <label for="modal-date">تاریخ</label>
                                    <input id="modal-date" class="form-input flex-group form-control" type="text"
                                           name="start" required>
                                </div>
                                <div>
                                    <label for="modal-start-time">ساعت ورود</label>
                                    <input id="modal-start-time" class="form-input flex-group form-control" type="text"
                                           name="start" required>
                                    <button type="button" class="btn date-btn btn-outline-secondary">الان!</button>
                                </div>
                                <div>
                                    <label for="modal-end-time">ساعت خروج</label>
                                    <input id="modal-end-time" class="form-input flex-group form-control" type="text"
                                           name="start" required>
                                    <button type="button" class="btn date-btn btn-outline-secondary">الان!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="update_work_hour_form" id="edit-btn" data-row-id="" type="submit"
                                class="btn btn-success">ویرایش
                        </button>
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

        var month_filtered = @json($month_filtered);
        var year_filtered = @json($year_filtered);

        var csrf_token = "{{ csrf_token() }}"

    </script>

    <script type="module" src="{{ asset('js/work_hours/index.js') }}"></script>
@endsection
