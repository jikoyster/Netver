
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('menu.save') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Menu</strong></h3>
                </div>
            </div>

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Name</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="name" name="name" style="margin: 0 auto; float: unset;" value="{{old('name')}}">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="group_id-container form-group{{ $errors->has('group_id') ? ' has-error' : '' }}">
                <label for="group_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Group</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="group_id" name="group_id">
                        <option value="">System Admin</option>
                        <?php foreach($groups as $group) : ?>
                            <option value="<?=$group->id?>" {{old('group_id') == $group->id ? 'selected':''}}><?=$group->name?></option>
                        <?php endforeach; ?>
                    </select>

                    @if ($errors->has('group_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('group_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('has_children') ? ' has-error' : '' }}">
                <label for="has_children" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Has Children</label>

                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <input type="checkbox" class="form-control pull-left" id="has_children" name="has_children" {{old('link') ? '':'checked'}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('has_children'))
                        <span class="help-block">
                            <strong>{{ $errors->first('has_children') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="link-container form-group{{ $errors->has('link') ? ' has-error' : '' }}" style="display: {{old('link') ? 'block':'none'}};">
                <label for="link" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Link</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="link" name="link" style="margin: 0 auto; float: unset;" value="{{old('link')}}">

                    @if ($errors->has('link'))
                        <span class="help-block">
                            <strong>{{ $errors->first('link') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            @if(count($menus) && $menus->where('has_children',1)->count())
            <div class="form-group{{ $errors->has('has_parent') ? ' has-error' : '' }}">
                <label for="has_parent" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Has Parent</label>

                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <input type="checkbox" class="form-control pull-left" id="has_parent" name="has_parent" {{old('has_parent') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('has_parent'))
                        <span class="help-block">
                            <strong>{{ $errors->first('has_parent') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            @endif

            <div class="parent_id-container form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}" style="display: {{old('has_parent') ? 'block':'none'}};">
                <label for="parent_id" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Parent</label>

                <div class="col-md-4 col-sm-4 col-xs-4 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">Select</option>
                        <?php foreach($parents as $parent) : ?>
                            <option value="<?=$parent->id?>" {{old('parent_id') == $parent->id ? 'selected':''}}><?=$parent->name?></option>
                        <?php endforeach; ?>
                    </select>

                    @if ($errors->has('parent_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('parent_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
            	<div class="col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-md-4 col-sm-4 col-xs-4 text-center" style="margin: 0 auto; float: unset;">
                    <button type="submit" class="btn pull-right col-md-4 col-sm-4 col-xs-4" style="margin: 0 auto; float: unset;">
                        <strong>Add</strong>
                    </button>
                    <button type="button" data-dismiss="modal" class="btn yellow-gradient pull-right" style="margin: 0 7px; float: unset;">
                        <strong>Back</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
