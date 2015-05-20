<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//NL" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <title>Stender home</title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <link type="text/css" href="css/bootstrap.css" rel="stylesheet" media="screen, projection" />
    <link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" media="screen, projection" />

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
    <body>
        <div id="header" class="container-fluid">
            <div class="row">
                <a id="logo" class="col-lg-3" href="/"></a>
                <div class="search col-lg-offset-4 col-lg-3">
                    {{ Form::open(array('url' => 'searchUser')) }}
                        <div class="form-group col-lg-12">
                            <div class="input-group">
                                {{ Form::text('userName', '', array('class' => 'form-control', 'id' => 'inputName', 'placeholder' => 'Naam', 'required' => 'required')) }}
                                <span class="input-group-btn">
                                    {{ Form::submit('Zoek', array('type' => 'button', 'class' => 'btn btn-default'))}}
                                </span>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="menu col-lg-offset-1 col-lg-3">
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="dropdown "><a href="#" id="drop1" data-toggle="dropdown" class="dropdown-toggle" role="button">About <b class="caret"></b></a>
                                <ul role="menu" class="dropdown-menu" aria-labelledby="drop1">
                                    <li role="presentation"><a href="#" role="menuitem">Overview</a></li>
                                    <li role="presentation"><a href="#" role="menuitem">Team Bios</a></li>
                                    <li role="presentation"><a href="#" role="menuitem">Customers</a></li>
                                    <li role="presentation"><a href="#" role="menuitem">Careers</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>


                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Tijdlijn</a></li>
                                <li><a href="#">Profiel</a></li>
                                <li><a href="#">Connecties</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Account</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
		@yield('content')
	</body>
</html>
