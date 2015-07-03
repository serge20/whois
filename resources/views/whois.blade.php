<html>
<head>
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }} ">
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            color: #B0BEC5;
            background-color: #5e5e5e;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
            margin-bottom: 40px;
        }

        .quote {
            font-size: 24px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        {!! Form::open(array('url' => '/list')) !!}

        <div class="form-group">
            {!! Form::label('Domains') !!}
            {!! Form::textarea('domains', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Get Whois!', array('class' => 'btn btn-default')) !!}
        </div>
        {!! Form::close() !!}

        @if(is_array($domainList))
        <table class="table">
            <thead>
            <tr>
                <th> Domain</th>
                <th> Expires</th>
                <th>Email</th>
            </tr>
            </thead>
            @foreach($domainList as $domain)
            <tr>
                <td> {!! $domain['domain'] !!}</td>
                <td> {!! $domain['expires'] !!}</td>
                <td> {!! $domain['email'] !!}</td>
            </tr>
            @endforeach
        </table>
        @endif
    </div>
</div>
</body>
</html>
