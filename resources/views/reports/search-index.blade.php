@extends('layouts.app')

@section('content')

    <h1>検索結果一覧</h1>
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

@endsection