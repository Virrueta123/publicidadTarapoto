@extends('layouts.admin')

@section('name')
    Error
@endsection
@section("history")
<li class="breadcrumb-item active">error</li>
@endsection
@section('content')
 

<section class="content">
    <div class="error-page">
      <h2 class="headline text-warning"> 404 </h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! {{ $title }}.</h3>

        <p>
            {{ $desc }}
        </p> 
      </div>
      <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
  </section>
  @endsection