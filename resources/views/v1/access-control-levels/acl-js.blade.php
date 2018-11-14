<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $('[data-toggle="tooltip"]').tooltip();

        $('[name=role_id]').change(function(){
            if($(this).val()) {
                getRolePermissions($(this).val());
            } else {
                getPermissions(1);
            }
        });
        let getRolePermissions = function(val) {
            $.get( "<?=route('role.permissions',[''])?>/"+val+"/"+true, function( data ) {
                let option = "";
                for(var a = 0; a < data.permissions.length; a++) {
                    checked = 0;
                    option += '<div for="permissions" class="col-md-4 col-sm-4 col-xs-4 text-right text-white">';
                    for(var b = 0; b < data.rolePermissions.length; b++) {
                        if(data.permissions[a].id == data.rolePermissions[b].id)
                            checked = data.permissions[a].id;
                    }
                    if(checked == data.permissions[a].id)
                        option += '<input type="checkbox" class="form-control pull-right" id="permissions" name="permissions['+a+']" value="'+data.permissions[a].id+'" style="margin: 7px auto 0; width: 20px; height: 20px;" checked onclick="return false">';
                    else
                        option += '<input type="checkbox" class="form-control pull-right" id="permissions" name="permissions['+a+']" value="'+data.permissions[a].id+'" style="margin: 7px auto 0; width: 20px; height: 20px;" onclick="return false">';
                    option += '</div>';
                    option += '<label for="permissions" class="col-md-8 col-sm-8 col-xs-8 text-left text-white" style="margin: 4px 0;">'+data.permissions[a].name+'</label>';
                }
                $('.permissions-container').html(option);
            });
        }
        let getPermissions = function(val) {
            $.get( "<?=route('role.permissions',[''])?>/1/"+true, function( data ) {
                let option = "";
                for(var a = 0; a < data.permissions.length; a++) {
                    checked = 0;
                    option += '<div for="permissions" class="col-md-4 col-sm-4 col-xs-4 text-right text-white">';
                    option += '<input type="checkbox" class="form-control pull-right" id="permissions" name="permissions['+a+']" value="'+data.permissions[a].id+'" style="margin: 7px auto 0; width: 20px; height: 20px;" onclick="return false">';
                    option += '</div>';
                    option += '<label for="permissions" class="col-md-8 col-sm-8 col-xs-8 text-left text-white" style="margin: 4px 0;">'+data.permissions[a].name+'</label>';
                }
                $('.permissions-container').html(option);
            });
        }
        $('[name=role_id]').change();
    });
</script>