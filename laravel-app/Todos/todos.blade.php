@extends('layouts.app')

@section('content')
<h3>My Todos</h3>
@foreach($todos as $todo)
<article>
    <header>
        <small>Due: {{$todo['due_date']}}</small>
    </header>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h3>{{$todo['description']}}</h3>
            @php
            $color = 'red';
            $status = 'Pending';

            if ($todo['is_completed']) {
                $color = 'green';
                $status = 'Completed';
            }
            @endphp
        <span class="badge" style="background-color: {{$color}}; color: white; padding: 0.25rem 0.5rem; border-radius: 0.25rem;">
        {{$status}}
    </span>
    </div>
</article>
@endforeach
@endsection
