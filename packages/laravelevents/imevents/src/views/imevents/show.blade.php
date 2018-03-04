@extends('layouts.app')

@section('title', '| {{ $imevent->subject}}')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> {{ $imevent->subject}}</h1>
    <hr>
 <div>
   {{ $imevent->description }}
 </div>
  <hr> 
</div>
@endsection
