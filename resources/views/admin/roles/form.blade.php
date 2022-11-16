@extends('layouts.backend.index')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">User Roles</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
        <h1 class="page-title">Add/Edit User Role</h1>
    </div>

    <div class="page-content">

        <div class="panel">
            <div class="panel-body">
                <form method="POST" action="{{ route('admin.saveRole') }}" id="roleForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label class="form-control-label">Name</label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="Name" value="{{ $role->name }}" />
                            @if ($errors->has('name'))
                                <label class="error" for="name">{{ $errors->first('name') }}</label>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label class="form-control-label">Description</label>
                            <input type="text" class="form-control" name="description"
                                   placeholder="Description" value="{{ $role->description }}" />
                            @if ($errors->has('description'))
                                <label class="error" for="description">{{ $errors->first('description') }}</label>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label class="form-control-label">Status</label>
                            <div>
                                <div class="radio-custom radio-default radio-inline">
                                    <input type="radio" id="inputBasicActive" name="is_active" value="1" @if($role->is_active) checked @endif />
                                    <label for="inputBasicActive">Active</label>
                                </div>
                                <div class="radio-custom radio-default radio-inline">
                                    <input type="radio" id="inputBasicInactive" name="is_active" value="0" @if(!$role->is_active) checked @endif />
                                    <label for="inputBasicInactive">Inactive</label>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group col-md-12">
                            <label class="form-control-label">Add/Remove Permissions</label>
                            <div style="display: flex; flex-direction: column">
                                <div class="checkbox-custom checkbox-default">
                                    <input type="checkbox" id="inputBasicActive" name="is_active" value="0" />
                                    <label for="inputBasicActive">Permission 1</label>
                                </div>
                                <div class="checkbox-custom checkbox-default">
                                    <input type="checkbox" id="inputBasicInactive" name="is_active" value="0" />
                                    <label for="inputBasicInactive">Permission 2</label>
                                </div>
                                <div class="checkbox-custom checkbox-default">
                                    <input type="checkbox" id="inputBasicActive" name="is_active" value="0" />
                                    <label for="inputBasicActive">Permission 3</label>
                                </div>
                                <div class="checkbox-custom checkbox-default">
                                    <input type="checkbox" id="inputBasicInactive" name="is_active" value="0" />
                                    <label for="inputBasicInactive">Permission 4</label>
                                </div>
                                <div class="checkbox-custom checkbox-default">
                                    <input type="checkbox" id="inputBasicActive" name="is_active" value="0" />
                                    <label for="inputBasicActive">Permission 5</label>
                                </div>
                                <div class="checkbox-custom checkbox-default">
                                    <input type="checkbox" id="inputBasicInactive" name="is_active" value="0" />
                                    <label for="inputBasicInactive">Permission 6</label>
                                </div>
                                <div class="checkbox-custom checkbox-default">
                                    <input type="checkbox" id="inputBasicActive" name="is_active" value="0" />
                                    <label for="inputBasicActive">Permission 7</label>
                                </div>
                                <div class="checkbox-custom checkbox-default">
                                    <input type="checkbox" id="inputBasicInactive" name="is_active" value="0" />
                                    <label for="inputBasicInactive">Permission 8</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default btn-outline">Reset</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>


        <!-- End Panel Basic -->
    </div>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function()
        {
            $("#roleForm").validate({
                rules: {
                    name: {
                        required: true
                    },
                    description: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: 'The name field is required.'
                    },
                    description: {
                        required: 'The description field is required.'
                    }
                },
                errorPlacement: function(error, element) {
                    if(element.attr("name") == "roles[]") {
                        error.appendTo("#role-div-error");
                    }else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>
@endsection