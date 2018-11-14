
	<div class="row" style="margin-bottom: 30px;">
        <form class="form-horizontal" method="POST" action="{{ route('menu.save-element',Request::segment(3)) }}">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 text-center text-white" style="margin: 0 auto; float: unset;">
                    <h3><strong>Add Menu Element</strong></h3>
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

            <div class="parent_id-container form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
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

            <div class="link-container form-group{{ $errors->has('link') ? ' has-error' : '' }}" style="display: {{old('has_children') ? 'none':'block'}};">
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

            <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                <label for="order" class="col-md-4 col-sm-4 col-xs-4 control-label text-right text-white">Order</label>

                <div class="col-md-1 col-sm-1 col-xs-1 pull-left text-center" style="margin: 0 auto; float: unset;">
                    <input type="text" class="form-control" id="order" name="order" style="margin: 0 auto; float: unset;" value="{{old('order')}}">

                    @if ($errors->has('order'))
                        <span class="help-block">
                            <strong>{{ $errors->first('order') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-3 col-sm-3 col-xs-3 text-center" style="margin: 0 auto;">
                    <label for="has_children" class="col-md-10 col-sm-10 col-xs-10 control-label text-right text-white">Has Children</label>
                    <input type="checkbox" class="form-control pull-right" id="has_children" name="has_children" {{old('has_children') ? 'checked':''}} style="margin: 7px auto 0; width: 20px; height: 20px;">

                    @if ($errors->has('has_children'))
                        <span class="help-block">
                            <strong>{{ $errors->first('has_children') }}</strong>
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
