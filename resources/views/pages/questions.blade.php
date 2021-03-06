@extends('layouts.app')

@section('title', 'Main')

@section('content')

    <section class="container pt-3">

        <!-- Nav With Separators -->
        <div class="row">
            <div class="nav nav-tabs col-md-9" id="nav-tab" role="tablist">
                <a class="nav-item nav-link @if(isset($type) && strcmp($type, 'recent') == 0){{"active"}}@endif" id="nav-new-tab" aria-controls="nav-new" aria-selected="true"
                   data-toggle="tab" role="tab" href="#nav-new">Recent</a>
                <a class="nav-item nav-link @if(isset($type) && strcmp($type, 'hot') == 0){{"active"}}@endif" id="nav-hot-tab" aria-controls="nav-hot" aria-selected="false"
                   data-toggle="tab" role="tab" href="#nav-hot">Hot</a>
                <a class="nav-item nav-link @if(isset($type) && strcmp($type, 'highly-voted') == 0){{"active"}}@endif" id="nav-voted-tab" aria-controls="nav-voted" aria-selected="false"
                   data-toggle="tab" role="tab" href="#nav-voted">Highly Voted</a>
                <a class="nav-item nav-link @if(isset($type) && strcmp($type, 'active') == 0){{"active"}}@endif" id="nav-active-tab" aria-controls="nav-active" aria-selected="false"
                   data-toggle="tab" role="tab" href="#nav-active">Active</a>
            </div>
        </div>

        <!-- Separators Contents -->
        <div class="row">
            <div class="tab-content col-md-9 order-12 order-md-1" id="nav-tabContent">

                @include('templates.questions')

                <div class="tab-pane fade @if(isset($type) && strcmp($type, 'recent') == 0){{"show active"}}@endif" id="nav-new" role="tabpanel" aria-labelledby="nav-new-tab">
                    @if (isset($type) && strcmp($type, 'recent') == 0)
                        @for ($i = 0; $i < 10; $i++)
                            @include('templates.questionTemplate')
                        @endfor
                    @endif
                </div>

                <div class="tab-pane fade @if(isset($type) && strcmp($type, 'hot') == 0){{"show active"}}@endif" id="nav-hot" role="tabpanel" aria-labelledby="nav-hot-tab">
                    @if (isset($type) && strcmp($type, 'hot') == 0)
                        @for ($i = 0; $i < 10; $i++)
                            @include('templates.questionTemplate')
                        @endfor
                    @endif
                </div>

                <div class="tab-pane fade @if(isset($type) && strcmp($type, 'highly-voted') == 0){{"show active"}}@endif" id="nav-voted" role="tabpanel" aria-labelledby="nav-voted-tab">
                    @if (isset($type) && strcmp($type, 'highly-voted') == 0)
                        @for ($i = 0; $i < 10; $i++)
                            @include('templates.questionTemplate')
                        @endfor
                    @endif
                </div>

                <div class="tab-pane fade @if(isset($type) && strcmp($type, 'active') == 0){{"show active"}}@endif" id="nav-active" role="tabpanel" aria-labelledby="nav-active-tab">
                    @if (isset($type) && strcmp($type, 'active') == 0)
                        @for ($i = 0; $i < 10; $i++)
                            @include('templates.questionTemplate')
                        @endfor
                    @endif
                </div>

                <div class="tab-pane fade @if (isset($type) && strcmp($type, 'search') == 0){{"show active"}}@endif" id="nav-search" role="tabpanel">
                    @if (isset($type) && strcmp($type, 'search') == 0)
                        @for ($i = 0; $i < 10; $i++)
                            @include('templates.questionTemplate')
                        @endfor
                    @endif
                </div>

                <div class="loader-ellips">
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                    <span class="loader-ellips__dot"></span>
                </div>

            </div>
            <aside class="col-md-3 mb-3 order-1 order-md-12">
                <div class="aside-content pt-3">

                    @if(Auth::check())
                        <div class="card unnoticed-a hover-box-shadow mb-3">
                            <div class="card-img-top-container template-for-fill"></div>
                            <div class="card-body text-center">
                                <div class="rounded-circle img-profile-aside template-for-fill mx-auto" height="100px" width="100px"></div>
                                <h3 class="card-text mb-0 template-for-fill">&nbsp</h3>
                                <div class="my-3">
                                    <i class="fas fa-trophy"></i>
                                    <span class="template-for-fill">&nbsp&nbsp&nbsp</span>
                                </div>
                                <div class="row">
                                    <div class="col-4 px-1 border-right">
                                        <div class="template-for-fill">&nbsp</div>
                                        <small>Questions</small>
                                    </div>
                                    <div class="col-4 px-1">
                                        <div class="template-for-fill">&nbsp</div>
                                        <small>Answers</small>
                                    </div>
                                    <div class="col-4 px-1 border-left">
                                        <div class="template-for-fill">&nbsp</div>
                                        <small>Comments</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('templates.minProfile')

                    @endif

                    <div class="card">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <h5 class="card-title">Have a Question?</h5>
                            <form id="form_ask_question" name="ask_question" action="{{ url('ask_question') }}">
                                <div class="input-group mb-3">
                                    <input name="title" type="text" class="form-control" aria-label="Default">
                                </div>
                                <button type="submit" class="btn btn-outline-info w-100">Ask!</button>
                            </form>
                        </div>
                    </div>

                </div>
            </aside>
        </div>

    </section>


@endsection
