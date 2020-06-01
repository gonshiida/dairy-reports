@extends('layouts.app')

@section('content')

    <h1>日報検索</h1>
    {!! Form::open(array('route' => 'reports.search', 'method' => 'get')) !!}
    {!! Form::label('period', '日付:') !!}
        <?php $today = \Carbon\Carbon::now(); ?>
    
        {{Form::selectRange('from_year', 2020, 2030, '', ['placeholder' => ''])}}年
        {{Form::selectRange('from_month', 1, 12, '', ['placeholder' => ''])}}月
        {{Form::selectRange('from_day', 1, 31, '', ['placeholder' => ''])}}日
        
        <span>〜</span>
        
        {{Form::selectRange('to_year', 2020, 2030, '', ['placeholder' => ''])}}年
        {{Form::selectRange('to_month', 1, 12, '', ['placeholder' => ''])}}月
        {{Form::selectRange('to_day', 1, 31, '', ['placeholder' => ''])}}日<br>
        
        {!! Form::label('content', 'キーワード:') !!}
        {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
        
        {!! Form::submit('検索', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

    @if($reports->count())
        @if($isSearch)
            <table class="table table-bordered" border="1">
                <tr>
                @foreach($totals as $total)
                    <th>{{ $total->type }}</td>
                @endforeach
                </tr>
                <tr>
                @foreach($totals as $total)
                    <td>{{ $total->total }}</td>
                @endforeach
                </tr>
            </table>  
        @endif
    <table class="table table-bordered" border="1">
        <tr>
            <th>日付</th>
            <th>日報内容</th>
        </tr>
        @foreach ($reports as $report)
            <tr>
                <td>{!! link_to_route('reports.show', $report->created_date, ['created_date' => $report->id]) !!}</td>
                <td>{{ $report->content }}</td>
            </tr>
        @endforeach
    </table>
     
    @else
    <p>見つかりませんでした。</p>
    @endif
    
    {{ $reports->appends(request()->input())->links('pagination::bootstrap-4') }}

@endsection