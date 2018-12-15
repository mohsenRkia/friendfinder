@extends('v1.site.layouts.layouts')

@section('title','صفحه اصلی')

@section('content')

    <!-- Top Banner
================================================= -->
    <section id="banner">
        <div class="container">

            <!-- Sign Up Form
            ================================================= -->
            <div class="sign-up-form">
                <a href="index.html" class="logo"><img src="images/logo.png" alt="Friend Finder"/></a>
                <h2 class="text-white">Find My Friends</h2>
                <div class="line-divider"></div>
                <div class="form-wrapper">
                    <p class="signup-text">Signup now and meet awesome people around the world</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <fieldset class="form-group">
                            <input type="text" class="form-control" id="example-name" placeholder="Enter name" name="name" value="{{ old('name') }}">
                        </fieldset>
                        <fieldset class="form-group">
                            <input type="email" class="form-control" id="example-email" placeholder="Enter email" name="email" value="{{ old('email') }}">
                        </fieldset>
                        <fieldset class="form-group">
                            <input type="password" class="form-control" id="example-password" placeholder="Enter a password" name="password">
                        </fieldset>

                        <p>By signning up you agree to the terms</p>
                        <button class="btn-secondary" type="submit">Register</button>
                    </form>

                </div>
                <a href="#">Already have an account?</a>
                <img class="form-shadow" src="images/bottom-shadow.png" alt="" />
            </div><!-- Sign Up Form End -->

            <svg class="arrows hidden-xs hidden-sm">
                <path class="a1" d="M0 0 L30 32 L60 0"></path>
                <path class="a2" d="M0 20 L30 52 L60 20"></path>
                <path class="a3" d="M0 40 L30 72 L60 40"></path>
            </svg>
        </div>
    </section>

    <!-- Features Section
    ================================================= -->
    <section id="features">
        <div class="container wrapper">
            <h1 class="section-title slideDown">social herd</h1>
            <div class="row slideUp">
                <div class="feature-item col-md-2 col-sm-6 col-xs-6 offset-md-2">
                    <div class="feature-icon"><i class="icon ion-person-add"></i></div>
                    <h3>Make Friends</h3>
                </div>
                <div class="feature-item col-md-2 col-sm-6 col-xs-6">
                    <div class="feature-icon"><i class="icon ion-images"></i></div>
                    <h3>Publish Posts</h3>
                </div>
                <div class="feature-item col-md-2 col-sm-6 col-xs-6">
                    <div class="feature-icon"><i class="icon ion-chatbox-working"></i></div>
                    <h3>Private Chats</h3>
                </div>
                <div class="feature-item col-md-2 col-sm-6 col-xs-6">
                    <div class="feature-icon"><i class="icon ion-compose"></i></div>
                    <h3>Create Polls</h3>
                </div>
            </div>
            <h2 class="sub-title">find awesome people like you</h2>
            <div id="incremental-counter" data-value="{{$countUsers}}"></div>
            <p>People Already Signed Up</p>
            <img src="images/face-map.png" alt="" class="img-responsive face-map slideUp hidden-sm hidden-xs" />
        </div>

    </section>

    <!-- Download Section
    ================================================= -->
    <section id="app-download">
        <div class="container wrapper">
            <h1 class="section-title slideDown">download</h1>
            <ul class="app-btn list-inline slideUp">
                <li><button class="btn-secondary"><img src="images/app-store.png" alt="App Store" /></button></li>
                <li><button class="btn-secondary"><img src="images/google-play.png" alt="Google Play" /></button></li>
            </ul>
            <h2 class="sub-title">stay connected anytime, anywhere</h2>
            <img src="images/iPhone.png" alt="iPhone" class="img-responsive" />
        </div>
    </section>

    <!-- Image Divider
    ================================================= -->
    <div class="img-divider hidden-sm hidden-xs"></div>

    <!-- Facts Section
    ================================================= -->
    <section id="site-facts">
        <div class="container wrapper">
            <div class="circle">
                <ul class="facts-list">
                    <li>
                        <div class="fact-icon"><i class="icon ion-ios-people-outline"></i></div>
                        <h3 class="text-white">{{$countUsers}}</h3>
                        <p>People registered</p>
                    </li>
                    <li>
                        <div class="fact-icon"><i class="icon ion-images"></i></div>
                        <h3 class="text-white">{{$countPosts}}</h3>
                        <p>Posts published</p>
                    </li>
                    <li>
                        <div class="fact-icon"><i class="icon ion-checkmark-round"></i></div>
                        <h3 class="text-white">{{$onlineUsersNumber}}</h3>
                        <p>People online</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Live Feed Section
    ================================================= -->
    <section id="live-feed">
        <div class="container wrapper">
            <h1 class="section-title slideDown">live feed</h1>
            <ul class="online-users list-inline slideUp">
                @foreach($usersOnline as $onlines)
                <li>
                    <a href="{{route('user.profile.timeline',['id' => $onlines->id,'name' => $onlines->name])}}" title="{{$onlines->name}}">
                        <img src="/uploads/avatars/uplode/{{$onlines->profile->avatar}}" alt="" class="img-responsive profile-photo" />
                        <span class="online-dot"></span>
                    </a>
                </li>
                @endforeach
            </ul>
            <h2 class="sub-title">see what’s happening now</h2>
            <div class="row">
                <div class="col-md-4 col-sm-6 offset-md-2">
                    @foreach($logsFirst as $fLogs)
                    <div class="feed-item">
                        <img src="/uploads/avatars/uplode/{{$fLogs->user->profile->avatar}}" alt="user" class="img-responsive profile-photo-sm" />
                        <div class="live-activity">
                            <p><a href="{{route('user.profile.timeline',['id' => $fLogs->user->id,'name' => $fLogs->user->name])}}" class="profile-link">{{$fLogs->user->name}}</a>
                                @switch($fLogs->activity)
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
                            <p class="text-muted">{{$fLogs->created_at}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-md-4 col-sm-6">
                    @foreach($logsSecond as $sLogs)
                    <div class="feed-item">
                        <img src="/uploads/avatars/uplode/{{$sLogs->user->profile->avatar}}" alt="user" class="img-responsive profile-photo-sm" />
                        <div class="live-activity">
                            <p><a href="{{route('user.profile.timeline',['id' => $sLogs->user->id,'name' => $sLogs->user->name])}}" class="profile-link">{{$sLogs->user->name}}</a>
                                @switch($sLogs->activity)
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
                            <p class="text-muted">{{$sLogs->created_at}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>



@endsection