@extends('layouts.app')

@section('content')

    <h1>新規日報作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($report, ['route' => 'reports.store']) !!}
        
                <div class="form-group">
                    {!! Form::label('content', '作成日:') !!}
                    {!! Form::text('created_date',\Carbon\Carbon::now()->toDateString(), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <table class="table table-bordered">
                        <tr>
                            <th>{!! Form::label('content', '種類:') !!}</th>
                            <th>{!! Form::label('content', '個数:') !!}</th>
                        </tr>
                        @for ($i = 0; $i < 5; $i++)
                        <tr>
                            <td>{{Form::select('type[]', $typeOptions, ['class' => 'form-control'])}}</td>
                            <td>{!! Form::text('amount[]', null, ['class' => 'form-control']) !!}</td>
                        </td>
                        @endfor
                        
                    </table>
                </div>
                <div class="form-group">
                    {!! Form::label('content', '備考欄:') !!}
                    {{ Form::textarea('content', null, ['size' => '60x8']) }}
                </div>
        
                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
        
            {!! Form::close() !!}
        </div>
    </div>

@endsection