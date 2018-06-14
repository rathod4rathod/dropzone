@extends('admin.app')
@section('pagecss')

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="main">   <!-- Main content -->
	    <div class="info-section"> 
	    	<div class="page-title">
                <span>@if(isset($data['role'])) Edit Role @else Add Role @endif</span>
                <a href="{{ url('roles/create') }}" title="Create Role"><i class="fa fa-plus valignMiddle" aria-hidden="true"></i></a>
            </div>
	        <!--Display Grid of Login Report-->
	        <div class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	            <div class="panel-body"> 
                   	<form action="" method="post" name="frmAddEditUserRole" id="frmAddEditUserRole" autocomplete="off">
                   		{{ csrf_field() }}
                   		<div class="row input-section">
                       		<div class="col-xs-12 col-sm-6 col-md-6 form-group">
			                    <label for="txtRoleName">Role Name</label>
			                    <input type="text" name="txtRoleName" id="txtRoleName" placeholder="Role Name" class="inputMaterial validate[required, custom[onlyLetterSp], maxSize[100]]" value="{{ isset($data['role']) ? $data['role']->st_role_name : old('txtRoleName') }}" />
			                    <span class="bar"></span>
			                </div>
			                @if(isset($data['role']))
			            	<div class="col-xs-12 col-sm-6 col-md-6 form-group">
			                    <label for="selectRoleStatus">Role Status</label>
			                    <select name="selectRoleStatus" id="selectRoleStatus" class="form-control inputMaterial validate[required]" value="" />
			                    	<option value="1" @if(isset($data['role']) && $data['role']->in_role_status == '1') selected @endif >Active</option>
			                    	<option value="2" @if(isset($data['role']) && $data['role']->in_role_status == '2') selected @endif>Inactive</option>
			                    </select>
			                    <span class="fa fa-caret-down form-control-feedback"></span>
			                    <span class="bar"></span>
			                </div>
			            	@endif
			            </div>
			            <button type="submit" name="btnSave" id="btnSave" class="btn bg-yellow big-btn pull-right">Save</button>
            			<a href="{{ url('roles') }}" class="btn bg-yellow big-btn pull-right" style="margin-right: 10px;">Cancel</a>
                   	</form>
	            </div><!-- panel-body -->
	        </div> <!-- PANEL END clients-messages -->
	    </div><!-- MIN-SECTION END -->
	</section>
    <!-- Content Header (Page Content) -->
    
</div>
@endsection
@section('footerscript')


@endsection