@extends('employees.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Sales Team</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employees.create') }}">Add New Sales Representative</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Current Route</th>
            <th width="280px">Actions</th>
        </tr>
        @foreach ($employees as $emp)
        <tr>
            <td>{{ $emp->id }}</td>
            <td>{{ $emp->emp_name }}</td>
            <td>{{ $emp->emp_email }}</td>
            <td>{{ $emp->emp_phone }}</td>
            <td>{{ $emp->emp_route }}</td>
            <td>
                <form action="{{ route('employees.destroy',$emp->id) }}" method="POST">
                    <a class="btn btn-info display_data" data-url="{{ route('api_employees', $emp->id) }}">View</a>                    
                    <a class="btn btn-primary" href="{{ route('employees.edit',$emp->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    <div class="d-flex">      
        {!! $employees->links() !!}
    </div>

<!-- Modal -->
<div class="modal fade" id="empModal" >
         <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="employee-name">Employee Info</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
               </div>
               <div class="modal-body">
                   <table class="w-100" id="tblempinfo">
                      <tbody></tbody>
                   </table>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
<!-- end modal -->      

    <script>
        $( function() {
            
            $( ".display_data" ).on( "click", function() {                
                
                    $('#tblempinfo tbody').empty();

                    $.getJSON( $(this).data('url'), function( data ) {
                        var items = [];
                        $('#employee-name').html(data.emp_name);
                        //defined labels
                        var labels = { 
                                "id": "ID",
                                "emp_name": "Full Name",
                                "emp_email": "Email Address",
                                "emp_phone": "Telephone",
                                "emp_route": "Current Routes",
                                "emp_joined_at": "Joined Date",
                                "emp_comment": "Comments",
                                "created_at": "Created Date",
                                "updated_at": "Last Updated Date" 
                            };

                        $.each( data, function( key, val ) {
                            items.push( "<li id='" + key + "'>" +  labels[key] + ": " + val + "</li>" );
                        });
                    
                        $( "<ul/>", {
                            "class": "my-new-list",
                            html: items.join( "" )
                        }).appendTo( '#tblempinfo tbody' );
                    });

                    $('#empModal').modal('show');
                    
             });
        } );
  </script>


      
@endsection
