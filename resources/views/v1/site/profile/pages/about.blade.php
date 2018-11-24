@extends('v1.site.profile.profile')


@section('details')

    <div class="col-md-7">

        <!-- About
        ================================================= -->
        <div class="about-profile">
            <div class="about-content-block">
                <h4 class="grey"><i class="ion-ios-information-outline icon-in-title"></i>Personal Information</h4>
                <p>
                    {{$profile->bio}}
                </p>
            </div>
            <div class="about-content-block">
                <h4 class="grey"><i class="ion-ios-briefcase-outline icon-in-title"></i>Work Experiences</h4>
                <div class="organization">
                    <img src="images/envato.png" alt="" class="pull-left img-org" />
                    <div class="work-info">
                        <h5>Envato</h5>
                        <p>Seller - <span class="text-grey">1 February 2013 to present</span></p>
                    </div>
                </div>
                <div class="organization">
                    <img src="images/envato.png" alt="" class="pull-left img-org" />
                    <div class="work-info">
                        <h5>Envato</h5>
                        <p>Seller - <span class="text-grey">1 February 2013 to present</span></p>
                    </div>
                </div>
                <div class="organization">
                    <img src="images/envato.png" alt="" class="pull-left img-org" />
                    <div class="work-info">
                        <h5>Envato</h5>
                        <p>Seller - <span class="text-grey">1 February 2013 to present</span></p>
                    </div>
                </div>
            </div>
            <div class="about-content-block">
                <h4 class="grey"><i class="ion-ios-location-outline icon-in-title"></i>Location</h4>
                <p>
                    {{$profile->location}}
                </p>
            </div>
            <div class="about-content-block">
                <h4 class="grey"><i class="ion-ios-heart-outline icon-in-title"></i>Interests</h4>
                <ul class="interests list-inline">
                    <li><span class="int-icons" title="Bycycle riding"><i class="icon ion-android-bicycle"></i></span></li>
                    <li><span class="int-icons" title="Photography"><i class="icon ion-ios-camera"></i></span></li>
                    <li><span class="int-icons" title="Shopping"><i class="icon ion-android-cart"></i></span></li>
                    <li><span class="int-icons" title="Traveling"><i class="icon ion-android-plane"></i></span></li>
                    <li><span class="int-icons" title="Eating"><i class="icon ion-android-restaurant"></i></span></li>
                </ul>
            </div>
            <div class="about-content-block">
                <h4 class="grey"><i class="ion-ios-chatbubble-outline icon-in-title"></i>Language</h4>
                <ul>
                    <li><a href="">Russian</a></li>
                    <li><a href="">English</a></li>
                </ul>
            </div>
        </div>
    </div>

@endsection