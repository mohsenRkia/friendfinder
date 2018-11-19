@extends('v1.user.layouts.layouts')

@section('title','ویرایش اطلاعات شما')


@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h1 class="page-header">تغییر مشخصات</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('user.update',['id' => $firstInfo->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    مشخصات اولیه
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>نام کاربری</label>
                                                <input name="name" class="form-control" value="{{$firstInfo->name}}">
                                            </div>

                                            <div class="form-group">
                                                <label>ایمیل</label>
                                                <input name="email" class="form-control" value="{{$firstInfo->email}}">
                                            </div>


                                            <div class="form-group">
                                                <label>سمت</label>
                                                <select class="form-control" name="isadmin">
                                                    @if($firstInfo->isAdmin == 0)
                                                    <option value="0">کاربر عادی</option>
                                                    @else
                                                    <option value="1">مدیر سایت</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    مشخصات پروفایل
                                </div>
                                <div class="panel-body">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            @foreach($secondInfo as $second)

                                                <img src="/uploads/avatars/uplode/{{$second->avatar}}" alt="" width="150" height="150">
                                                    <div class="form-group">
                                                        <label>اپلود تصویر</label>
                                                        <input type="file" name="avatar">
                                                    </div>

                                                    <div class="form-group">
                                                        <input class="form-control" name="nickname" placeholder="نام مستعار" value="{{$second->nickname}}">
                                                    </div>

                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="3" name="bio" placeholder="بیوگرافی">{{$second->bio}}</textarea>
                                                    </div>


                                                <div>
                                                <span>تاریخ تولد :
                                                    {{$second->birthdate}}
                                                </span>
                                                </div>


                                                    <div class="form-group">
                                                        <label>سمت</label>
                                                        <select class="form-control" name="gender">
                                                            @if($second->gender == 1)
                                                                <option value="1">مرد</option>
                                                                <option value="2">زن</option>
                                                                <option value="0">نامشخص</option>
                                                            @elseif($second->gender == 2)
                                                                <option value="2">زن</option>
                                                                <option value="1">مرد</option>
                                                                <option value="0">نا مشخص</option>
                                                                @else
                                                                <option value="0">جنسیت</option>
                                                                <option value="1">مرد</option>
                                                                <option value="2">زن</option>
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <input name="phone" class="form-control" value="{{$second->phone}}" placeholder="تلفن">
                                                    </div>

                                                    <div class="form-group">
                                                        <input name="location" class="form-control" value="{{$second->location}}" placeholder="موقعیت">
                                                    </div>

                                                    <div class="form-group">
                                                        <input name="job" class="form-control" value="{{$second->job}}" placeholder="شغل">
                                                    </div>

                                                @endforeach

                                        </div>


                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>

                        <button type="submit" class="btn btn-default">Submit Button</button>

                    </div>
                    </form>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>

@endsection


<!--


   <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h1 class="page-header">اطلاعات اولیه</h1>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Basic Form Elements
                                </div>
                                <div class="panel-body">
                                    <div class="row">




                                    </div>

</div>

</div>

</div>

</div>
</div>
</div>

</div>

</div>

-->