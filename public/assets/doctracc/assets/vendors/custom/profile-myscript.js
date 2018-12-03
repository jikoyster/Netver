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
    }); //end #userProfileForm
/******************************************************* */
    $("#changePasswordButton").click(function(e){
        e.preventDefault();
        
        var a = $(this), b = $(this).closest('form');
        // b.preventDefault();
        b.validate({
            rules: {
                old_password: { required: true },
                new_password: { required: true },
                rpassword: { required: true, equalTo: new_password }
            }
        });
        if(b.valid()){
            b.ajaxSubmit({
                type: 'GET',
                url: '/profile/changePassword',
                data: b.serialize(),
                datatype: JSON,
                success: function(e,t,r,s){
                    if( e == "success" ){
                        $("#changePasswordForm").find('.alert')
                            .removeClass('alert-danger m--hide')
                            .addClass('alert-success m--show');
                        $("#changePasswordForm").find('.alert')
                                .find('.message')
                                .text('Well Done! User Profile has been updated.');
                        b[0].reset();
                    }else{
                        $("#changePasswordForm").find('.alert')
                            .removeClass('alert-success m--hide')
                            .addClass('alert-danger m--show');
                        $("#changePasswordForm").find('.alert')
                                .find('.message')
                                .text('Current password is invalid');
                    }
                },
                error: function(){
                    
                }
            }); // ajaxSubmit
        }// end if
        
    }); //end #userProfileForm
});