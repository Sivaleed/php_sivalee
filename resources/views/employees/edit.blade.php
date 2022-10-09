@extends('employees.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Sales Representative</h2>
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
  
    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID:</strong>
                    <input disabled type="text" name="id" value="{{ $employee->id }}" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <strong>Full Name:</strong>
                    <input type="text" name="emp_name" value="{{ $employee->emp_name }}" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <strong>Email Address:</strong>
                    <input type="text" name="emp_email" value="{{ $employee->emp_email }}" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <strong>Telephone:</strong>
                    <input type="text" maxlength="10" name="emp_phone" value="{{ $employee->emp_phone }}" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <strong>Joined Date:</strong>                    
                    <input type="text" value="{{ \Carbon\Carbon::parse($employee->emp_joined_at)->format('d-m-Y') }}" name="emp_joined_at" id="emp_joined_at" class="form-control">
                </div>

                <div class="form-group">
                    <strong>Current Routes:</strong>
                    <select name="emp_route">
                        <option value="0">Select Route</option>
                        <option value="Barnes Place" {{ ($employee->emp_route == 'Barnes Place') ? 'selected' : "" }} >Barnes Place</option>
                        <option value="Rosmid Place" {{ ($employee->emp_route == 'Rosmid Place') ? 'selected' : "" }}>Rosmid Place</option>
                        <option value="Cambridge Place" {{ ($employee->emp_route == 'Cambridge Place') ? 'selected' : "" }}>Cambridge Place</option>
                        <option value="Gregory Road" {{ ($employee->emp_route == 'Gregory Road') ? 'selected' : "" }}>Gregory Road</option>
                    </select>
                </div>         
                <div class="form-group">
                    <strong>Comments:</strong>
                    <textarea class="form-control" style="height:150px" name="email" placeholder="Comment">{{ $employee->emp_comment }}</textarea>
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