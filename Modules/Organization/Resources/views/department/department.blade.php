@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}">
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">  
@endsection
@section('page_header')
Department
@endsection
@section('page_description')
Set up Department
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('department') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Department Create</h3>
                </div> 
                {!! Form::open(array('route'=>'department.store','id'=>'add_department_form','class' => 'form-horizontal')) !!}              
                <div class="box-body">
                    <div class="col-md-12"> 
                        <div class="form-group @if ($errors->has('department_name')) has-error @endif">
                            <label for="name" class="control-label">Department Name*</label> 
                            <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Enter name" value="{{old('department_name')}}"> 
                            @if ($errors->has('department_name')) <p class="help-block">{{ $errors->first('department_name') }}</p> @endif                             
                        </div>
                        <div class="form-group @if ($errors->has('address')) has-error @endif">
                            <label for="name" class="control-label">Address*</label> 
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{old('address')}}"> 
                            @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif                             
                        </div>

                        <div class="form-group @if ($errors->has('department_type_id')) has-error @endif">
                            <label for="district_id" class="control-label">Department Type*</label>
                            <select class="js-example-basic-single js-states form-control" name="department_type_id" id="department_type_id"></select>
                            @if ($errors->has('department_type_id')) <p class="help-block">{{ $errors->first('department_type_id') }}</p> @endif 
                        </div>
                        <div class="form-group @if ($errors->has('branch_id')) has-error @endif">
                            <label for="branch_id" class="control-label">Branch*</label>
                            <select class="js-example-basic-single js-states form-control" name="branch_id" id="branch_id"></select>
                            @if ($errors->has('branch_id')) <p class="help-block">{{ $errors->first('branch_id') }}</p> @endif 
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer"> 
                    <button type="submit" class="btn btn-primary pull-left">Submit</button>
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
                <!-- /.form ends here -->
            </div>
            <!-- /.box -->
        </div>
        <!--  Permission List-->
        <div class="col-lg-6">
          <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Department List</h3>
            </div>
            <div class="box-body"> 
                <table id="all_role_table" class="table table-bordered table-hover">
                    <thead>
                      <tr> 
                        <th>Name</th> 
                        <th>Department Type</th> 
                        <th>Branch</th> 
                        <th>Address</th> 
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody> 
            </table>
        </div>
    </div>
</div>
</div>    
</section>
<!-- /.content -->


<!-- Delete Customer Modal -->
<div class="modal fade" id="confirm_delete" role="dialog">
   <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title">Remove Parmanently</h4>
     </div>
     <div class="modal-body">
         <p>Are you sure about this ?</p>
     </div>
     <div class="modal-footer">
         <button type="button" class="btn btn-danger" id="delete_role">Delete</button>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
     </div>
 </div>
 <!-- /. Modal content ends here -->
</div>
</div>
<!--  Delete Customer Modal ends here -->
@endsection


@section('scripts')
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('bower_components/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>
<script src="{{asset('js/utils/utils.js')}}"></script>

<script>

    $(document).ready(function () {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })   

    // initialize tooltipster on form input elements
    $('form input, select').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
    });

    // initialize validate plugin on the form
    $('#add_department_form').validate({
        errorPlacement: function (error, element) { 
            var lastError = $(element).data('lastError'),
            newError = $(error).text();

            $(element).data('lastError', newError);

            if (newError !== '' && newError !== lastError) {
                $(element).tooltipster('content', newError);
                $(element).tooltipster('show');
            }
        },
        success: function (label, element) {
            $(element).tooltipster('hide');
        },
        rules: {
            department_name: {required: true, minlength: 2},
            department_type_id: {required: true},
            branch_id: {required: true},
            address: {required: true}
        },
        messages: {
            department_name: {required: "Please give name"},
            department_type_id: {required: "Please Select a Department Type"},
            branch_id: {required: "Please Select a Branch"},
            address: {required: "Please give address"}
        }
    });


    //Datatable Generation
    var table = $('#all_role_table').DataTable({
     "paging": true,
     "lengthChange": true,
     "searching": true,
     "ordering": true,
     "info": true,
     "autoWidth": false,
     "processing": true,
     "serverSide": true,
     "ajax": "{{URL::to('/department/get_all_departments')}}",
     "columns": [ 
     {"data": "department_name"}, 
     {"data": "department_type.department_type_name"}, 
     {"data": "branch.branch_name"}, 
     {"data": "address"}, 
     {data: 'action', name: 'action', orderable: false, searchable: false}
     ],
     "order": [[0, 'asc']]
 });  






// Delete Permission
$('#confirm_delete').on('show.bs.modal', function(e) {
   var $modal = $(this),
   branch_id = e.relatedTarget.id;

   $('#delete_role').click(function(e){
     event.preventDefault();
     $.ajax({
       cache: false,
       type: 'DELETE',
       url: '/department/' + branch_id,
       data: branch_id,
       success: function(data){
         table.ajax.reload(null, false);
         $('#confirm_delete').modal('toggle');
     }
 });
 });
});

 
 
// initialize select2 for department_type_id
init_select2({
    placeholder: "Department Type",
    url: '{{URL::to("/")}}/department/auto/get_department_types',
    selector_id:$('#department_type_id'), 
    data:{}
});

// initialize select2 for department_type_id
init_select2({
    placeholder: "Branch",
    url: '{{URL::to("/")}}/branch/auto/get_branchs',
    selector_id:$('#branch_id'), 
    data:{}
});




});//document ready



</script>

@endsection
