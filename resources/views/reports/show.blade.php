@extends('layouts.app')

@section('content')

    <h1>{{ $report->created_date }} の詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>日付</th>
            <td>{{ $report->created_date }}</td>
        </tr>
        <tr>
            <th>{!! Form::label('content', '種類:') !!}</th>
            <th>{!! Form::label('content', '個数:') !!}</th>
        </tr>
        @foreach($reportTypes as $reportType)
        <tr>
            <td>{{ $reportType->type }}</td>
            <td>{{ $reportType->amount }}</td>
        </td>
        @endforeach
        
        <tr>
            <th>内容</th>
            <td>{{ $report->content }}</td>
        </tr>
    </table>
    
    {!! link_to_route('reports.edit', 'この日報を編集', ['id' => $report->id], ['class' => 'btn btn-light']) !!}

    {!! Form::model($report, ['route' => ['reports.destroy', $report->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection