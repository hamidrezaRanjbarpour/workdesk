import {ajax_error} from '../lib/main.js'
import {setNowTime} from './create.js'

$(document).ready(function () {

    let table = $('#table-body')

    console.log(work_hours)

    for (let i = 0; i < work_hours.length; i++) {
        let row = $(`<tr id="${work_hours[i].id}"></tr>`)

        if(i % 2 == 0)
            row.attr('class', 'table-light')

        row.append('<td class="wk-idx">' + (i + 1) + '</td>');

        let dayOfWeek = work_hours[i].start ? getDayOfWeek(work_hours[i].start) : '-'
        row.append(`<td>${dayOfWeek}</td>`);

        let date = work_hours[i].start ? moment(work_hours[i].start).format('jYYYY/jM/jD') : '-'
        row.append(`<td class="wk-date">${date}</td>`);

        let start_time = work_hours[i].start ? moment(work_hours[i].start).format('HH:mm') : '-'
        row.append(`<td class="wk-start">${start_time}</td>`);

        let end_time = work_hours[i].end ? moment(work_hours[i].end).format('HH:mm') : '-'
        row.append(`<td class="wk-end">${end_time}</td>`);

        let activity_duration = work_hours[i].activity_duration ? moment(work_hours[i].activity_duration, 'HH:mm:ss').format('HH:mm') : '-'
        row.append(`<td>${activity_duration}</td>`);

        let updated_at = moment(work_hours[i].updated_at).format('HH:mm:ss | jYYYY/jMM/jDD');
        row.append(`<td>${updated_at}</td>`)

        row.append(`<td><button type='submit' class='btn btn-outline-primary update-hour'>ویرایش</button> ` +
                   `<button type="button" class="btn btn-outline-danger delete-hour">حذف</button></td>`)

        table.append(row)
    }

    $('.work_day').text(function (_, oldData) {
        return getDayOfWeek(oldData)
    });

    setNowTime('HH:mm')

});

$(document).on('click', '.delete-hour', function (){
    let id = $(this).closest('tr').attr('id')

    Swal.fire({
        icon: 'warning',
        title: 'آیا از حذف مطمئن هستید؟',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بله، حذف شود.',
        cancelButtonText: 'منصرف شدم',
        preConfirm: function (){
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : csrf_token
                }
            });

            $.ajax({
                url: `/working_hours/delete/${id}`,
                type: "DELETE",
                success: function () {
                    location.reload()
                },
                error: function (response) {
                    ajax_error(response, response.status)
                },
            })
        },

    })
})

$(document).on('click', '.update-hour', function (){
    let id = $(this).closest('tr').attr('id')
    let date = $(this).closest('tr').find('.wk-date').text()
    let start = $(this).closest('tr').find('.wk-start').text()
    let end = $(this).closest('tr').find('.wk-end').text()

    // console.log({date:date, start:start, end:end})

    $('#modal-date').val(date)
    $('#modal-start-time').val(start)
    $('#modal-end-time').val(end)

    const modal = $('#update_work_hour_modal')

    modal.find('#edit-btn').attr('data-row-id', id)
    modal.modal('show')
})

$('#update_work_hour_form').submit(function (event){
    event.preventDefault()

    let modal = $('#update_work_hour_modal')
    let id = modal.find('#edit-btn').attr('data-row-id')
    let formData = new FormData()
    let date = $('#modal-date').val()
    let startDate = moment(date, 'jYYYY/jM/jD').format('YYYY-MM-DD') + ' ' + $('#modal-start-time').val()
    if($('#modal-end-time').val() != '-' && $('#modal-end-time').val().length != 0) {
        let endDate = moment(date, 'jYYYY/jM/jD').format('YYYY-MM-DD') + ' ' + $('#modal-end-time').val()
        formData.append('end', endDate)
    }

    console.log(id)

    formData.append('start', startDate)

    $.ajax({
        url: `/working_hours/update/${id}`,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        success: function () {
            Swal.fire({
                icon: "success",
                // title: "انجام شد",
                text: "به روز رسانی با موفقیت انجام شد!",
                showConfirmButton: false,
                timer: 1500,
            })
            location.reload()
        },
        error: function (response) {
            ajax_error(response, response.status)
        },
    })

})

function getDayOfWeek(date) {

    let day = moment(date).day()
    let result = ''
    switch (day) {
        case 0:
            result = 'یکشنبه'
            break
        case 1:
            result = 'دوشنبه'
            break
        case 2:
            result = 'سه شنبه'
            break
        case 3:
            result = 'چهارشنبه'
            break
        case 4:
            result = 'پنج شنبه'
            break
        case 5:
            result = 'جمعه'
            break
        default:
            result = 'شنبه'
            break
    }

    return result
}

