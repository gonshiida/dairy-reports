@extends('layouts.app')

@section('content')


    @if (Auth::check())
    <h1>日報一覧</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>日報内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                <tr>
                    <td>{!! link_to_route('reports.show', $report->created_date, ['created_date' => $report->id]) !!}</td>
                    <td>{{ $report->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
         {!! link_to_route('reports.create', '新規の投稿', [], ['class' => 'btn btn-primary']) !!}
        @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Daily-Report</h1>
                    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}

        </div>
    </div>
            </div>
        </div>
    @endif

@endsection