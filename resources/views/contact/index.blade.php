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
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-1">
                        <img src="{{ asset('img/svg-icons/location.svg') }}" alt="location-icon" width="30" height="38" />
                    </div>
                    <div class="col-11 my-auto align-middle pl-4">
                        <div class="h-100 justify-content-center ">
                            {{ $contact->contact['location'] ?? '999 Bangkok Thailand 10400' }}
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-1">
                        <img src="{{ asset('img/svg-icons/mail.svg') }}" alt="location-icon" width="30" height="38" />
                    </div>
                    <div class="col-11 my-auto align-middle pl-4">
                        <div class="h-100 justify-content-center ">
                            {{ $contact->contact['email'] ?? 'info@beyond-silver.com' }}
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
                            {!! $contact->contact['phone'] ?? '+66 9999 9999 <br> +66 6666 6666' !!}
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-1">
                        <img src="{{ asset('img/svg-icons/time.svg') }}" alt="location-icon" width="30" height="38" />
                    </div>
                    <div class="col-11 my-auto align-middle pl-4">
                        <div class="h-100 justify-content-center ">
                            {{ $contact->contact['time'] ?? 'monday - Saturday 10.00am - 5.00pm. Sunday 11.00 - 4.00pm' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <form id="contact-form" method="post" action="contact.php" role="form">
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
                                    <input id="phone" type="tel" class="form-control" name="phone"
                                        value="+66 (__) __-____"
                                        pattern="^\+66(\s+)?\(?(17|25|29|33|44)\)?(\s+)?[0-9]{3}-?[0-9]{2}-?[0-9]{2}$" //
                                        phones at Belarus required>
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
        window.onload = function() {
            MaskedInput({
                elm: document.getElementById('phone'), // select only by id
                format: '+66 (__) __-____',
                separator: '+66 (   )-'
            });

            MaskedInput({
                elm: document.getElementById('phone2'), // select only by id
                format: '+66 (__) __-____',
                separator: '+66 ()-'
            });
        };
        // masked_input_1.4-min.js
        // angelwatt.com/coding/masked_input.php
        (function(a) {
            a.MaskedInput = function(f) {
                if (!f || !f.elm || !f.format) {
                    return null
                }
                if (!(this instanceof a.MaskedInput)) {
                    return new a.MaskedInput(f)
                }
                var o = this,
                    d = f.elm,
                    s = f.format,
                    i = f.allowed || "0123456789",
                    h = f.allowedfx || function() {
                        return true
                    },
                    p = f.separator || "/:-",
                    n = f.typeon || "_YMDhms",
                    c = f.onbadkey || function() {},
                    q = f.onfilled || function() {},
                    w = f.badkeywait || 0,
                    A = f.hasOwnProperty("preserve") ? !!f.preserve : true,
                    l = true,
                    y = false,
                    t = s,
                    j = (function() {
                        if (window.addEventListener) {
                            return function(E, C, D, B) {
                                E.addEventListener(C, D, (B === undefined) ? false : B)
                            }
                        }
                        if (window.attachEvent) {
                            return function(D, B, C) {
                                D.attachEvent("on" + B, C)
                            }
                        }
                        return function(D, B, C) {
                            D["on" + B] = C
                        }
                    }()),
                    u = function() {
                        for (var B = d.value.length - 1; B >= 0; B--) {
                            for (var D = 0, C = n.length; D < C; D++) {
                                if (d.value[B] === n[D]) {
                                    return false
                                }
                            }
                        }
                        return true
                    },
                    x = function(C) {
                        try {
                            C.focus();
                            if (C.selectionStart >= 0) {
                                return C.selectionStart
                            }
                            if (document.selection) {
                                var B = document.selection.createRange();
                                return -B.moveStart("character", -C.value.length)
                            }
                            return -1
                        } catch (D) {
                            return -1
                        }
                    },
                    b = function(C, E) {
                        try {
                            if (C.selectionStart) {
                                C.focus();
                                C.setSelectionRange(E, E)
                            } else {
                                if (C.createTextRange) {
                                    var B = C.createTextRange();
                                    B.move("character", E);
                                    B.select()
                                }
                            }
                        } catch (D) {
                            return false
                        }
                        return true
                    },
                    m = function(D) {
                        D = D || window.event;
                        var C = "",
                            E = D.which,
                            B = D.type;
                        if (E === undefined || E === null) {
                            E = D.keyCode
                        }
                        if (E === undefined || E === null) {
                            return ""
                        }
                        switch (E) {
                            case 8:
                                C = "bksp";
                                break;
                            case 46:
                                C = (B === "keydown") ? "del" : ".";
                                break;
                            case 16:
                                C = "shift";
                                break;
                            case 0:
                            case 9:
                            case 13:
                                C = "etc";
                                break;
                            case 37:
                            case 38:
                            case 39:
                            case 40:
                                C = (!D.shiftKey && (D.charCode !== 39 && D.charCode !== undefined)) ? "etc" :
                                    String.fromCharCode(E);
                                break;
                            default:
                                C = String.fromCharCode(E);
                                break
                        }
                        return C
                    },
                    v = function(B, C) {
                        if (B.preventDefault) {
                            B.preventDefault()
                        }
                        B.returnValue = C || false
                    },
                    k = function(B) {
                        var D = x(d),
                            F = d.value,
                            E = "",
                            C = true;
                        switch (C) {
                            case (i.indexOf(B) !== -1):
                                D = D + 1;
                                if (D > s.length) {
                                    return false
                                }
                                while (p.indexOf(F.charAt(D - 1)) !== -1 && D <= s.length) {
                                    D = D + 1
                                }
                                if (!h(B, D)) {
                                    c(B);
                                    return false
                                }
                                E = F.substr(0, D - 1) + B + F.substr(D);
                                if (i.indexOf(F.charAt(D)) === -1 && n.indexOf(F.charAt(D)) === -1) {
                                    D = D + 1
                                }
                                break;
                            case (B === "bksp"):
                                D = D - 1;
                                if (D < 0) {
                                    return false
                                }
                                while (i.indexOf(F.charAt(D)) === -1 && n.indexOf(F.charAt(D)) === -1 && D > 1) {
                                    D = D - 1
                                }
                                E = F.substr(0, D) + s.substr(D, 1) + F.substr(D + 1);
                                break;
                            case (B === "del"):
                                if (D >= F.length) {
                                    return false
                                }
                                while (p.indexOf(F.charAt(D)) !== -1 && F.charAt(D) !== "") {
                                    D = D + 1
                                }
                                E = F.substr(0, D) + s.substr(D, 1) + F.substr(D + 1);
                                D = D + 1;
                                break;
                            case (B === "etc"):
                                return true;
                            default:
                                return false
                        }
                        d.value = "";
                        d.value = E;
                        b(d, D);
                        return false
                    },
                    g = function(B) {
                        if (i.indexOf(B) === -1 && B !== "bksp" && B !== "del" && B !== "etc") {
                            var C = x(d);
                            y = true;
                            c(B);
                            setTimeout(function() {
                                y = false;
                                b(d, C)
                            }, w);
                            return false
                        }
                        return true
                    },
                    z = function(C) {
                        if (!l) {
                            return true
                        }
                        C = C || event;
                        if (y) {
                            v(C);
                            return false
                        }
                        var B = m(C);
                        if ((C.metaKey || C.ctrlKey) && (B === "X" || B === "V")) {
                            v(C);
                            return false
                        }
                        if (C.metaKey || C.ctrlKey) {
                            return true
                        }
                        if (d.value === "") {
                            d.value = s;
                            b(d, 0)
                        }
                        if (B === "bksp" || B === "del") {
                            k(B);
                            v(C);
                            return false
                        }
                        return true
                    },
                    e = function(C) {
                        if (!l) {
                            return true
                        }
                        C = C || event;
                        if (y) {
                            v(C);
                            return false
                        }
                        var B = m(C);
                        if (B === "etc" || C.metaKey || C.ctrlKey || C.altKey) {
                            return true
                        }
                        if (B !== "bksp" && B !== "del" && B !== "shift") {
                            if (!g(B)) {
                                v(C);
                                return false
                            }
                            if (k(B)) {
                                if (u()) {
                                    q()
                                }
                                v(C, true);
                                return true
                            }
                            if (u()) {
                                q()
                            }
                            v(C);
                            return false
                        }
                        return false
                    },
                    r = function() {
                        if (!d.tagName || (d.tagName.toUpperCase() !== "INPUT" && d.tagName.toUpperCase() !==
                                "TEXTAREA")) {
                            return null
                        }
                        if (!A || d.value === "") {
                            d.value = s
                        }
                        j(d, "keydown", function(B) {
                            z(B)
                        });
                        j(d, "keypress", function(B) {
                            e(B)
                        });
                        j(d, "focus", function() {
                            t = d.value
                        });
                        j(d, "blur", function() {
                            if (d.value !== t && d.onchange) {
                                d.onchange()
                            }
                        });
                        return o
                    };
                o.resetField = function() {
                    d.value = s
                };
                o.setAllowed = function(B) {
                    i = B;
                    o.resetField()
                };
                o.setFormat = function(B) {
                    s = B;
                    o.resetField()
                };
                o.setSeparator = function(B) {
                    p = B;
                    o.resetField()
                };
                o.setTypeon = function(B) {
                    n = B;
                    o.resetField()
                };
                o.setEnabled = function(B) {
                    l = B
                };
                return r()
            }
        }(window));

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
