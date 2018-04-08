$(form).on('submit', function () {
    var errors = false;
    var emailReg = /^([a-zA-Z0-9\\.]+)@([a-zA-Z0-9\\-\\_\\.]+)\.([a-zA-Z0-9]+)$/i;

    if($("#name").val() === ""){
        $("#name").after( "<span class='errors'> Missing Name </span> ");
        errors = true;
    }
    if($("#email").val() === ""){
        $("#email").after("<span class='errors'> Missing Email </span>");
        errors = true;
    }else if(!emailReg.test($("#email").val())){
        $("#email").after( "<span class='errors'> Not a valid email </span> ")
        errors = true;
    }

    return !errors;
});

function bs_input_file() {
    $(".input-file").before(
        function() {
            if ( ! $(this).prev().hasClass('input-ghost') ) {
                var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                element.attr("name",$(this).attr("name"));
                element.change(function(){
                    element.next(element).find('input').val((element.val()).split('\\').pop());
                });
                $(this).find("button.btn-choose").click(function(){
                    element.click();
                });
                $(this).find("button.btn-reset").click(function(){
                    element.val(null);
                    $(this).parents(".input-file").find('input').val('');
                });
                $(this).find('input').css("cursor","pointer");
                $(this).find('input').mousedown(function() {
                    $(this).parents('.input-file').prev().click();
                    return false;
                });
                return element;
            }
        }
    );
}
$(function() {
    bs_input_file();
});