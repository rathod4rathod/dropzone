@extends('admin.app')
@section('pagecss')

@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-title">Add Module</h1>
    </section>

    <section class="main">   <!-- Main content -->
	    <div class="info-section"> 
	        <!--Display Grid of Login Report-->
	        <div class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	            <div class="panel-body"> 
                   	<form action="" method="post" name="frmAddEditModule" id="frmAddEditModule" autocomplete="off">
                   		{{ csrf_field() }}
                   		<div class="row input-section">
                       		<div class="col-xs-12 col-sm-6 col-md-6 form-group">
			                    <label for="txtModuleName">Module Name</label>
			                    <input type="text" name="txtModuleName" id="txtModuleName" placeholder="Module Name" class="inputMaterial validate[required, custom[onlyLetterSp], maxSize[100]]" value="{{ isset($data['module']) ? $data['module']->st_module_name : old('txtModuleName') }}" />
			                    <span class="bar"></span>
			                </div>
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