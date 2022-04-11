@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        @component('components.success', [
            'message' => session('status'),
        ])
        @endcomponent
    @endif
    @include('admin.students.partials.student-list')
</div>            
@endsection
