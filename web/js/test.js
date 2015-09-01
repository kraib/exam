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
           getView(response.id);
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




function getView(qn_id){
    var data;
    $.ajax({
        url: keywords_url+'&id='+qn_id,
        cache: false
    })
        .done(function( html ) {
            $('#modal_question .modal-body').html(html);
        });
}
