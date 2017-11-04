@extends('layouts.layout')

@section('content')

<div class="page-error centered">
        
    <div class="error-symbol">
        <i class="fa-warning"></i>
    </div>
    
    <h2>
        Error 500
        <small>Whoops, looks like something went wrong.</small>
    </h2>
   
   <!-- 
    <p>We did not find the page you were looking for!</p>
    <p>You can search again or contact one of our agents to help you!</p>
   -->

</div>

<div class="page-error-search centered">    
    <a href="javascript:;" onclick="window.history.back();" class="go-back">
        <i class="fa-angle-left"></i>
        Go Back
    </a>
</div>

@endsection