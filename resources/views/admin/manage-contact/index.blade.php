@extends('admin-layouts.main-ui')

@section('content')
    <div class="col-12">
        <h2>Manage Contact Us</h2>
        <div class="separator mb-5"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card card-tasks">
                <div class="card-body">
                    <form class="form form-horizontal"
                        action="{{ route('admin.contact.update', ['id' => isset($contact) ? $contact->id : $count + 1]) }}"
                        method="POST" name="add_post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input name="id" type="hidden" value="{{ isset($contact) ? $contact->id : null }}">
                        <div class="form-group row">
                            <label for="meta_title" class="col-sm-2 col-form-label text-right">meta title</label>
                            <div class="col-sm-10">
                                <input type="text" name="meta_title" id="meta_title" class="form-control" required
                                    placeholder="title" value="{{ $contact->meta_title ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meta_description" class="col-sm-2 col-form-label text-right">meta
                                description</label>
                            <div class="col-sm-10">
                                <input type="text" name="meta_description" id="meta_description" class="form-control"
                                    placeholder="description" value="{{ $contact->meta_description ?? '' }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meta_keyword" class="col-sm-2 col-form-label text-right">meta keyword</label>
                            <div class="col-sm-10">
                                <input type="text" name="meta_keyword" id="meta_keyword" class="form-control"
                                    placeholder="keyword" value="{{ $contact->meta_keyword ?? '' }}">
                            </div>
                        </div>
                        {{-- after meta --}}
                        @php
                            // dd($contact->contact);
                            if (isset($contact)) {
                                $contact = json_decode($contact->contact);
                            }
                            // echo
                        @endphp
                        {{-- {{$contact}} --}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-right">location</label>
                            <div class="col-sm-10">
                                <input type="text" name="location" id="location" class="form-control" placeholder="location"
                                    value="{{ $contact->location ?? '' }}">
                            </div>
                        </div>

                        {{-- {{  json_encode($contact) }} --}}
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-right"></label>
                            <div class="col-sm-10">
                                <label for="name" class="col-form-label text-right">latitude</label>
                                <div class="col-sm-6">
                                    <input type="text" name="latitude" id="latitude" class="form-control"
                                        placeholder="latitude" value="{{ $contact->latitude ?? '' }}">
                                </div>
                                <label for="name" class="col-form-label text-right">longitude</label>
                                <div class="col-sm-6">
                                    <input type="text" name="longitude" id="longitude" class="form-control"
                                        placeholder="longitude" value="{{ $contact->longitude ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label text-right">email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" id="email" class="form-control" placeholder="email"
                                    value="{{ $contact->email ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label text-right">phone</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="phone"
                                    value="{{ $contact->phone ?? '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label text-right">time period</label>
                            <div class="col-sm-10">
                                <input type="text" name="time" id="time" class="form-control" placeholder="time"
                                    value="{{ $contact->time ?? '' }}">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" id="submit-all">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <script type="text/javascript">
        // CKEDITOR.replace('editor1');

    </script>
    <style>
        .card-tasks {
            height: 100%;
        }

    </style>
@endsection
