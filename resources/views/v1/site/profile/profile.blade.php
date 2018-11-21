@extends('v1.site.layouts.layouts')

@section('title','پروفایل کاربری شما')

@section('content')

    <div class="container">

        <!-- Timeline
        ================================================= -->
        <div class="timeline">
            @foreach($profiles as $profile)
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
                                <li><a href="timeline-about.html">About</a></li>
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
                    <div class="col-md-7">

                    @if(Auth::user()->id === $user->id)
                        <!-- Post Create Box
                        ================================================= -->
                        <div class="create-post">
                            <div class="row">
                                <div class="col-md-7 col-sm-7">
                                    <div class="form-group">
                                        <img src="/uploads/avatars/uplode/{{$profile->avatar}}" alt="" class="profile-photo-md" />
                                        <textarea name="text" id="exampleTextarea" cols="30" rows="1" class="form-control" placeholder="Write what you wish" v-model="textPost"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5">
                                    <div class="tools">
                                        <ul class="publishing-tools list-inline">
                                            <li>
                                                <div class="image-upload">
                                                    <label for="file-input">
                                                        <span><i class="ion-images"></i></span>
                                                    </label>

                                                    <input id="file-input" type="file" name="image" ref="imagePost"/>
                                                </div>
                                            </li>
                                        </ul>
                                        <button class="btn btn-primary pull-right" @click="sendPost({{$user->id}})">Publish</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Post Create Box End-->
                    @else
                    <span class="myBiography">
                        <h3>BioGraphy</h3>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </span>
                            <hr>
                    @endif
                        <!-- Post Content
                        ================================================= -->
                        <div class="post-content">
                            <!--Post Date-->
                            <div class="post-date hidden-xs hidden-sm">
                                @if($profile->nickname)
                                    <h5>{{$profile->nickname}}</h5>
                                @else
                                    <h5>{{$user->name}}</h5>
                                @endif
                                <p class="text-grey">Sometimes ago</p>
                            </div><!--Post Date End-->

                            <img src="/images/post-images/12.jpg" alt="post-image" class="img-responsive post-image" />
                            <div class="post-container">
                                <img src="/uploads/avatars/uplode/{{$profile->avatar}}" alt="user" class="profile-photo-md pull-left" />
                                <div class="post-detail">
                                    <div class="user-info">
                                        <h5><a href="{{route('user.profile.index',['id' => $user->id,'name' => $user->name])}}" class="profile-link">
                                                @if($profile->nickname)
                                                    <h3>{{$profile->nickname}}</h3>
                                                @else
                                                    <h3>{{$user->name}}</h3>
                                                @endif
                                            </a> <span class="following">
                                                @if($friend && $friend->iswhat === 1)
                                                    Following
                                                    @else
                                                    No Follow
                                                @endif
                                            </span></h5>
                                        <p class="text-muted">Published a photo about 15 mins ago</p>
                                    </div>
                                    <div class="reaction">
                                        <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
                                        <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
                                    </div>
                                    <div class="line-divider"></div>
                                    <div class="post-text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                    </div>
                                    <div class="line-divider"></div>
                                    <div class="post-comment">
                                        <img src="/images/users/user-11.jpg" alt="" class="profile-photo-sm" />
                                        <p><a href="timeline.html" class="profile-link">Diana </a><i class="em em-laughing"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                                    </div>
                                    <div class="post-comment">
                                        <img src="/images/users/user-4.jpg" alt="" class="profile-photo-sm" />
                                        <p><a href="timeline.html" class="profile-link">John</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud </p>
                                    </div>
                                    <div class="post-comment">
                                        <img src="/uploads/avatars/uplode/{{$profile->avatar}}" alt="" class="profile-photo-sm" />
                                        <input type="text" class="form-control" placeholder="Post a comment">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
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


            @endforeach
        </div>
    </div>

@endsection