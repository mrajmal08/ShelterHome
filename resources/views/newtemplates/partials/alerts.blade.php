@if(Session::has('info'))
  <div class="alert alert-info alert-dismissible fade in" role="alert">
  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
  	{{Session::get('info')}}
  </div>
@elseif(Session::has('success'))
  <div class="alert alert-success alert-dismissible fade in" role="alert">
  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
  	{{Session::get('success')}}
  </div>
@elseif(Session::has('warning'))
  <div class="alert alert-warning alert-dismissible fade in" role="alert">
  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
  	{{Session::get('warning')}}
  </div>
 @elseif(Session::has('danger'))
  <div class="alert alert-danger alert-dismissible fade in" role="alert">
  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
  	{{Session::get('danger')}}
  </div>  
@endif
