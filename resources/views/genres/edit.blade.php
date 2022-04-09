@extends('layouts.main')

@section('content')
    <div class="d-flex align-items- mb-3">
        <h1 class="display-4 me-3">Edit genre</h1>
        @if($genre != null)
        <form class="d-flex align-items-center" action="{{ route('genres.destroy', [ 'genre' => $genre->id ]) }}" method="POST">
            @method("delete")
            @csrf

            <button class="btn btn-outline-danger"><i class="fa-solid fa-trash-can me-2"></i>Delete</button>
        </form>
        @endif
    </div>

    <form action="{{ $form_action }}" method="POST">
        @method($form_method)
        @csrf

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $genre?->name ?? '') }}" placeholder="name">
            <label for="name">Name</label>
            @error('style')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <select class="form-control form-select @error('style') is-invalid @enderror"
                    id="style" name="style"
                    value="{{ request()->input('style', $genre?->style) }}">
                <option {{ '' == old('style', $genre?->style ?? '') ? 'selected' : '' }} disabled>
                    Select a style
                </option>
                @foreach(\App\Models\GenreStyle::GetValues() as $style)
                    <option {{ $style == old('style', $genre?->style ?? '') ? 'selected' : '' }}
                            value="{{ $style }}">{{ $style }}</option>
                @endforeach
            </select>
            @error('style')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <label for="style">Style</label>
        </div>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
@endsection
