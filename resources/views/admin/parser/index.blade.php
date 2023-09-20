@extends('layouts.admin')
@section('title')Спарсить новости/курсы @parent @stop
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Спарсить новости/курсы</h1>
    </div>
    @include('admin.message')
    @foreach($rates as $rate)
        <p>{{ $rate['CharCode'] }}: {{ round($rate['Value'], 2) }} &#8381;
            @if($rate['diff'] > 0)
                <span style="color: #198754">▲</span>(+
            @else
                <span style="color: #b50000">▼</span>(
            @endif
            {{ round($rate['diff'], 2) }} &#8381;)</p>
    @endforeach
    <div class="btn-toolbar mb-2 mb-md-0">
    <form method="post" action="{{ route('admin.parser.run') }}" enctype="multipart/form-data" id="parseForm" name="parseForm">
        @csrf
        <div class="form-group">
            <input type="radio" id="news" name="type" value="news" class="radio" @checked(old('type') !== 'rate')/><label for="news">Новости</label>
            <input type="radio" id="rate" name="type" value="rate" class="radio"  @checked(old('type') === 'rate')/><label for="rate">Курсы валют</label>
        </div>
        <div class="form-group form-group-2">
            <label for="categories">{{ __('News Source') }}</label>
            <br>
            @error('newsSources') <strong class="text-danger">{{ $message }}</strong> @enderror
            <select class="form-control" multiple name="sources[]" id="sources">
                @foreach($newsSources as $source)
                    <option @selected(old('source') === $source->id) value="{{ $source->id }}">{{ $source->title }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button type="submit" class="btn btn-success" id="subbutton">Run</button>
    </form>
    </div>
@endsection
@push('scripts')
    <script>

    </script>
@endpush
