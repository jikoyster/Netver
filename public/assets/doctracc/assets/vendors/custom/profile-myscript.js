$(function(){
    $("#userProfileForm").submit(function(e){
        e.preventDefault();

        $(this).ajaxSubmit({
            type: 'GET',
            url: '/profile/saveUser',
            data: $(this).serialize(),
            datatype: JSON,
            success: function(e,t,r,s){
                $("#userProfileForm").find('.alert')
                        .removeClass('m--hide')
                        .addClass('alert-success m--show');
                $("#userProfileForm").find('.alert')
                        .find('.message')
                        .text('Well Done! User Profile has been updated.');
            },
            error: function(){
                
            }
        });
    });
});