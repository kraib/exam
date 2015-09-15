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
            var keyword = $('#questionkeywords-keyword').val();
            var marks = $('#questionkeywords-marks').val();

            $('.keywords-list').append('<li>'+keyword+' - '+ marks + 'Marks'+ '</li>');

            form.trigger('reset');
            $('.msg p').html('Keyword added Successfully');
            $('.msg').removeClass('hidden');


        }
    });
    return false;

});



