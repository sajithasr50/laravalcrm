@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="container">
    <div class="columns">
        <div class="column">

            <h1 class="title">Add New Contact</h1>
            @if ($errors->any())
            <div class="notification is-danger is-light">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name" required="required" autofocus>
                    @if ($errors->has('name'))
                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email" required="required" autofocus>
                    @if ($errors->has('email'))
                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <input type="number" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="phone" required="required" autofocus>
                    @if ($errors->has('phone'))
                    <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                    @endif
                </div>


        </div>

        <div class="field is-grouped mt-3">
            <div class="control">
                <button type="submit" class="button is-info">Save</button>
            </div>
            <div class="control">
                <a href="{{ route('contact.index') }}" class="button is-light">Cancel</a>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection