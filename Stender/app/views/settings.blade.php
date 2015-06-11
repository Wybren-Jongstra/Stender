@extends('layouts.common')
@section('title', 'instellingen')
@section('custom-stylesheets')
    @parent    {{-- Avoid an accidentally overwrite --}}
    {{ HTML::style('/packages/font-awesome/css/font-awesome.css') }}
    {{ HTML::style('/packages/bootstrap-social/bootstrap-social.css') }}
@endsection
@section('custom-script')

    /**
     * Opens a pop-up in the center of current browser window.
     *
     * @param name The name of the pop-up. The name should not contain any whitespace characters.
     *  Also it should not end with "Popup" because that is automatically added.
     * @param url The URL to open in the pop-up.
     * @param height The height of the pop-up.
     * @param width The width of the pop-up.
     * @returns {boolean} Return false. Return (the result) of this method
     *  in the event where it is called (for example in the onclick event) to
     *  prevent the browser from following the actual link.
     */
    function openWindowCentredPopup(name, url, height, width)
    {
    //TODO
    // Add horizontal offset
        // Get the position of the window on the screen.
        // Works with dual screen monitors.
        var windowLeft = window.screenLeft ? window.screenLeft : window.screenX;
        var windowTop  = window.screenTop ? window.screenTop : window.screenY;

        var windowWidth = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth;
        var windowHeight = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight;

        /*
         * Try to center the pop-up in the middle of the window.
         * According to the standard it will not work when it will cause that the pop-up flows out of the screen.
         * If needed, correct the pop-up position with an offset so it won't hide the parent window.
         * This offset is based on the heights of browsers from different vendors.
         * It should be the same for the left and the top.
         */
        var offset = 55;
        var left = (windowLeft + (windowWidth / 2) - (width / 2)) > windowLeft ? (windowLeft + (windowWidth / 2) - (width / 2)) : windowLeft + offset;
        var top = (windowTop + (windowHeight / 2) - (height / 2)) > windowTop ? (windowTop + (windowHeight / 2) - (height / 2)) : windowTop + offset;

        var attr = "height=" + height + ", width=" + width + ", top=" + top + ", left=" + left + ", menubar=no, location=yes, toolbar=no, status=yes, resizable=yes, scrollbars=yes";
        // If a pop-up with the same is already open, it will return the object reference/window handle. Otherwise it will open a new pop-up.
        // Pass the first parameter (url) as an empty string, so that the page will not get redirected if the pop-up is already open and on the correct page.
        var popupWindow = window.open("", (name + "Popup"), attr);

        // Redirect the page of the pop-up if it is not on the correct page.
        if (popupWindow.location != url)
        {
            popupWindow.location = url;
        }

        // Always give the focus to the pop-up
        if (window.focus)
        {
            popupWindow.focus()
        }

        // Make it possible to prevent the browser from following the actual link
        return false;
    }
@endsection
@section('content')
    <div id="content" class="container">
        <div class="row">
            <div id="general-settings" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="general-settings-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Algemene instellingen</h5>
                </div>
                <div id="general-settings-list" class="border-top no-list-signs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul>
                        <li>Voornaam: {{ $data["FirstName"] }}<br/></li>
                        @if(!empty($data['SurnamePrefix']))
                            <li>Tussenvoegsel: {{ $data["SurnamePrefix"] }}<br/></li>
                        @endif
                        <li>Achternaam: {{ $data["Surname"] }}<br/></li>
                        <li>E-mailadres: {{ $data["Email"] }}<br/></li>
                        <li>Profielnaam: {{ $data["DisplayName"] }}<br/></li>
                        <li>Profiel URL: {{ $data["ProfileUrlPart"] }}<br/></li>
                    </ul>
                </div>
            </div>

            <div id="security" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="security-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Beveiliging</h5>
                </div>
                <div id="security-list" class="border-top no-list-signs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <ul>
                        <li>Wachtwoord</li>
                    </ul>
                </div>
            </div>

            <div id="external-accounts" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="external-accounts-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Social media accounts</h5>
                </div>
                <div id="external-accounts-list" class="border-top no-list-signs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @foreach ($accountKinds as $accountKind)
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <a href="" target="_blank" onclick="return openWindowCentredPopup('connect{{ $accountKind['Name'] }}', '{{ URL::to('/social?network='.$accountKind['lcName']) }}', 400, 400)" class="btn btn-social btn-{{ $accountKind['lcName'] }}">
                                <i class="fa fa-{{ $accountKind['lcName'] }}"></i> {{ Lang::get('accounts.connect', ['network' => $accountKind['Name']]) }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
