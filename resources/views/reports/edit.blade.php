@extends('layouts.app')

@section('content')

    <h1>id: {{ $report->created_date }} の編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($report, ['route' => ['reports.update', $report->id], 'method' => 'put']) !!}
        
                <div class="form-group">
                    {!! Form::label('content', '作成日:') !!}
                    {!! Form::text('created_date', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <table class="table table-bordered">
                        <tr>
                            <th>{!! Form::label('content', '種類:') !!}</th>
                            <th>{!! Form::label('content', '個数:') !!}</th>
                        </tr>
                        @foreach($reportTypes as $reportType)
                        <tr>
                            <td>{!! Form::select('type[]', $typeOptions, array_search($reportType->type, $typeOptions), ['class' => 'form-control']) !!}</td>
                            <td>{!! Form::text('amount[]', $reportType->amount, ['class' => 'form-control']) !!}</td>
                        </td>
                        @endforeach
                        @for ($i = 0; $i < 5 - $reportTypes->count(); $i++)
                            <tr>
                                <td>{{Form::select('type[]', $typeOptions, ['class' => 'form-control'])}}</td>
                                <td>{!! Form::text('amount[]', null, ['class' => 'form-control']) !!}</td>
                            </tr>
                        @endfor
                    </table>
                </div>
                <div class="form-group">
                    {!! Form::label('content', '内容:') !!}
                    {{ Form::textarea('content', null, ['size' => '60x8']) }}
                </div>
        
                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
        
            {!! Form::close() !!}
        </div>
    </div>
    
@endsection