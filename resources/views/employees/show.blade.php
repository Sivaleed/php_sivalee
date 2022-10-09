@extends('employees.layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $employee->emp_name }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID:</strong>
                {{ $employee->id }}
            </div>
            <div class="form-group">
                <strong>Full Name:</strong>
                {{ $employee->emp_name }}
            </div>
            <div class="form-group">
                <strong>Email Address:</strong>
                {{ $employee->emp_email }}
            </div>
            <div class="form-group">
                <strong>Telephone:</strong>
                {{ $employee->emp_phone }}
            </div>
            <div class="form-group">
                <strong>Joined Date:</strong>
                {{ $employee->emp_joined_at }}
            </div>
            <div class="form-group">
                <strong>Current Routes:</strong>
                {{ $employee->emp_route }}
            </div>
            <div class="form-group">
                <strong>Comments:</strong>
                {{ $employee->emp_comment }}
            </div>
        </div>
    </div>
@endsection