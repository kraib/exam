$(document).ready(function(){
    getTestQuestionView();
    var timer = setInterval(function () {
        getTestQuestionView();
    }, 1000000);

});


$('#test-qns').on('click', '.keyword-delete', function(event){

    var result = confirm("Are you sure you want to delete?");
    if (result) {
        var url = $(this).attr("href");
        $.post( url, { id:$(this).data('id') } );
    }

    return false;
});


$('body').on('beforeSubmit', 'form#question-create', function () {
    var form = $(this);
// return false if form still have some validation errors
    if (form.find('.has-error').length) {
        return false;
    }
// submit form
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function (response) {
           getKeywordView(response.id);
        }
    });
    return false;

});



$('body').on('beforeSubmit', 'form#question-key-create', function () {
    var form = $(this);
// return false if form still have some validation errors
    if (form.find('.has-error').length) {
        return false;
    }
// submit form
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function (response) {

        }
    });
    return false;

});




function getKeywordView(qn_id){
    var data;
    $.ajax({
        url: keywords_url+'&id='+qn_id,
        cache: false
    })
        .done(function( html ) {
            $('#modal_question .modal-body').html(html);
            $('#model_question .modal-header h4').remove();
        });
}


function getTestQuestionView(){
    var test_id = $('#test-id').val();
    var data;
    $.ajax({
        url: tests_qns_url+'&id='+test_id,
        cache: false
    })
        .done(function( html ) {
            $('#test-qns').html(html);

        });
}