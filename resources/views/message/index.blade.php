@extends('layouts.app')
@section('breadcrumb')
<!-- leftside content header -->
<div class="content-header">
	<div class="leftside-content-header">
	    <ul class="breadcrumbs">
	        <li><i class="fa fa-pie-chart" aria-hidden="true"></i><a href="{{ route('dashboard') }}">Dashboard</a></li>
	        <li><a href="{{ route('message.index') }}"> Message Lists</a></li>
	    </ul>
	</div>
</div>
@stop
@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
       <!--SUCCESS-->
        @if (Session::has('success'))           
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
             {!! Session::get('success') !!}
        </div>
        @endif 
    </div>
</div>


<div class="row">
	<div class="col-sm-12">
		<h4 class="section-subtitle">
			<b> Message Lists </b>
		</h4>
		<span class="pull-right">
			<a href="{{ route('message.create')}}" class="btn btn-success btn-right-side"><i class="fa fa-plus"></i></a>
		</span>
		 <div class="panel">
            <div class="panel-content">
				 <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Sender Name </th>
                            <th> Sender Email </th>
                            <th> Subject </th>
                            <th> Message Description </th>
                           	<th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach ($message as $data)
                        	<tr>
                                <td> {{ $i }} </td>
                                <td> {{ $data->name }} </td>
                                <td> {{ $data->email }} </td>
                                <td>  {{ str_limit($data->subject, 70) }} </td>
                                <td>  {{ str_limit($data->message_description, 120) }} </td>
                                <td> 
                                 {!! Form::open(['method' => 'DELETE','route' => ['message.destroy', $data->id],'style'=>'display:inline']) !!}
                                    <button class="btn btn-transparent" title="" data-original-title="Delete"><i class="fa fa-times"></i></button>
                                {!! Form::close() !!}
                                </td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
@section('script')
    <!--dataTable-->
    <script src="{{ asset('vendor/data-table/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/data-table/media/js/dataTables.bootstrap.min.js') }}"></script>
    <!--Examples-->
    <script src="{{ asset('js/examples/tables/data-tables.js') }}"></script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/data-table/media/css/dataTables.bootstrap.min.css') }}">
@stop