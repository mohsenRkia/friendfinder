@extends('v1.admin.layouts.layouts')

@section('title','لیست کاربران')


@section('content')


    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">لیست کاربران</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            کابران ثبت نام شده
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>ایمیل</th>
                                        <th>نام کاربری</th>
                                        <th>نام مستعار</th>
                                        <th>شماره</th>
                                        <th>موقعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <div style="display: none;">{{$i = 1}}</div>
                                    @foreach($users as $user)

                                    @if($user->id % 2 == 0)
                                    <tr class="odd gradeX">
                                        <td>{{$i++}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->name}}</td>
                                            @if($user->profile)
                                            <td>
                                                @if($user->profile->nickname)
                                                    {{$user->profile->nickname}}
                                                @else
                                                    ثبت نشده
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->profile->phone)
                                                {{$user->profile->phone}}
                                                @else
                                                    ثبت نشده
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->profile->location)
                                                    {{$user->profile->location}}
                                                    @else
                                                    ثبت نشده
                                                @endif
                                            </td>
                                                @else
                                            <td>ثبت نشده</td>
                                            <td>ثبت نشده</td>
                                            <td>ثبت نشده</td>
                                            @endif

                                    </tr>
                                    @else
                                    <tr class="even gradeC">
                                        <td>{{$i++}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->name}}</td>
                                        @if($user->profile)
                                            <td>
                                                @if($user->profile->nickname)
                                                    {{$user->profile->nickname}}
                                                @else
                                                    ثبت نشده
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->profile->phone)
                                                    {{$user->profile->phone}}
                                                @else
                                                    ثبت نشده
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->profile->location)
                                                    {{$user->profile->location}}
                                                @else
                                                    ثبت نشده
                                                @endif
                                            </td>
                                        @else
                                            <td>ثبت نشده</td>
                                            <td>ثبت نشده</td>
                                            <td>ثبت نشده</td>
                                        @endif
                                    </tr>
                                    @endif
                                        @endforeach

                                    </tbody>
                                </table>
                                {{$users->links()}}
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