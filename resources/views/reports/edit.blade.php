@extends('layouts.app')

@section('content')

    <h1>{{ $report->created_date }} の編集ページ</h1>

    <div class="row">
        <div class="col-6">
        
                <div class="form-group">
                    {!! Form::label('content', '作成日:') !!}
                    {!! Form::text('created_date', $report->created_date, ['class' => 'form-control', 'form' => 'bulk-update']) !!}
                </div>
                <div class="form-group">
                    <table class="table table-bordered">
                        <tr>
                            <th>{!! Form::label('content', '種類:') !!}</th>
                            <th>{!! Form::label('content', '個数:') !!}</th>
                        </tr>
                        @foreach ($reportTypes as $reportType)
                        <tr>
                            {{Form::hidden('id[]', $reportType->id, ['form' => 'bulk-update'])}}
                            <td>{!! Form::select('type[]', $typeOptions, array_search($reportType->type, $typeOptions), ['class' => 'form-control', 'form' => 'bulk-update']) !!}</td>
                            <td>{!! Form::text('amount[]', $reportType->amount, ['class' => 'form-control', 'form' => 'bulk-update']) !!}</td>
                            <td>
                                {!! Form::model($report, ['route' => ['reportTypes.destroy', $reportType->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        @for ($i = 0; $i < 5 - $reportTypes->count(); $i++)
                            <tr>
                                <td>{{Form::select('new_type[]', $typeOptions, null, ['class' => 'form-control', 'form' => 'bulk-update'])}}</td>
                                <td>{!! Form::text('new_amount[]', null, ['class' => 'form-control', 'form' => 'bulk-update']) !!}</td>
                            </tr>
                        @endfor
                    </table>
                </div>
                <div class="form-group">
                    {!! Form::label('content', '内容:') !!}
                    {{ Form::textarea('content', $report->content, ['size' => '60x8', 'form' => 'bulk-update']) }}
                </div>
            {!! Form::model($report, ['route' => ['reports.update', $report->id], 'method' => 'put', 'id' => 'bulk-update']) !!}
                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    
@endsection