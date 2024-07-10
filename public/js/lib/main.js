export function ajax_error(response, code) {
  let errors;
  if (response.errors)
    errors = response.errors;
  const array_errors = [];
  switch (code) {
    case 400:
      $.each(errors, function (key, value) {
        for (let i = 0; i < value.length; i++) {
          array_errors.push(`<li class="list-group-item list-errors-font">${value[i]}</li>`)
        }
      });
      Swal.fire({
        icon: "error",
        title: ` خطا :${code}`,
        html: `
            <ul class="list-group">
            ${array_errors.join('')}
            </ul>`,
        showConfirmButton: true,
        confirmButtonText: "متوجه شدم",
      });
      break;
    case 401:
      showLogin();
      break;
    case 403:
      Swal.fire({
        icon: "error",
        title: ` خطا :${code}`,
        text: `شما دسترسی لازم برای انجام این عملیات را ندارید`,
        showConfirmButton: true,
        confirmButtonText: "متوجه شدم",
      });
      break;
    case 419:
      showLogin()
      break;
    case 422:
      $.each(errors, function (key, value) {
        for (let i = 0; i < value.length; i++) {
          array_errors.push(`<li class="list-group-item list-errors-font">${value[i]}</li>`)
        }
      });
      Swal.fire({
        icon: "error",
        title: ` خطا :${code}`,
        html: `
            <ul class="list-group">
            ${array_errors.join('')}
            </ul>`,
        showConfirmButton: true,
        confirmButtonText: "متوجه شدم",
      });
      break;
    case 500:
      Swal.fire({
        icon: "error",
        title: ` خطا :${code}`,
        text: `خطا ارتباط با سرور(لطفا با پشتیبانی تماس بگیرید)`,
        showConfirmButton: true,
        confirmButtonText: "متوجه شدم",
      });
      break;
    case 503:
      Swal.fire({
        icon: "error",
        title: ` خطا :${code}`,
        text: `خطا ارتباط با سرور(لطفا با پشتیبانی تماس بگیرید)`,
        showConfirmButton: true,
        confirmButtonText: "متوجه شدم",
      });
      break;
    case 504:
      Swal.fire({
        icon: "error",
        title: ` خطا :${code}`,
        text: `خطا ارتباط با سرور(لطفا با پشتیبانی تماس بگیرید)`,
        showConfirmButton: true,
        confirmButtonText: "متوجه شدم",
      });
      break;
    default:
      Swal.fire({
        icon: "error",
        title: `خطا :${code}`,
        text: `عملیات با خطا مواجه شد !`,
        showConfirmButton: true,
        confirmButtonText: "متوجه شدم",
      });
  }
}

// function enable_tooltip_list() {
//   var tooltipTriggerList = [].slice.call(
//     document.querySelectorAll('[data-bs-toggle="tooltip"]')
//   );
//   var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
//     return new bootstrap.Tooltip(tooltipTriggerEl);
//   });
// }
//
// export function set_title_table({ table, text }) {
//   $(`${table}_wrapper .dataTable-title`).text(text);
// }
//
// export function create_table({ selector, title, filter, options, initComplete, order }) {
//   if (filter) {
//     $(`${selector} thead tr`)
//       .clone(true)
//       .addClass('filters')
//       .appendTo(`${selector} thead`);
//   }
//
//   const setOptions = {
//     ...options,
//     orderCellsTop: filter ? true : false,
//     fixedHeader: filter ? true : false,
//     order: order ?? [1, 'desc'],
//     initComplete: function () {
//       var api = this.api();
//       var filterDate = [];
//
//       api.columns()
//         .eq(0)
//         .each(function (colIdx) {
//
//           var cell = $('.filters th').eq(
//             $(api.column(colIdx).header()).index()
//           );
//
//           var title = $(cell).text();
//
//           $(cell).hasClass('filter-text') ? $(cell).html(`<input class="form-control form-control-sm" type="search" ${$(cell).hasClass('filter-placeholder-none') ? '' : `placeholder="جستجو ${title}"`} />`) : false
//
//           if ($(cell).hasClass('filter-date')) {
//             $(cell).html(`<div class="d-flex" col-index ="${colIdx}" ><input class="col form-date-from form-control form-control-sm me-1" type="search" ${$(cell).hasClass('filter-placeholder-none') ? '' : `placeholder="از تاریخ"`} /><input class="col form-date-to form-control form-control-sm ms-1" type="search" ${$(cell).hasClass('filter-placeholder-none') ? '' : `placeholder="تا تاریخ"`} /></div>`)
//
//             filterDate[colIdx] = {
//               from: {
//                 datetime: $(cell).find('input.form-date-from').pDatepicker({
//                   format: "YYYY/MM/DD",
//                   initialValue: false,
//                   autoClose: true,
//                   toolbox: {
//                     calendarSwitch: {
//                       enabled: false
//                     }
//                   },
//                   onSelect: function (unix) {
//                     filterDate[colIdx].from.datetime.touched = true;
//
//                     filterDate[colIdx].to.selector.prop("disabled", false);
//
//                     if (
//                       filterDate[colIdx].from.datetime.getState().selected.unixDate >=
//                       filterDate[colIdx].to.datetime.getState().selected.unixDate
//                     ) {
//                       filterDate[colIdx].to.datetime.setDate(filterDate[colIdx].from.datetime.getState().selected.unixDate);
//                     }
//
//                     if (filterDate[colIdx].to.datetime && filterDate[colIdx].to.datetime.options && filterDate[colIdx].to.datetime.options.minDate != unix) {
//                       let cachedValue = filterDate[colIdx].to.datetime.getState().selected.unixDate;
//
//                       filterDate[colIdx].to.datetime.options = { minDate: unix };
//
//                       if (filterDate[colIdx].from.datetime.touched) {
//                         filterDate[colIdx].to.datetime.setDate(cachedValue);
//                       }
//                     }
//
//                     if (!(filterDate[colIdx].from.selector.val() == "" ^ filterDate[colIdx].to.selector.val() == "")) {
//                       const sendDate = `${moment(filterDate[colIdx].from.datetime.getState().selected.unixDate).format('YYYY-MM-DD')}&${moment(filterDate[colIdx].to.datetime.getState().selected.unixDate).format('YYYY-MM-DD')}`
//
//                       api.column(colIdx)
//                         .search(sendDate)
//                         .draw();
//                     }
//
//                     if (filterDate[colIdx].to.selector.val() != '') filterDate[colIdx].to.selector.val(moment(filterDate[colIdx].to.datetime.getState().selected.unixDate).format('jYYYY/jMM/jDD'))
//                   }
//                 }),
//                 selector: $(cell).find('input.form-date-from')
//               },
//               to: {
//                 datetime: $(cell).find('input.form-date-to').prop('disabled', true).pDatepicker({
//                   format: "YYYY/MM/DD",
//                   initialValue: false,
//                   autoClose: true,
//                   toolbox: {
//                     calendarSwitch: {
//                       enabled: false
//                     }
//                   },
//                   onSelect: function (unix) {
//                     filterDate[colIdx].to.datetime.touched = true;
//
//                     if (!(filterDate[colIdx].from.selector.val() == "" ^ filterDate[colIdx].to.selector.val() == "")) {
//                       const sendDate = `${moment(filterDate[colIdx].from.datetime.getState().selected.unixDate).format('YYYY-MM-DD')}&${moment(filterDate[colIdx].to.datetime.getState().selected.unixDate).format('YYYY-MM-DD')}`
//
//                       api.column(colIdx)
//                         .search(sendDate)
//                         .draw();
//                     }
//
//                     if (filterDate[colIdx].from.selector.val() != '') filterDate[colIdx].from.selector.val(moment(filterDate[colIdx].from.datetime.getState().selected.unixDate).format('jYYYY/jMM/jDD'))
//                   }
//                 }),
//                 selector: $(cell).find('input.form-date-to')
//               }
//             }
//
//             $(cell).find('input.form-date-from').on('input', function () {
//               if ($(this).val() == '') {
//                 $(cell).find('input.form-date-to').val('')
//                 $(cell).find('input.form-date-to').prop('disabled', true)
//                 api.column(colIdx)
//                   .search('')
//                   .draw();
//               }
//             })
//           }
//
//           if ($(cell).hasClass('filter-select')) {
//             let content = `<select class="form-select form-select-sm">`
//             content += `<option value="-1">انتخاب ${title}</option>`
//             for (let index = 0; index < $(cell).data('selectValue').length; index++) {
//               const name = $(cell).data('selectName')[index]
//               const value = $(cell).data('selectValue')[index]
//               content += `<option value="${value}">${name}</option>`
//             }
//             content += `</select>`
//             $(cell).html(content)
//           }
//
//           $('select', $('.filters th').eq($(api.column(colIdx).header()).index())).on('change', function (e) {
//             e.stopPropagation();
//             const value = this.value != -1 ? this.value : ''
//             console.log(this.value);
//
//             api.column(colIdx).search(value).draw()
//           });
//
//           $('input', $('.filters th').eq($(api.column(colIdx).header()).index())).on('input', function (e) {
//             e.stopPropagation();
//
//             if ($(this).parents('.filter-date').length != 0) return false
//
//             $(this).attr('title', $(this).val());
//
//             var cursorPosition = this.selectionStart;
//
//             api.column(colIdx).search(this.value).draw()
//
//             $(this).focus()[0].setSelectionRange(cursorPosition, cursorPosition);
//           });
//         });
//
//       $('.filter-none').each(function (index, element) {
//         $(element).parents('tr').hasClass('filters') ? $(element).remove() : $(element).attr('rowspan', 2)
//       })
//
//       var tooltipTriggerListDataTable = [].slice.call(
//         document.querySelectorAll('table.dataTable [data-bs-toggle="tooltip"]')
//       );
//       var tooltipListDataTable = tooltipTriggerListDataTable.map(function (tooltipTriggerEl) {
//         return new bootstrap.Tooltip(tooltipTriggerEl);
//       });
//
//       if (typeof initComplete !== "undefined") {
//         if (typeof initComplete === "function") {
//           initComplete.call()
//         } else {
//           console.error('initComplete is function()')
//         }
//       }
//     },
//   }
//
//
//   const table = $(selector).DataTable(setOptions);
//
//   $(`${selector}_wrapper .dataTable-title`).text(title);
//
//   return table;
// }
// $(document).on("click", "#reset_pass", function () {
//   reset_form_validation();
//   const modal = $("#reset_pass_modal");
//   modal.find(".pass-input").attr("type", "password");
//   modal.find(".eye-pass i").removeClass("fa-eye").addClass("fa-eye-slash");
//   $(".input-cleaner").val("");
//   modal.modal("show");
// });
//
// $("#change_pass_form").submit(function (e) {
//   const modal = $("#reset_pass_modal");
//   e.preventDefault();
//   if ($("#reset_pass_modal").find("input").length != $("#reset_pass_modal").find("input.is-valid").length) return false;
//   else {
//     const modal = $("#reset_pass_modal");
//     let formData = new FormData();
//     const current_password = $("#password_last").val();
//     const new_password = $("#pasword_new").val();
//     const new_password_confirmation = $("#password_confirmation").val();
//     formData.append("current_password", current_password);
//     formData.append("new_password", new_password);
//     formData.append("new_password_confirmation", new_password_confirmation);
//
//     $.ajax({
//       url: 'https://sbu-ticket.ir/password/reset',
//       type: "POST",
//       headers: {
//         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//       },
//       data: formData,
//       cache: false,
//       contentType: false,
//       processData: false,
//       beforeSend: function () {
//         showLoaderScreen();
//       },
//       success: function (result) {
//         hideLoaderScreen();
//         modal.modal("hide");
//         Swal.fire({
//           icon: "success",
//           text: `تغییر رمز با موفقیت انجام شد`,
//           showConfirmButton: false,
//           timer: 1500
//         });
//
//       },
//       error: function (request) {
//         console.log(request.responseJSON);
//         ajax_error(request.responseJSON, request.status);
//         modal.find("button[type='submit']").prop("disabled", false);
//       },
//       complete: function (data) {
//         hideLoaderScreen();
//         modal.find("button[type='submit']").prop("disabled", false);
//       },
//     });
//   }
// });
//
// $(document).on("click", "#edit_profile", function () {
//   reset_form_validation();
//   const modal = $("#edit_profile_modal");
//   $(".input-cleaner").val("");
//   $.ajax({
//     url: 'https://sbu-ticket.ir/show',
//     type: "GET",
//     headers: {
//       "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//     },
//     beforeSend: function () {
//       showLoaderScreen();
//     },
//     success: function (result) {
//         hideLoaderScreen();
//         modal.modal("show");
//         $("#first_name_ep").val(result.data.first_name);
//         $("#last_name_ep").val(result.data.last_name);
//         $("#email_ep").val(result.data.email);
//         $("#national_code_ep").val(result.data.national_code);
//         $("#faculty_ep").val(result.data.faculty);
//         $("#phone_number_ep").val(result.data.phone_number);
//     },
//     error: function (request) {
//       hideLoaderScreen();
//       ajax_error(request.responseJSON , request.status);
//     },
//   });
// });
// $("#edit_profile_form").submit(function (e) {
//   const modal = $("#edit_profile_modal");
//   e.preventDefault();
//   if ($("#edit_profile_modal").find("input").length != $("#edit_profile_modal").find("input.is-valid").length) return false;
//   else {
//     const first_name = $("#first_name_ep").val();
//     const last_name = $("#last_name_ep").val();
//     const email = $("#email_ep").val();
//     const national_code = $("#national_code_ep").val();
//     const faculty = $("#faculty_ep").val();
//     const phone_number = $("#phone_number_ep").val();
//     let formData = new FormData();
//     formData.append("first_name", first_name);
//     formData.append("last_name", last_name);
//     formData.append("email", email);
//     formData.append("national_code", national_code);
//     formData.append("faculty", faculty);
//     formData.append("phone_number", phone_number);
//     $.ajax({
//       url: 'https://sbu-ticket.ir/profile/update',
//       type: "POST",
//       headers: {
//         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//       },
//       data: formData,
//       cache: false,
//       contentType: false,
//       processData: false,
//       beforeSend: function () {
//         showLoaderScreen();
//       },
//       success: function (result) {
//         hideLoaderScreen();
//         modal.modal("hide");
//         Swal.fire({
//           icon: "success",
//           text: `ویرایش اطلاعات کاربری با موفقیت انجام شد`,
//           showConfirmButton: false,
//           timer: 1500
//         }).then(function() {
//           user_data();
//         });
//
//       },
//       error: function (request) {
//         console.log(request.responseJSON);
//       ajax_error(request.responseJSON, request.status);
//       modal.find("button[type='submit']").prop("disabled", false);
//       },
//       complete: function (data) {
//         hideLoaderScreen();
//         modal.find("button[type='submit']").prop("disabled", false);
//       },
//     });
//   }
// });
