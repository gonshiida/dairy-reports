@extends('layouts.app')

@section('content')

    <h1>メッセージ一覧</h1>

    @if (count($reports) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>メッセージ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                <tr>
                    <td>{!! link_to_route('reports.show', $report->id, ['id' => $report->id]) !!}</td>
                    <td>{{ $report->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    {!! link_to_route('reports.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}

@endsection