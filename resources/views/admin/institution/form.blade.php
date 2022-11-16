@extends('layouts.backend.index')
@section('content')
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.institutions') }}">Institutions Management</a></li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
        <h1 class="page-title">Add/Edit Institution</h1>
    </div>

    <div class="page-content">

        <div class="panel">
            <div class="panel-body">
                <form method="POST" action="{{ route('admin.saveInstitution') }}" id="institutionForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="institution_id" value="{{ $institution->id }}">
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label class="form-control-label">Type</label>
                            <input type="text" class="form-control" name="type"
                                   placeholder="Type" value="{{ $institution->type }}" />
                            @if ($errors->has('type'))
                                <label class="error" for="type">{{ $errors->first('type') }}</label>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label class="form-control-label">Name</label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="Institution Name" value="{{ $institution->name }}" />
                            @if ($errors->has('name'))
                                <label class="error" for="name">{{ $errors->first('name') }}</label>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label class="form-control-label">Contact Email</label>
                            <input type="text" class="form-control" name="contact"
                                   placeholder="Contact Email" value="{{ $institution->contact }}" />
                            @if ($errors->has('contact'))
                                <label class="error" for="contact">{{ $errors->first('contact') }}</label>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label class="form-control-label">Status</label>
                            <div>
                                <div class="radio-custom radio-default radio-inline">
                                    <input type="radio" id="inputBasicActive" name="is_active" value="0" />
                                    <label for="inputBasicActive">Active</label>
                                </div>
                                <div class="radio-custom radio-default radio-inline">
                                    <input type="radio" id="inputBasicInactive" name="is_active" value="0" />
                                    <label for="inputBasicInactive">Inactive</label>
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
            $("#institutionForm").validate({
                rules: {
                    type: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    contact: {
                        required: true
                    }
                },
                messages: {
                    type: {
                        required: 'The type field is required.'
                    },
                    name: {
                        required: 'The name field is required.'
                    },
                    contact: {
                        required: 'The contact field is required.'
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