
$('body').on('keypress', '.onlyNumber', function(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
});

$('body').on('click', '.pwd-toggle', function() {
    if($(this).closest('.form-group').find('.password').attr('type') == 'password') {
        $(this).closest('.form-group').find('.password').attr('type', 'text');
        $(this).find('.fa').addClass('fa-eye').removeClass('fa-eye-slash');
    } else {
        $(this).closest('.form-group').find('.password').attr('type', 'password');
        $(this).find('.fa').addClass('fa-eye-slash').removeClass('fa-eye');
    }
});