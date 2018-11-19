<table id="grid-basic" class="table table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th data-column-id="id">ID</th>
            <th data-column-id="name">Name</th>
            <th data-column-id="groups">Groups</th>
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
                    <?=($ctr < 1) ? 'System Admin':''?>
                </td>
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
                    varEdit = '';
                    varDelete = '';
                    @can('edit')
                        varEdit = "<a class=\"btn btn-xs btn-primary command-edit\" href=\"/menus/edit/" + row.id + "\" data-toggle=\"tooltip\" title=\"Edit\"><span class=\"glyphicon glyphicon-edit\"></span></a> ";
                    @endcan
                    @can('delete')
                        varDelete = "<button class=\"btn btn-xs btn-danger command-delete\" onclick=\"confirmModal(this)\" data-toggle=\"modal\" data-target=\".bs-example-modal-sm"+row.id+"\" data-toggle=\"tooltip\" title=\"Delete\" data-placement=\"right\"><span class=\"glyphicon glyphicon-trash\"></span></button>";
                    @endcan
                    return "<a class=\"btn btn-xs command-view\" href=\"/menus/menu-elements/" + row.id + "\" data-toggle=\"tooltip\" title=\"Menu Elements\"><span class=\"glyphicon glyphicon-eye-open\"></span></a> "+varEdit+varDelete;
                }
            }
        });
    });
</script>