@extends('layouts.app')

@section('content')

    <h1>id = {{ $report->id }} のメッセージ詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $report->id }}</td>
        </tr>
        <tr>
            <th>メッセージ</th>
            <td>{{ $report->content }}</td>
        </tr>
    </table>
    
    {!! link_to_route('reports.edit', 'このメッセージを編集', ['id' => $report->id], ['class' => 'btn btn-light']) !!}

    {!! Form::model($report, ['route' => ['reports.destroy', $report->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection