@extends('layouts.common')
@section('title', 'instellingen')
@section('custom-stylesheets')
    @parent    {{-- Avoid an accidentally overwrite --}}
    {{ HTML::style('packages/font-awesome/css/font-awesome.css') }}
    {{ HTML::style('packages/bootstrap-social/bootstrap-social.css') }}
@endsection
@section('custom-scripts')
    @parent    {{-- Avoid an accidentally overwrite --}}
    {{ HTML::script('js/popup.js') }}
@endsection
@section('custom-jquery')
    findPopups();
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

            <div id="password" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="password-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border-bottom">
                    <h5>Wachtwoord</h5>
                </div>
                <div id="password-body" class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    {{ Form::open(['url' => 'password/change'])}}
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">&times;</a>
                            {{ implode('', $errors->all(':message'))}}
                        </div>
                    @endif
                    <div class="form-group">
                        {{ Form::password('oldPassword', array('placeholder' => ucfirst(Lang::get('attributes.old_password')), 'class' => 'form-control', 'required' => 'required'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', array('placeholder' => ucfirst(Lang::get('attributes.new_password')), 'class' => 'form-control', 'required' => 'required'))}}
                    </div>
                    <div class="form-group">
                        {{ Form::password('password_confirmation', array('placeholder' => ucfirst(Lang::get('attributes.confirm_password')), 'class' => 'form-control', 'required' => 'required'))}}
                    </div>
                    {{ Form::submit(ucfirst(Lang::get('attributes.change_password')), array('class' => 'btn btn-warning col-xs-12 col-sm-12 col-md-12'))}}

                    {{ Form::close() }}
                </div>
            </div>

            <div id="external-accounts" class="spacing-top rounded-div-border col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="external-accounts-header" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h5>Social media accounts</h5>
                </div>
                <div id="external-accounts-list" class="border-top no-list-signs col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @foreach ($externalAccountKinds as $externalAccountKind)
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <a href="{{ URL::to('/social?network='.$externalAccountKind['accountKind']['lcName']) }}" target="_blank" data-rel="popup" data-popup-name="connect{{ $externalAccountKind['accountKind']['Name'] }}" data-popup-height="{{ $externalAccountKind['PopupHeight'] }}" data-popup-width="{{ $externalAccountKind['PopupWidth'] }}" class="btn btn-social btn-{{ $externalAccountKind['accountKind']['lcName'] }}">
                                <i class="fa fa-{{ $externalAccountKind['accountKind']['lcName'] }}"></i> {{ Lang::get('external_accounts.connect', ['network' => $externalAccountKind['accountKind']['Name']]) }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
