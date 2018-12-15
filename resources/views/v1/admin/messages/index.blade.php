@extends('v1.admin.layouts.layouts')

@section('title','لیست پیام ها')


@section('content')


    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">لیست پیام ها</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            پیام های دریافت شده
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>ایمیل</th>
                                        <th>نام</th>
                                        <th>تلفن</th>
                                        <th>چکیده</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none;">{{$i = 1}}</div>
                                    @foreach($messages as $pm)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$pm->email}}</td>
                                        <td>{{$pm->name}}</td>
                                        <td>{{$pm->phone}}</td>
                                        <td>
                                            @if(strlen($pm->text) > 17)
                                                {{substr($pm->text,0,17)}} ...
                                                @else
                                                {{$pm->text}}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('message.delete',['id' => $pm->id])}}" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                                            </a> |
                                            <a href="{{route('message.store',['id' => $pm->id])}}" class="btn btn-primary btn-circle"><i class="fa fa-list"></i>
                                            </a>
                                        </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$messages->links()}}
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>

@endsection