@extends('admin.app')
@section('pagecss')
<link href="{{ asset('public/css/datatable/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="page-title">Users</h1>
    </section>

    <section class="main">   <!-- Main content -->
	    <div class="info-section"> 
            <div class="page-title">
                <span>Add Module</span>
                <a href="{{ url('modules/create') }}" title="Create Role"><i class="fa fa-plus valignMiddle" aria-hidden="true"></i></a>
            </div>
	        <!--Display Grid of Login Report-->
	        <div class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	            <div class="panel-body"> 
	                <div class="table_wrap table-responsive">
                        <table id="module_grid" class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Module Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot style="display:table-row-group" id="timesheetTotal">
                                
                            </tfoot>
                        </table>
	                </div>
	            </div><!-- panel-body -->
	        </div> <!-- PANEL END clients-messages -->

	    </div><!-- MIN-SECTION END -->
	</section>

    <!-- Content Header (Page Content) -->
    
</div>
@endsection
@section('footerscript')
<script src="{{ asset('public/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/js/page/displaymodule.js?expires=31536000') }}"></script>
@endsection