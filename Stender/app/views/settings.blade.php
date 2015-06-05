@extends('layouts.common')
@section('title', 'instellingen')
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
                    <ul>
                        {{--@foreach ($accounts as $account)--}}
                        {{--<li>{{ $account }}</li>--}}
                        {{--@endforeach--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
