@extends('admin.app')
@section('pagecss')
<link href="{{ asset('public/dist/dropzone.css') }}" rel="stylesheet" />
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
	        <!--Display Grid of Login Report-->
	        <div class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
	            <div class="panel-body"> 
	                <div class="table_wrap table-responsive">
                       
                  <div id="dZUpload" class=""><form action="" class="dropzone needsclick" id="demo-upload" method="POST">
                {{ csrf_field() }}
                  <div class="dz-message needsclick">
                    Drop files here or click to upload.<br />
                    <span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>

                  </div>
                  <div>
                      
                  </div>
                  <button type="button" id="upload-all">Submit</button>
                </form></div>
	                </div>
	            </div><!-- panel-body -->
	        </div> <!-- PANEL END clients-messages -->

	    </div><!-- MIN-SECTION END -->
	</section>

    <!-- Content Header (Page Content) -->
    
</div>
@endsection
@section('footerscript')
<script src="{{ asset('public/dist/dropzone.js') }}"></script>
    <script>
  //  $(document).ready(function(){
    Dropzone.autoDiscover = false;    
    var myDropzone = new Dropzone("#demo-upload",
    {
        url: "{{route('dropZone.store')}}",
        autoProcessQueue : false,
        parallelUploads : 10,        
        acceptedFiles: ".png, .jpg, .jpeg",
        maxFilesize: 1,
        maxFiles: 10,
        addRemoveLinks:true    
    });
    $('#upload-all').click(function () {
        myDropzone.processQueue();
    });
//});
</script>
@endsection