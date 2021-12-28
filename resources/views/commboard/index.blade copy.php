@extends('layouts.app')
@section('title')
Comm board
@endsection

@section('content')
<div class="card chat-application pt-5">
    <div class="row card-body">
        <div class="col-sm-3  user-chat-box border-right">
            <div id="plist" class="people-list">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search...">
                </div>

                <ul class="mailbox list-style-none app-chat  mt-2 mb-0">
                    @php
                    $groupArr = [];
                    $groupArr2 = [];
                    foreach ($commboards as $key => $comm) {
                    if (!in_array($comm->cf_2218, $groupArr)) {
                    array_push($groupArr, $comm->cf_2218);
                    array_push($groupArr2, $comm);
                    }
                    }
                    $fullname = "$contact->firstname $contact->lastname";
                    @endphp
                    <li>
                        <div class="message-center chat-scroll chat-users">
                            @foreach ($groupArr2 as $key => $comm)
                            <a href="javascript:void(0)" class="chat-user message-item align-items-center border-bottom px-3 py-2" id="thread{{ $comm->cf_2218 }}" data-user-id='thread{{ $comm->cf_2218 }}'>
                                <span class="user-img position-relative d-inline-block">
                                    {{-- <img src="../assets/images/users/1.jpg" alt="user" class="rounded-circle w-100"> --}}
                                    <span class="round text-white d-inline-block text-center rounded-circle bg-warning">
                                        {{ substr($comm->name, 0, 1) }}</span>
                                    <span class="profile-status online rounded-circle pull-right"></span>
                                </span>
                                <div class="mail-contnet w-75 d-inline-block v-middle pl-2">
                                    <h5 class="message-title mb-0 mt-1">{{ $comm->name }}</h5>
                                    <span class="font-12 text-nowrap d-block text-muted text-truncate">{{ $comm->cf_2226 }}</span>
                                    <span class="font-12 text-nowrap d-block text-muted">{{ $comm->cf_2218 }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content  col-sm-9" id="v-pills-tabContent">
            <div class="p-20 chat-box-inner-part">
                <div class="chat-not-selected">
                    <div class="text-center">
                        <span class="display-5 text-info"><i class="mdi mdi-comment-outline"></i></span>
                        <h5>Open chat from the list</h5>
                    </div>
                </div>

                <div class="tab-pane fade active show chatting-box mb-0" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="chat-header clearfix">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="current-chat-user-name">
                                    <span>
                                        {{-- <img src="../assets/images/users/1.jpg" alt="dynamic-image"
                                                class="rounded-circle" width="45"> --}}
                                        <span class="name font-weight-bold ml-2"></span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="chat-meta-user pb-3 border-bottom">
                        <div class="current-chat-user-name">
                            <span class="round text-white d-inline-block text-center rounded-circle bg-warning">
                                {{ substr($comm->name, 0, 1) }}</span>
                            <span class="name font-weight-bold ml-2">{{ $comm->name }}</span>
                            </span>
                        </div>
                    </div>
                    <h4 class="card-title">Chat Messages</h4>
                    <div class="chat-box scrollable" style="height:calc(100vh - 300px);">
                        <!--User 1 -->
                        <ul class="chat-list chat" data-user-id='thread{{ $comm->cf_2218 }}'>
                            @foreach ($commboards as $key => $comm)
                            {{-- @if ($comm->cf_2218) --}}
                            @if ($comm && $comm->modifiedby === $contact->modifiedby)
                            <!--chat Row -->
                            <li class="mt-4">
                                {{-- <div class="chat-img d-inline-block align-top"><img
                                                    src="../assets/images/users/1.jpg" alt="user" class="rounded-circle" />
                                            </div> --}}
                                <div class="chat-content pl-3 d-inline-block">
                                    <span class="round text-white d-inline-block text-center rounded-circle bg-warning">
                                        {{ substr($comm->cf_2220, 0, 1) }}
                                    </span>
                                    <span class="name font-weight-bold ml-2">{{ $comm->name }}</span>
                                    <br>
                                    {{-- <h5 class="text-muted">{{ $comm->name }}</h5> --}}
                                    <div class="pr-7 box mb-2 d-inline-block text-dark rounded p-2 bg-light-info">
                                        {{ $comm->description }}
                                    </div>
                                </div>
                                <div class="chat-time d-inline-block text-right text-muted">
                                    {{ $comm->cf_2220 }}
                                </div>
                            </li>
                            <!--chat Row -->
                            @else
                            <li class="odd mt-4">
                                <div class="chat-content pl-3 d-inline-block text-right">
                                    <div class="box mb-2 d-inline-block text-dark rounded p-2 bg-light-inverse">
                                        {{ $comm->description }}
                                    </div>
                                    <br />
                                </div>
                                <div class="chat-time d-inline-block text-right text-muted">
                                    {{ $comm->cf_2226 }}|{{ $comm->cf_2228 }}
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="card-body border-top border-bottom chat-send-message-footer">
                        <form method="POST" {{--  action="{{ route('send_comment') }}" --}}>
                            @csrf
                            <div class="col-12">
                                <div class="row">
                                    <input type="hidden" name="threadid" value="{{ $comm->cf_2218 }}">
                                    <input type="hidden" name="threadtype" value="{{ $comm->cf_2220 }}">
                                    <div class="form-group col-10">
                                        <input type="text" name="subject" id="" placeholder="Subject" class="form-control pr-0" required data-toggle="tooltip" title="Send">
                                    </div>
                                    <div class="form-group col-2 text-center pl-0">
                                        <button type="submit" class="btn btn-info btn-circle btn-md ">
                                            <i class="far fa-paper-plane"></i> </button>
                                    </div>
                                    <div class="form-group col-12">
                                        <textarea placeholder="Body" class="form-control border-0" name="comment" style="margin-top: 0px; margin-bottom: 0px;" rows="2" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
