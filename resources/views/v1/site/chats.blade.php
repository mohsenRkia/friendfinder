@extends('v1.site.layouts.layouts')


@section('content')

    <div id="page-contents">
        <div class="container">
            <div class="row">

                <!-- Newsfeed Common Side Bar Left
          ================================================= -->
                <div class="col-md-3 static">
                    <div class="profile-card">
                        <img src="/uploads/avatars/uplode/{{$user->profile->avatar}}" alt="user" class="profile-photo" />
                        <h5><a href="timeline.html" class="text-white">
                                @if($user->profile->nickname)
                                    {{$user->profile->nickname}}
                                    @else
                                    {{$user->name}}
                                    @endif
                            </a></h5>
                        <a href="#" class="text-white"><i class="ion ion-android-person-add"></i> {{$hasFollower}} followers</a>
                    </div><!--profile card ends-->
                    <ul class="nav-news-feed">
                        <li><i class="icon ion-ios-paper"></i><div><a href="newsfeed.html">My Newsfeed</a></div></li>
                        <li><i class="icon ion-ios-people"></i><div><a href="newsfeed-people-nearby.html">People Nearby</a></div></li>
                        <li><i class="icon ion-ios-people-outline"></i><div><a href="newsfeed-friends.html">Friends</a></div></li>
                        <li><i class="icon ion-chatboxes"></i><div><a href="newsfeed-messages.html">Messages</a></div></li>
                        <li><i class="icon ion-images"></i><div><a href="newsfeed-images.html">Images</a></div></li>
                        <li><i class="icon ion-ios-videocam"></i><div><a href="newsfeed-videos.html">Videos</a></div></li>
                    </ul><!--news-feed links ends-->
                    <div id="chat-block">
                        <div class="title">Chat online</div>
                        <ul class="online-users list-inline">

                            <li>
                                <a href="newsfeed-messages.html" title="Linda Lohan">
                                    <img src="http://127.0.0.1:8000/uploads/avatars/uplode/1542462611_afshin-4524524.jpg" alt="user" class="img-responsive profile-photo" />
                                    <span class="online-dot"></span>
                                </a>
                            </li>

                            </ul>
                    </div><!--chat block ends-->
                </div>
                <div class="col-md-7">

                    <!-- Chat Room
                    ================================================= -->
                    <div class="chat-room">
                        <div  class="row">
                            <div class="col-md-5">

                                <!-- Contact List in Left-->
                                <ul class="nav nav-tabs contact-list scrollbar-wrapper scrollbar-outer">
                                    @foreach($allFriends as $friend)
                                            <li>
                                                <a href="#contact-{{$friend->myfriend_id}}" data-toggle="tab" @click="sendIdChat({{$friend->myfriend_id}})">
                                                    <div class="contact">
                                                        <img src="/uploads/avatars/uplode/{{$friend->user->profile->avatar}}" alt="" class="profile-photo-sm pull-left"/>
                                                        <div class="msg-preview">
                                                            <h6>
                                                                @if($friend->user->profile->nickname)
                                                                    {{$friend->user->profile->nickname}}
                                                                @else
                                                                    {{$friend->user->name}}
                                                                @endif
                                                            </h6>
                                                            <p class="text-muted">see you soon</p>
                                                            <small class="text-muted">an hour ago</small>
                                                            <div class="seen"><i class="icon ion-checkmark-round"></i></div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                    @endforeach

                                </ul>

                                <!--Contact List in Left End-->

                            </div>
                            <div class="col-md-7">

                                <!--Chat Messages in Right-->

                                <div class="tab-content scrollbar-wrapper wrapper scrollbar-outer">
                                    @foreach($allFriends as $key => $friend)
                                    <div class="tab-pane" id="contact-{{$friend->myfriend_id}}">
                                        <div class="chat-body">
                                            <ul class="chat-message">
                                                @foreach($allChats as $chat)
                                                    @if($chat->sender_id == $friend->myfriend_id)

                                                        @foreach($chat->chatmesages as $pm)
                                                            <li class="left">
                                                                <img src="/uploads/avatars/uplode/{{$friend->user->profile->avatar}}" alt="" class="profile-photo-sm pull-left" />
                                                                <div class="chat-item">
                                                                    <div class="chat-item-header">
                                                                        <h5>
                                                                            {{$friend->user->name}}
                                                                        </h5>
                                                                        <small class="text-muted">{{$chat->created_at}}</small>
                                                                    </div>
                                                                    <p>{{$pm->text}}</p>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif

                                                    @if($chat->receiver_id == $friend->myfriend_id)

                                                        @foreach($chat->chatmesages as $pm)
                                                            <li class="right">
                                                                <img src="/uploads/avatars/uplode/{{$user->profile->avatar}}" alt="" class="profile-photo-sm pull-right" />
                                                                <div class="chat-item">
                                                                    <div class="chat-item-header">
                                                                        <h5>
                                                                            {{$user->name}}
                                                                        </h5>
                                                                        <small class="text-muted">{{$chat->created_at}}</small>
                                                                    </div>
                                                                    <p>{{$pm->text}}</p>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                </div><!--Chat Messages in Right End-->
                                <div class="send-message" id="contact-{{$friend->myfriend_id}}">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Type your message" v-model="textMessage">
                                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button" @click="sendMessage({{$user->id}})">Send</button>
                      </span>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- Newsfeed Common Side Bar Right
          ================================================= -->
                <div class="col-md-2 static">
                    <div class="suggestions" id="sticky-sidebar">
                        <h4 class="grey">Who to Follow</h4>
                        <div class="follow-user">
                            <img src="images/users/user-11.jpg" alt="" class="profile-photo-sm pull-left" />
                            <div>
                                <h5><a href="timeline.html">Diana Amber</a></h5>
                                <a href="#" class="text-green">Add friend</a>
                            </div>
                        </div>
                        <div class="follow-user">
                            <img src="images/users/user-12.jpg" alt="" class="profile-photo-sm pull-left" />
                            <div>
                                <h5><a href="timeline.html">Cris Haris</a></h5>
                                <a href="#" class="text-green">Add friend</a>
                            </div>
                        </div>
                        <div class="follow-user">
                            <img src="images/users/user-13.jpg" alt="" class="profile-photo-sm pull-left" />
                            <div>
                                <h5><a href="timeline.html">Brian Walton</a></h5>
                                <a href="#" class="text-green">Add friend</a>
                            </div>
                        </div>
                        <div class="follow-user">
                            <img src="images/users/user-14.jpg" alt="" class="profile-photo-sm pull-left" />
                            <div>
                                <h5><a href="timeline.html">Olivia Steward</a></h5>
                                <a href="#" class="text-green">Add friend</a>
                            </div>
                        </div>
                        <div class="follow-user">
                            <img src="images/users/user-15.jpg" alt="" class="profile-photo-sm pull-left" />
                            <div>
                                <h5><a href="timeline.html">Sophia Page</a></h5>
                                <a href="#" class="text-green">Add friend</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection

