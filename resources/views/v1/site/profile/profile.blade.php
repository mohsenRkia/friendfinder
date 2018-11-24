@extends('v1.site.layouts.layouts')

@section('content')


    <div class="container">
    <!-- Timeline
        ================================================= -->
    <div class="timeline">

        <div class="timeline-cover">
            <img src="/uploads/bgprofiles/uplode/{{$profile->bgprofile}}" alt="" width="100%">
            <!--Timeline Menu for Large Screens-->
            <div class="timeline-nav-bar hidden-sm hidden-xs">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-info">
                            <img src="/uploads/avatars/uplode/{{$profile->avatar}}" alt="" class="img-responsive profile-photo" />
                            @if($profile->nickname)
                                <h3>{{$profile->nickname}}</h3>
                            @else
                                <h3>{{$user->name}}</h3>
                            @endif

                            @if($profile->job)
                                <p class="text-muted">{{$profile->job}}</p>
                            @else
                                <p class="text-muted">Undefined Job</p>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-9">
                        <ul class="list-inline profile-menu">
                            <li><a href="timeline.html" class="active">Timeline</a></li>
                            <li><a href="{{route('user.profile.about',['id' => $user->id,'name' => $user->name])}}">About</a></li>
                            <li><a href="timeline-album.html">Album</a></li>
                            <li><a href="timeline-friends.html">Friends</a></li>
                        </ul>
                        <ul class="follow-me list-inline">
                            <li>Follower : {{$hasFollower}}</li>
                            <li>Following : {{$hasFollowing}}</li>
                            @if(Auth::user()->id === $user->id)
                                <li><button class="btn-primary">Welcome</button></li>
                            @else
                                @if($friend)
                                    @if($friend->iswhat === 0)
                                        <li><button class="btn btn-primary" @click="addFriend({{$user->id}},{{Auth::user()->id}},$event)">Add Friend</button></li>
                                    @elseif($friend->iswhat === 1)
                                        <li><button class="btn btn-success" @click="addFriend({{$user->id}},{{Auth::user()->id}},$event)">Followed</button></li>
                                    @endif
                                @else
                                    <li><button class="btn btn-primary" @click="addFriend({{$user->id}},{{Auth::user()->id}},$event)">Add Friend</button></li>
                                @endif

                            @endif
                        </ul>
                    </div>
                </div>
            </div><!--Timeline Menu for Large Screens End-->
        </div>
        <div id="page-contents">
            <div class="row">
                <div class="col-md-3"></div>

@yield('details')



                <div class="col-md-2 static">
                    <div id="sticky-sidebar">
                        <h4 class="grey">
                            @if($profile->nickname)
                                {{$profile->nickname}}
                            @else
                                {{$user->name}}
                            @endif
                            's activity</h4>
                        @foreach($logs as $log)
                            <div class="feed-item">
                                <div class="live-activity">
                                    <p><a href="#" class="profile-link">
                                            @if($profile->nickname)
                                                {{$profile->nickname}}
                                            @else
                                                {{$user->name}}
                                            @endif
                                        </a>
                                        @switch($log->activity)
                                            @case(1)
                                            Registered
                                            @break
                                            @case(2)
                                            Edited Information
                                            @break
                                            @case(3)
                                            Posted
                                            @break
                                            @case(4)
                                            Make Friend With Somone
                                            @break
                                            @case(5)
                                            Commented on a friend Post
                                            @break
                                        @endswitch
                                    </p>
                                    <p class="text-muted">{{$log->created_at}}</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

@endsection