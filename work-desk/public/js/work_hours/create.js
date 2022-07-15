let dateButtons = document.querySelectorAll('.date-btn');

dateButtons.forEach(function (button){
    button.addEventListener('click', function (){
        let inputNode = button.previousElementSibling;
        inputNode.value = moment().format('YYYY-MM-DD HH:mm:ss');
    })
})

$(function (){
    $.ajax({
        url: "/companies/all",
        type: "GET",
        success: function (response) {
            $.each(response.data,function(index, item){
                $("#company_name").append('<option value=' + item.id + '>' + item.name + '</option>');
            });

            // $("#full_name").text(result.data.full_name);
            // $("#national_code").text(result.data.national_code);
            // $("#created_at").text(moment(result.data.created_at).format('HH:mm:ss | jYYYY/jMM/jDD'));
            // $("#faculty").text(result.data.faculty);
            // $("#email").text(result.data.email);
        },
        error: function (response) {
            console.log(response.responseJSON)
        },
    })
})

$(function () {

})
