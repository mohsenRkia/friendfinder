@extends('v1.site.layouts.layouts')


@section('content')


    <div id="page-contents">
        <div class="container">
            <div class="row">

                <!-- Newsfeed Common Side Bar Left
          ================================================= -->
                <div class="col-md-3 static">
                </div>
                <div class="col-md-7">

                    <!-- Nearby People List
                    ================================================= -->
                    <div class="people-nearby">
                        @foreach($resault as $user)
                        <div class="nearby-user">
                            <div class="row">
                                <div class="col-md-2 col-sm-2">
                                    @if($user->profile)
                                    <img src="uploads/avatars/uplode/{{$user->profile->avatar}}" alt="user" class="profile-photo-lg" />
                                    @else
                                        <img src="uploads/avatars/uplode/avatar.png" alt="user" class="profile-photo-lg" />
                                    @endif
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    <h5><a href="{{route('user.profile.timeline',['id' => $user->id,'name' => $user->name])}}" class="profile-link">{{$user->name}}</a></h5>
                                    <p>Software Engineer</p>
                                    <p class="text-muted">500m away</p>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    @if(Auth::check())
                                    @if(in_array($user->id,$friend_id))
                                                @foreach($friends as $friend)
                                                    @if($friend->myfriend_id == $user->id && $friend->iswhat == 1)
                                                        <button class="btn btn-success pull-right" @click="addFriend({{$user->id}},{{Auth::user()->id}},$event)">Following</button>
                                                    @elseif($friend->myfriend_id == $user->id && $friend->iswhat == 0)
                                                    <button class="btn btn-primary pull-right" @click="addFriend({{$user->id}},{{Auth::user()->id}},$event)">Add Friend</button>
                                                @endif
                                                @endforeach
                                        @elseif($user->id == Auth::user()->id)
                                            <button class="btn btn-success pull-right">Following</button>
                                        @else
                                                <button class="btn btn-primary pull-right" @click="addFriend({{$user->id}},{{Auth::user()->id}},$event)">Add Friend</button>
                                        @endif
                                        @else
                                        <a href="{{route('home.index')}}/login" class="btn btn-primary pull-right">Login For Follow</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                            @endforeach
                    </div>
                </div>


                {{$resault->appends(['key' => $key])->links()}}
            </div>
        </div>
    </div>




@endsection