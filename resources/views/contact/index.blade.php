@extends('layouts.app-master')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

@section('content')
<div class="columns" style="margin-top:20px;">

    <div class="column">
        <h2 class="title">
            Contacts
        </h2>
     

            <a href="{{ route('contact.create') }}" class="button is-primary is-small" style="float:right;text-decoration: none;">
                <span class="icon is-small">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                </span>
                <span>Add New Contact</span>
            </a>
        <?php
        ?>
        <table class="table is-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>created source</th>
                    <th>Created At</th>
                    <th colspan="2">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse($uploadedFiles as $uploadedFile)
                <tr>
                    <td>
                        {{ $uploadedFile->name }}
                    </td>

                   
                    <td>
                        {{ $uploadedFile->email }}
                    </td>

                    <td>
                        {{ $uploadedFile->phone }}
                    </td>

                    <td>
                        {{ $uploadedFile->source }}
                    </td>


                    

                    <td>
                        {{ $uploadedFile->created_at }}
                    </td>
                        <td>
                            <a href="{{ url('contact/delete/'.$uploadedFile->id) }}" data-value="{{$uploadedFile->id}}" target="_blank" class="deletecand button is-link is-small" style="background: maroon;text-decoration:none">
                                <span class="icon is-small">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </span>
                                <span>Delete</span>
                            </a>
                        </td>
                        <td>
                            <a href="{{ url('contact/edit/'.$uploadedFile->id) }}" data-value="{{$uploadedFile->id}}" target="_blank" class="button is-link is-small" style="background: green;text-decoration:none">
                                <span class="icon is-small">
                                    <i class="fa fa-pen" aria-hidden="true"></i>
                                </span>
                                <span>Edit</span>
                            </a>
                        </td>
                </tr>
                @empty
                <tr>
                    <td>No data found</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection