@extends('layouts.main')

@section('content')
    <div class="header-green text-center align-middle">
        <div class="row align-items-center h-100">
            <div class="mx-auto">
                <div class="h-100 justify-content-center">
                    <div>
                        <label> Home > Contact Us</label>
                        <h1>Contact Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- container --}}
    <div class="container" style="margin-top: 80px">
        @if (session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif

        @if (session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if (count($errors) > 0)
            @foreach ($errors0 > all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif

        {{-- map --}}
        <div>
            <iframe width="100%" height="450" style="border:0" loading="lazy" allowfullscreen
                src="https://www.google.com/maps/embed/v1/view?key=AIzaSyBd0EV68eSZLhtek6PohrCxMuxCdZ6b61w&center={{ $contact->contact['latitude'] ?? '18' }} ,{{ $contact->contact['longitude'] ?? '99' }} &zoom=18&maptype=satellite">
            </iframe>
        </div>
        {{-- text --}}
        <div class="row text-center mt-5 mb-5">
            <div class="col-12">
                <p class="text-middle-title"><b>Let us know what you have in mind </b> </p>
            </div>
            <div class="col-12">
                <p class="text-middle-sub-title"> Visit our shop to see amazing creations from our designers</p>
            </div>

        </div>
        {{-- address detail --}}

        @php
            // dd($contact->contact);
            if (isset($contact)) {
                $contact = json_decode($contact->contact);
            }
            // echo
        @endphp
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-1">
                        <img src="{{ asset('img/svg-icons/location.svg') }}" alt="location-icon" width="30" height="38" />
                    </div>
                    <div class="col-11 my-auto align-middle pl-4">
                        <div class="h-100 justify-content-center ">
                            {{ $contact->location ?? '999 Bangkok Thailand 10400' }}
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-1">
                        <img src="{{ asset('img/svg-icons/mail.svg') }}" alt="location-icon" width="30" height="38" />
                    </div>
                    <div class="col-11 my-auto align-middle pl-4">
                        <div class="h-100 justify-content-center ">
                            {{ $contact->email ?? 'info@beyond-silver.com' }}
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-1">
                        <img src="{{ asset('img/svg-icons/phone-outline.svg') }}" alt="location-icon" width="30"
                            height="38" />
                    </div>
                    <div class="col-11 my-auto align-middle pl-4">
                        <div class="h-100 justify-content-center">
                            {!! $contact->phone ?? '+66 9999 9999 <br> +66 6666 6666' !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-1">
                        <img src="{{ asset('img/svg-icons/time.svg') }}" alt="location-icon" width="30" height="38" />
                    </div>
                    <div class="col-11 my-auto align-middle pl-4">
                        <div class="h-100 justify-content-center ">
                            {{ $contact->time ?? 'monday - Saturday 10.00am - 5.00pm. Sunday 11.00 - 4.00pm' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <form id="contact-form" method="post" action="{{ route('subscribe.store') }}" role="form">
                    @csrf
                    <div class="controls">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- <label for="form_name">Firstname *</label> --}}
                                    <input id="form_name" type="text" name="name" class="form-control"
                                        placeholder="Please enter your firstname *" required="required"
                                        data-error="Firstname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- <label for="form_lastname">Lastname *</label> --}}
                                    <input id="form_lastname" type="text" name="surname" class="form-control"
                                        placeholder="Please enter your lastname *" required="required"
                                        data-error="Lastname is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- <label for="form_email">Email *</label> --}}
                                    <input id="form_email" type="email" name="email" class="form-control"
                                        placeholder="Please enter your email *" required="required"
                                        data-error="Valid email is required.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- <label for="form_phone">Phone</label> --}}
                                    {{-- <input id="form_phone" type="tel" name="phone" class="form-control"
                                        placeholder="Please enter your phone"> --}}
                                    <input type="text"  class="form-control" id="phone" name="phone" onkeypress="return numberPressed(event);" placeholder="(089)9999999" />
                                    {{-- <input id="phone" type="tel" class="form-control" name="phone" value="+66 (__) __-____"> --}}
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{-- <label for="form_message">Message *</label> --}}
                                    <textarea id="form_message" name="message" class="form-control"
                                        placeholder="Message for me *" rows="4" required="required"
                                        data-error="Please,leave us a message."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send" value="SUBMIT">
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted"><strong>*</strong> These fields are required. Contact form
                                    template by <a href="https://bootstrapious.com" target="_blank">Bootstrapious</a>.
                                </p>
                            </div>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
        // Format the phone number as the user types it
        document.getElementById('phone').addEventListener('keyup', function(evt) {
            var phoneNumber = document.getElementById('phone');
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            phoneNumber.value = phoneFormat(phoneNumber.value);
        });

        // We need to manually format the phone number on page load
        document.getElementById('phone').value = phoneFormat(document.getElementById('phone').value);

        // A function to determine if the pressed key is an integer
        function numberPressed(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 36 || charCode > 40)) {
                return false;
            }
            return true;
        }

        // A function to format text to look like a phone number
        function phoneFormat(input) {
            // Strip all characters from the input except digits
            input = input.replace(/\D/g, '');

            // Trim the remaining input to ten characters, to preserve phone number format
            input = input.substring(0, 10);

            // Based upon the length of the string, we add formatting as necessary
            var size = input.length;
            if (size == 0) {
                input = input;
            } else if (size < 4) {
                input = '(' + input;
            } else if (size < 7) {
                input = '(' + input.substring(0, 3) + ') ' + input.substring(3, 6);
            } else {
                input = '(' + input.substring(0, 3) + ') ' + input.substring(3, 6) + ' - ' + input.substring(6, 10);
            }
            return input;
        }

    </script>
    <style>
        .btn {
            /* padding: 0.375rem 2.75rem; */
            background: #81D8D0;
            border: 1px solid #81D8D0;
            box-sizing: border-box;
            border-radius: 5px;
            font-family: Open Sans;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 19px;
            text-align: center;
            text-transform: uppercase;
            color: #FFFFFF;
        }

        .bg-dark {
            background-color: #81D8D0 !important;
        }

        .text-middle-title {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: normal;
            font-size: 24px;
            line-height: 36px;
            /* or 100% */

            text-align: center;
            text-transform: uppercase;

            color: #797979;
        }

        .text-middle-sub-title {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: normal;
            font-size: 18px;
            line-height: 36px;
            /* or 100% */

            text-align: center;
            text-transform: uppercase;

            color: #797979;
        }

        .card {
            border: none;
        }

    </style>
@endsection
