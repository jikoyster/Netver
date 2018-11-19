<table id="grid-basic" class="table table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th data-column-id="id">ID</th>
            <th data-column-id="name">Name</th>
            <th data-column-id="link">Link</th>
            <th data-column-id="roles">Roles</th>
            @if(2==2)
                <th data-column-id="groups">Groups</th>
            @endif
            <th data-formatter="commands">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $parent_ids = 'nielito';
            function spacer_($id, $parent_id){
                global $parent_ids;
                
                if($parent_id) {
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    $parent_ids[$id] = $parent_id;
                    spacer_($parent_id,$parent_ids[$parent_id]);
                } else {
                    $parent_ids[$id] = 0;
                }
            }
        ?>
        <?php foreach($menus as $menu) : ?>
            
            <tr>
                <td><?=$menu->id?></td>
                <td>
                    <?php
                        spacer_($menu->id,$menu->parent_id);
                    ?>
                    <?=$menu->name?>
                </td>
                <td><?=$menu->link?></td>
                <td>
                    <?php
                        $menu_roles = $menu->roles()->get();
                        $ctr = $menu->roles()->count();
                        for($a = 0; $a < $ctr; ++$a) :
                    ?>
                        @if($a > 0)
                            <span> / </span>
                        @endif
                        <span><?=ucwords($menu_roles[$a]->name)?></span>
                    <?php endfor; ?>
                </td>
                @if(2==2)
                    <td>
                        <?php
                            $menu_groups = $menu->groups()->get();
                            $ctr = $menu->groups()->count();
                            for($a = 0; $a < $ctr; ++$a) :
                        ?>
                            @if($a > 0)
                                <span> / </span>
                            @endif
                            <span><?=ucwords($menu_groups[$a]->name)?></span>
                        <?php endfor; ?>
                    </td>
                @endif
                <td>loading...</td>
            </tr>
            
        <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript">
    $(function(){
        $("#grid-basic").bootgrid({
            caseSensitive: false,
            rowCount: 50,
            formatters: {
                'commands': function(column, row)
                {
                    return "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/menus/edit-element/" + row.id + "\" data-toggle=\"tooltip\" title=\"Edit\"><span class=\"glyphicon glyphicon-edit\"></span></a> "+"<a class=\"btn btn-xs btn-success command-edit\" href=\"/menus/roles/" + row.id + "\" data-toggle=\"tooltip\" title=\"Menu Roles\">Menu Roles</a> "/*+"<a class=\"btn btn-xs btn-success command-edit\" href=\"/menus/groups/" + row.id + "\" data-toggle=\"tooltip\" title=\"Menu Groups\">Menu Groups</a> "*/+"<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\" data-toggle=\"tooltip\" title=\"Delete\" data-placement=\"right\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                }
            }
        });
    });
</script>