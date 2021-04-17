@extends('admin-layouts.admin_app')

@section('content')
    <div class="col-12">
        <h1>Home</h1>
        <div class="separator mb-5"></div>
    </div>
    <div class="col-lg-12 col-xl-6">
        <div class="icon-cards-row">
            <div class="glide dashboard-numbers">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <li class="glide__slide">
                            <a href="#" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsminds-clock"></i>
                                    <p class="card-text mb-0">Pending Posts</p>
                                    <p class="lead text-center">16</p>
                                </div>
                            </a>
                        </li>
                        <li class="glide__slide">
                            <a href="#" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsminds-basket-coins"></i>
                                    <p class="card-text mb-0">Completed Posts</p>
                                    <p class="lead text-center">32</p>
                                </div>
                            </a>
                        </li>
                        <li class="glide__slide">
                            <a href="#" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsminds-arrow-refresh"></i>
                                    <p class="card-text mb-0">Categories</p>
                                    <p class="lead text-center">2</p>
                                </div>
                            </a>
                        </li>
                        <li class="glide__slide">
                            <a href="#" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsminds-mail-read"></i>
                                    <p class="card-text mb-0">New Comments</p>
                                    <p class="lead text-center">25</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
