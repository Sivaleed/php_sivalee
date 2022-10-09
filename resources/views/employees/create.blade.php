@extends('employees.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add Sales Representative</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('employees.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Full Name:</strong>
                <input type="text" name="emp_name" class="form-control" value="{{ old('emp_name') }}" placeholder="Name">
            </div>
            <div class="form-group">
                <strong>Email Address:</strong>
                <input type="text" name="emp_email" class="form-control" value="{{ old('emp_email') }}" placeholder="Email">
            </div>
            <div class="form-group">
                <strong>Telephone:</strong>
                <input type="text" name="emp_phone" maxlength="10" class="form-control" value="{{ old('emp_phone') }}" placeholder="Phone">
            </div>
            <div class="form-group">
                <strong>Joined Date:</strong>
                <input type="text" name="emp_joined_at" id="emp_joined_at" value="{{ old('emp_joined_at') }}" class="form-control">
            </div>
            <div class="form-group">
                <strong>Current Routes:</strong>
                <select name="emp_route">
                    <option value="">Select Route</option>
                    <option value="Barnes Place" {{ (old("emp_route") == "Barnes Place") ? "selected" : "" }}>Barnes Place</option>
                    <option value="Rosmid Place" {{ (old("emp_route") == "Rosmid Place") ? "selected" : "" }}>Rosmid Place</option>
                    <option value="Cambridge Place" {{ (old("emp_route") == "Cambridge Place") ? "selected" : "" }}>Cambridge Place</option>
                    <option value="Gregory Road" {{ (old("emp_route") == "Gregory Road") ? "selected" : "" }}>Gregory Road</option>
                </select>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Comment:</strong>
                <textarea class="form-control" style="height:150px" name="emp_comment" placeholder="Comment"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>

    <script>
        $( function() {
            $( "#emp_joined_at" ).datepicker({ dateFormat: "dd-mm-yy" });
        } );
    </script>
   
</form>
@endsection