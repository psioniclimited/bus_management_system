@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/tooltipster/tooltipster.css')}}"> 
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/datepicker/datepicker3.css')}}">  
<link rel="stylesheet" href="{{asset('bower_components/AdminLTE/plugins/select2/select2.min.css')}}">
<style>
  .col-md-6{
    padding-right: 20px !important;
  }
</style>
@endsection
@section('page_header')
Employee Leave
@endsection
@section('page_description')
manage employee leave
@endsection
@section('breadcrumb')
{!! Breadcrumbs::render('employee_leave_application') !!}
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<section class="content">
  <div class="row">

    <div class="col-md-12"> 
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Employee Leave Application</h3>
        </div>

        {!! Form::open(array('route' => array('leave_application.update', $leave_application->id), 'id' => 'leave_application_form', 'method'=>'PUT')) !!}         
        <div class="box-body">


          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('leave_status_id')) has-error @endif">
              <label for="name" class="control-label">Status</label>
              @if($leave_application->leave_status->change_type==0)
              <select class="form-control" id="leave_status_id" name="leave_status_id"> 
                <option value="{{$leave_application->leave_status->id}}">{{$leave_application->leave_status->status_name}}</option>
              </select>
              @else
              <select class="form-control" id="leave_status_id" name="leave_status_id" > 
                @foreach($leave_status as $row)
                @if($row->change_type==1)
                @if($row->id==$leave_application->leave_status_id)
                <option value="{{$row->id}}" selected="">{{$row->status_name}}</option>
                @else
                <option value="{{$row->id}}">{{$row->status_name}}</option>
                @endif 
                @endif 
                @endforeach
              </select>   
              @endif 
              @if ($errors->has('leave_status_id')) <p class="help-block">{{ $errors->first('leave_status_id') }}</p> @endif                             
            </div>  
          </div><!-- /.col-md-6 -->


          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('leave_type_id')) has-error @endif">
              <label for="name" class="control-label">Leave Type*</label>
              <select class="form-control" id="leave_type_id" name="leave_type_id" > 
              </select>   
              @if ($errors->has('leave_type_id')) <p class="help-block">{{ $errors->first('leave_type_id') }}</p> @endif                             
            </div>  
          </div><!-- /.col-md-6 -->

          <div class="col-md-6">  

            <div class="form-group @if ($errors->has('employees_master_id')) has-error @endif">
              <label for="name" class="control-label">Employee*</label>
              <select class="form-control" id="employees_master_id" name="employees_master_id" > 
              </select>                 
              @if ($errors->has('employees_master_id')) <p class="help-block">{{ $errors->first('employees_master_id') }}</p> @endif                             
            </div>  

          </div><!-- /.col-md-6 -->


          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('employees_master_id')) has-error @endif">
              <label for="name" class="control-label">Employee Name*</label>
              <input type="text" class="form-control" id="employee_fullname" readonly="" > 
              @if ($errors->has('employees_master_id')) <p class="help-block">{{ $errors->first('employees_master_id') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->
          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('employees_master_id')) has-error @endif">
              <label for="name" class="control-label">Employee Contact*</label>
              <input type="text" class="form-control" id="contact_number" readonly=""> 
              @if ($errors->has('employees_master_id')) <p class="help-block">{{ $errors->first('employees_master_id') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->

          <div class="row"></div>
          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('from_date')) has-error @endif">
              <label for="name" class="control-label">Date From*</label>
              <input type="text" class="form-control" id="from_date" name="from_date" placeholder="Select Start Date" value="{{$leave_application->from_date}}"  data-date-format='yyyy-mm-dd' > 
              @if ($errors->has('from_date')) <p class="help-block">{{ $errors->first('from_date') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->

          <div class="col-md-6">  
            <div class="form-group @if ($errors->has('to_date')) has-error @endif">
              <label for="name" class="control-label">Date To*</label>
              <input type="text" class="form-control" id="to_date" name="to_date" placeholder="Select End Date" value="{{$leave_application->to_date}}"  data-date-format='yyyy-mm-dd' > 
              @if ($errors->has('from_date')) <p class="help-block">{{ $errors->first('from_date') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->


          <div class="col-md-12">  
            <div class="form-group @if ($errors->has('reason')) has-error @endif">
              <label for="name" class="control-label">Reason*</label>
              <div class="box-body pad"> 
                <textarea name="reason" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$leave_application->reason}}</textarea>
              </div>
              @if ($errors->has('reason')) <p class="help-block">{{ $errors->first('reason') }}</p> @endif                             
            </div>   
          </div><!-- /.col-md-6 -->

          <!-- <br> -->
          <div class="row"></div>

        </div> <!-- /.box-body --> 



        <div class="box-footer"> 
          <button type="submit" id="btn-submit" class="btn btn-primary pull-left">Submit</button>
        </div> <!-- /.box-footer -->
        {!! Form::close() !!} 
      </div><!-- /.box -->
    </div><!-- /col-md-6 -->
  </div>  <!--row-->
</section>
<!-- /.content -->



@endsection


@section('scripts')
<script src="{{asset('plugins/validation/dist/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/tooltipster/tooltipster.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE/plugins/jQueryUI/jquery-ui.min.js')}}"></script>
<script src="{{asset('bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js')}}"></script>

<script src="{{asset('bower_components/AdminLTE//plugins/select2/select2.min.js')}}"></script>   
<script src="{{asset('js/utils/utils.js')}}"></script>

<script>

  $(document).ready(function () {

    // initialize tooltipster on form input elements
    $('form input, select, textarea').tooltipster({// <-  USE THE PROPER SELECTOR FOR YOUR INPUTs
        trigger: 'custom', // default is 'hover' which is no good here
        onlyOne: false, // allow multiple tips to be open at a time
        position: 'right'  // display the tips to the right of the element
      });

    $('#leave_application_form').validate({
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

        leave_type_id: {required: true},
        employees_master_id: {required: true},
        from_date: {required: true, date:true},
        to_date: {required: true, date:true},
        reason: {required: true},
      },
      messages: {  
        leave_type_id: {required: "Please Select Leave Type"},
        employees_master_id: {required: "Please give Employee"},
        from_date: {required: "Please Select a Date",date:"Dates Only"},
        to_date: {required: "Please Select a Date",date:"Dates Only"},
        reason: {required: "Please give a reason for leave"},


      }
    });



    var employees_master_id=$('#employees_master_id'); 

    $.get( "{{URL::to('/leave_ledger/auto/get_employees')}}", { leave_ledger_id: {{$leave_application->id}} } ,function( data ) {
      init_select2_with_default_value({
        default_value: data,
        placeholder: "Employee",
        url: '{{URL::to("/")}}/employee/auto/get_employees',
        selector_id:$('#employees_master_id'),
        data:{}
      });
    });



    $.get( "{{URL::to('/leave_ledger/auto/get_leave_types')}}", { leave_ledger_id: {{$leave_application->id}} } ,function( data ) {
      init_select2_with_default_value({
        default_value: data,
        placeholder: "Leave Type",
        url: '{{URL::to("/")}}/leave_type/auto/get_leave_types',
        selector_id:$('#leave_type_id'),
        data:{}
      });
    });

 
    $('#from_date').datepicker();
    $('#to_date').datepicker();


    employees_master_id.on("select2:select",function (e) {   
      $('#employee_fullname').val(employees_master_id.select2('data')[0]['employee_fullname']);    
      $('#contact_number').val(employees_master_id.select2('data')[0]['contact_number']);   
    });

    employees_master_id.on("select2:unselect", function(evt) {
     $('#employee_fullname').val("");    
     $('#contact_number').val("");
   });

});//document ready



</script>

@endsection
