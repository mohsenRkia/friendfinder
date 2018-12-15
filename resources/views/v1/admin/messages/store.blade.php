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
                                نام : {{$pm->name}} <br>
                                ایمیل : {{$pm->email}} <br>
                                موبایل : {{$pm->phone}} <br>
                                متن پیام : {{$pm->text}} <br>


                                <hr>
                                <h3>ارسال جواب</h3>
                                <form action="{{route('message.reply')}}" method="POST">

                                    <input type="hidden" class="form-control" value="{{$pm->name}}" name="name">

                                    <input type="hidden" class="form-control" value="{{$pm->email}}" name="email">

                                    @csrf
                                <div class="form-group">
                                    <label>Text area</label>
                                    <textarea class="form-control" rows="3" name="contactpm"></textarea>
                                </div>

                                <button type="submit" class="btn btn-default">ارسال</button>
                                </form>

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