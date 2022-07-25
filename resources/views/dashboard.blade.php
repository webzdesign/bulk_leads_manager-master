@extends('layouts.master')

@section('content')
                <div class="middleContent">
                    <div class="dashWrpr statsWrpr">
                        <div class="row">
                            <div class="col-md-6 mb-5">
                                <div class="statsCard">
                                    <a href="{{route('admin.new-order')}}" class="cardTop w-auto d-flex align-items-center justify-content-center">
                                        <svg class="me-2" width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 12C11.1675 12 10.5 12.6675 10.5 13.5C10.5 13.8978 10.658 14.2794 10.9393 14.5607C11.2206 14.842 11.6022 15 12 15C12.3978 15 12.7794 14.842 13.0607 14.5607C13.342 14.2794 13.5 13.8978 13.5 13.5C13.5 12.6675 12.825 12 12 12ZM0 0V1.5H1.5L4.2 7.1925L3.18 9.03C3.0675 9.24 3 9.4875 3 9.75C3 10.1478 3.15804 10.5294 3.43934 10.8107C3.72064 11.092 4.10218 11.25 4.5 11.25H13.5V9.75H4.815C4.76527 9.75 4.71758 9.73025 4.68242 9.69508C4.64725 9.65992 4.6275 9.61223 4.6275 9.5625C4.6275 9.525 4.635 9.495 4.65 9.4725L5.325 8.25H10.9125C11.475 8.25 11.97 7.935 12.225 7.4775L14.91 2.625C14.9625 2.505 15 2.3775 15 2.25C15 2.05109 14.921 1.86032 14.7803 1.71967C14.6397 1.57902 14.4489 1.5 14.25 1.5H3.1575L2.4525 0H0ZM4.5 12C3.6675 12 3 12.6675 3 13.5C3 13.8978 3.15804 14.2794 3.43934 14.5607C3.72064 14.842 4.10218 15 4.5 15C4.89782 15 5.27936 14.842 5.56066 14.5607C5.84196 14.2794 6 13.8978 6 13.5C6 12.6675 5.325 12 4.5 12Z" fill="#F8F9FA"/>
                                        </svg>
                                        <div class="f-18 f-700 text-white">NEW ORDER</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="statsCard">
                                    <a href="{{route('admin.import.index')}}" class="cardTop w-auto d-flex align-items-center justify-content-center" style="background: linear-gradient(180deg, #63B967 0%, #4BA64F 100%);">
                                        <svg class="me-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1701_5415)">
                                            <path d="M17.125 12.875H12.4316L10.8408 14.4658C10.4172 14.8895 9.85117 15.125 9.25 15.125C8.64883 15.125 8.08422 14.891 7.65918 14.4658L6.06836 12.875H1.375C0.753789 12.875 0.25 13.3788 0.25 14V17.375C0.25 17.9962 0.753789 18.5 1.375 18.5H17.125C17.7462 18.5 18.25 17.9962 18.25 17.375V14C18.25 13.3777 17.7473 12.875 17.125 12.875ZM15.4375 16.5312C14.9734 16.5312 14.5938 16.1516 14.5938 15.6875C14.5938 15.2234 14.9734 14.8438 15.4375 14.8438C15.9016 14.8438 16.2812 15.2234 16.2812 15.6875C16.2812 16.1516 15.9016 16.5312 15.4375 16.5312ZM8.45547 13.6695C8.67344 13.891 8.96172 14 9.25 14C9.53828 14 9.82586 13.8901 10.0452 13.6704L14.5452 9.17041C14.9843 8.73096 14.9843 8.01904 14.5452 7.57959C14.1058 7.14014 13.3935 7.14014 12.9544 7.57959L10.375 10.1609V1.625C10.375 1.00379 9.87121 0.5 9.25 0.5C8.62773 0.5 8.125 1.00379 8.125 1.625V10.1609L5.54453 7.58047C5.10543 7.14102 4.39316 7.14102 3.95371 7.58047C3.51461 8.01992 3.51461 8.73184 3.95371 9.17129L8.45547 13.6695Z" fill="white"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_1701_5415">
                                            <rect width="18" height="18" fill="white" transform="translate(0.25 0.5)"/>
                                            </clipPath>
                                            </defs>
                                        </svg>
                                        <div class="f-18 f-700 text-white">IMPORT</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row dashRow">
                            @if($leadTypes)
                            @foreach ($leadTypes as $leadtype)
                            <div class="col-md-6 mb-4">
                                <div class="statsCard">
                                    <div class="cards pt-0 mb-0 position-relative">
                                        <div class="cardTop w-auto d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <svg class="me-3" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                                    <path d="M25.5 3.50625C23.0031 1.96562 20.1344 1.0625 17 1.0625V3.50625H25.5Z" fill="#ED4C5C"/>
                                                    <path d="M17 5.94961H28.475C27.5719 5.04648 26.5625 4.19648 25.5 3.50586H17V5.94961Z" fill="white"/>
                                                    <path d="M17 8.39395H30.4406C29.8562 7.49082 29.2188 6.69395 28.5281 5.9502H17V8.39395Z" fill="#ED4C5C"/>
                                                    <path d="M17 10.8373H31.7156C31.3438 9.9873 30.9187 9.1373 30.4406 8.39355H17V10.8373Z" fill="white"/>
                                                    <path d="M17 13.2816H32.5125C32.3 12.4316 32.0344 11.6348 31.7156 10.8379H17V13.2816Z" fill="#ED4C5C"/>
                                                    <path d="M17 15.7777H32.8844C32.8313 14.9277 32.6719 14.1309 32.5125 13.334H17V15.7777Z" fill="white"/>
                                                    <path d="M32.8844 15.7783H17V17.0002H1.0625C1.0625 17.4252 1.0625 17.7971 1.11562 18.2221H32.8844C32.9375 17.7971 32.9375 17.4252 32.9375 17.0002C32.9375 16.5752 32.9375 16.1502 32.8844 15.7783Z" fill="#ED4C5C"/>
                                                    <path d="M1.48748 20.6654H32.5125C32.725 19.8686 32.8312 19.0717 32.8844 18.2217H1.1156C1.16873 19.0186 1.3281 19.8686 1.48748 20.6654Z" fill="white"/>
                                                    <path d="M2.28442 23.1098H31.7157C32.0344 22.3129 32.3001 21.516 32.5126 20.666H1.48755C1.70005 21.516 1.96567 22.3129 2.28442 23.1098Z" fill="#ED4C5C"/>
                                                    <path d="M3.55942 25.5531H30.4407C30.9188 24.7562 31.3438 23.9594 31.7157 23.1094H2.28442C2.6563 23.9594 3.0813 24.7562 3.55942 25.5531Z" fill="white"/>
                                                    <path d="M5.47183 27.9965H28.5281C29.2187 27.2527 29.9093 26.4027 30.4406 25.5527H3.55933C4.09058 26.4559 4.7812 27.2527 5.47183 27.9965Z" fill="#ED4C5C"/>
                                                    <path d="M8.44692 30.4408H25.5532C26.6688 29.7502 27.625 28.9002 28.5282 27.9971H5.47192C6.37505 28.9533 7.38442 29.7502 8.44692 30.4408Z" fill="white"/>
                                                    <path d="M17 32.9373C20.1344 32.9373 23.0563 32.0342 25.5531 30.4404H8.4469C10.9438 32.0342 13.8656 32.9373 17 32.9373Z" fill="#ED4C5C"/>
                                                    <path d="M8.5 3.50625C7.38438 4.19687 6.375 5.04687 5.47188 5.95C4.72813 6.69375 4.09062 7.54375 3.55937 8.39375C3.08125 9.19063 2.60313 9.9875 2.28438 10.8375C1.96563 11.6344 1.7 12.4312 1.4875 13.2812C1.275 14.0781 1.16875 14.875 1.11562 15.725C1.0625 16.15 1.0625 16.575 1.0625 17H17V1.0625C13.8656 1.0625 10.9969 1.96562 8.5 3.50625Z" fill="#428BC1"/>
                                                    <path d="M13.2813 1.59375L13.5469 2.39062H14.3438L13.7063 2.92188L13.9188 3.71875L13.2813 3.24062L12.6438 3.71875L12.8563 2.92188L12.2188 2.39062H13.0156L13.2813 1.59375ZM15.4063 4.78125L15.6719 5.57812H16.4688L15.8313 6.10938L16.0438 6.90625L15.4063 6.42813L14.7688 6.90625L14.9813 6.10938L14.3438 5.57812H15.1406L15.4063 4.78125ZM11.1563 4.78125L11.4219 5.57812H12.2188L11.5813 6.10938L11.7938 6.90625L11.1563 6.42813L10.5188 6.90625L10.7313 6.10938L10.0938 5.57812H10.8906L11.1563 4.78125ZM13.2813 7.96875L13.5469 8.76562H14.3438L13.7063 9.29688L13.9188 10.0938L13.2813 9.61563L12.6438 10.0938L12.8563 9.29688L12.2188 8.76562H13.0156L13.2813 7.96875ZM9.03127 7.96875L9.2969 8.76562H10.0938L9.45627 9.29688L9.66878 10.0938L9.03127 9.61563L8.39377 10.0938L8.60628 9.29688L7.96877 8.76562H8.76565L9.03127 7.96875ZM4.78127 7.96875L5.0469 8.76562H5.84377L5.20627 9.29688L5.41877 10.0938L4.78127 9.61563L4.14377 10.0938L4.35627 9.29688L3.71877 8.76562H4.51565L4.78127 7.96875ZM15.4063 11.1562L15.6719 11.9531H16.4688L15.8313 12.4844L16.0438 13.2812L15.4063 12.8031L14.7688 13.2812L14.9813 12.4844L14.3438 11.9531H15.1406L15.4063 11.1562ZM11.1563 11.1562L11.4219 11.9531H12.2188L11.5813 12.4844L11.7938 13.2812L11.1563 12.8031L10.5188 13.2812L10.7313 12.4844L10.0938 11.9531H10.8906L11.1563 11.1562ZM6.90627 11.1562L7.1719 11.9531H7.96877L7.33127 12.4844L7.54377 13.2812L6.90627 12.8031L6.26877 13.2812L6.48127 12.4844L5.84377 11.9531H6.64065L6.90627 11.1562ZM13.2813 14.3438L13.5469 15.1406H14.3438L13.7063 15.6719L13.9188 16.4688L13.2813 15.9906L12.6438 16.4688L12.8563 15.6719L12.2188 15.1406H13.0156L13.2813 14.3438ZM9.03127 14.3438L9.2969 15.1406H10.0938L9.45627 15.6719L9.66878 16.4688L9.03127 15.9906L8.39377 16.4688L8.60628 15.6719L7.96877 15.1406H8.76565L9.03127 14.3438ZM4.78127 14.3438L5.0469 15.1406H5.84377L5.20627 15.6719L5.41877 16.4688L4.78127 15.9906L4.14377 16.4688L4.35627 15.6719L3.71877 15.1406H4.51565L4.78127 14.3438ZM6.26877 6.90625L6.90627 6.42813L7.54377 6.90625L7.27815 6.10938L7.91565 5.57812H7.11877L6.90627 4.78125L6.64065 5.57812H5.8969L6.5344 6.05625L6.26877 6.90625ZM2.01877 13.2812L2.65627 12.8031L3.29377 13.2812L3.02815 12.4844L3.66565 11.9531H2.9219L2.65627 11.1562L2.39065 11.9531H1.8594C1.8594 12.0063 1.80627 12.0594 1.80627 12.1125L2.23127 12.4312L2.01877 13.2812Z" fill="white"/>
                                                </svg>
                                                <div class="f-18 f-700 text-white">{{$leadtype->name}}&nbsp;&nbsp;(767,194)</div>
                                            </div>
                                        </div>
                                        @php
                                            $ageGroups =  \App\Models\AgeGroup::where('lead_type_id',$leadtype->id)->get();
                                        @endphp

                                        <div class="cardYearList">
                                            @foreach ($ageGroups as $ageGroup)
                                            <li class="d-flex align-items-center justify-content-between">
                                                <div class="f-16 f-14-500 f-700 c-gr">{{$ageGroup->age_from}} - {{$ageGroup->age_to}} days old</div>

                                                <div class="f-16 f-14-500 f-700 c-gr">(231 records)</div>
                                            </li>
                                            @endforeach

                                            {{-- <li class="d-flex align-items-center justify-content-between">
                                                <div class="f-16 f-14-500 f-700 c-gr">30 - 59 days old</div>
                                                <div class="f-16 f-14-500 f-700 c-gr">(1234 records)</div>
                                            </li>
                                            <li class="d-flex align-items-center justify-content-between">
                                                <div class="f-16 f-14-500 f-700 c-gr">60 - 89 days old</div>
                                                <div class="f-16 f-14-500 f-700 c-gr">(39201 records)</div>
                                            </li>
                                            <li class="d-flex align-items-center justify-content-between">
                                                <div class="f-16 f-14-500 f-700 c-gr">90 - 360 days old</div>
                                                <div class="f-16 f-14-500 f-700 c-gr">(12234 records)</div>
                                            </li> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                            {{-- <div class="col-md-6 mb-4">
                                <div class="statsCard">
                                    <div class="cards pt-0 mb-0 position-relative">
                                        <div class="cardTop w-auto d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <svg class="me-3" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M17 1.0625V6.375H6.375V17H1.0625C1.0625 25.8188 8.18125 32.9375 17 32.9375C25.8188 32.9375 32.9375 25.8188 32.9375 17C32.9375 8.18125 25.8188 1.0625 17 1.0625Z" fill="#2A5F9E"/>
                                                    <path d="M17 1.0625C14.5031 1.0625 12.1656 1.64688 10.0406 2.65625V5.84375H5.84375V10.0406H2.65625C1.64688 12.1656 1.0625 14.5031 1.0625 17H7.4375V9.03125L13.8125 17H17V13.0156L12.5375 7.4375H17V1.0625Z" fill="white"/>
                                                    <path d="M8.18115 7.4375L15.9374 17H16.9999V14.3969L11.3687 7.4375H8.18115Z" fill="#ED4C5C"/>
                                                    <path d="M17 2.65625H10.0406C6.85312 4.19688 4.19688 6.85312 2.65625 10.0406V17H5.84375V5.84375H17V2.65625Z" fill="#ED4C5C"/>
                                                    <path d="M4.25 18.9656L5.41875 17.5312L5.04688 19.3906L6.90625 19.4437L5.25937 20.2938L6.375 21.7812L4.72812 21.0375L4.25 22.8438L3.77187 21.0375L2.125 21.7812L3.24062 20.2938L1.59375 19.4437L3.45312 19.3906L3.08125 17.5312L4.25 18.9656ZM27.625 10.7313L28.5812 9.5625L28.2625 11.05L29.75 11.1031L28.4219 11.7938L29.325 12.9625L27.9969 12.325L27.625 13.8125L27.2531 12.325L25.925 12.9625L26.8281 11.7938L25.5 11.1031L26.9875 11.05L26.6688 9.5625L27.625 10.7313ZM27.625 21.3563L28.5812 20.1875L28.2625 21.675L29.75 21.7281L28.4219 22.4188L29.325 23.5875L27.9969 22.95L27.625 24.4375L27.2531 22.95L25.925 23.5875L26.8281 22.4188L25.5 21.7281L26.9875 21.675L26.6688 20.1875L27.625 21.3563ZM22.3125 13.9188L23.2687 12.75L22.95 14.2375L24.4375 14.2906L23.1094 14.9813L24.0125 16.15L22.6844 15.5125L22.3125 17L21.9406 15.5125L20.6125 16.15L21.5156 14.9813L20.1875 14.2906L21.675 14.2375L21.3563 12.75L22.3125 13.9188Z" fill="white"/>
                                                </svg>
                                                <div class="f-18 f-700 text-white">AUSTRALIAN BULK LEADS&nbsp;&nbsp;(123, 456)</div>
                                            </div>
                                        </div>
                                        <div class="cardYearList">
                                            <li class="d-flex align-items-center justify-content-between">
                                                <div class="f-16 f-14-500 f-700 c-gr">0 - 29 days old</div>
                                                <div class="f-16 f-14-500 f-700 c-gr">(231 records)</div>
                                            </li>
                                            <li class="d-flex align-items-center justify-content-between">
                                                <div class="f-16 f-14-500 f-700 c-gr">30 - 59 days old</div>
                                                <div class="f-16 f-14-500 f-700 c-gr">(1234 records)</div>
                                            </li>
                                            <li class="d-flex align-items-center justify-content-between">
                                                <div class="f-16 f-14-500 f-700 c-gr">60 - 89 days old</div>
                                                <div class="f-16 f-14-500 f-700 c-gr">(39201 records)</div>
                                            </li>
                                            <li class="d-flex align-items-center justify-content-between">
                                                <div class="f-16 f-14-500 f-700 c-gr">90 - 360 days old</div>
                                                <div class="f-16 f-14-500 f-700 c-gr">(12234 records)</div>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row dashRow mb-4">
                            <div class="col-12">
                                <div class="statsCard">
                                    <div class="cards pt-0 mb-0 position-relative">
                                        <div class="cardTop w-auto d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <svg class="me-2" width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.75 14C11.9175 14 11.25 14.6675 11.25 15.5C11.25 15.8978 11.408 16.2794 11.6893 16.5607C11.9706 16.842 12.3522 17 12.75 17C13.1478 17 13.5294 16.842 13.8107 16.5607C14.092 16.2794 14.25 15.8978 14.25 15.5C14.25 14.6675 13.575 14 12.75 14ZM0.75 2V3.5H2.25L4.95 9.1925L3.93 11.03C3.8175 11.24 3.75 11.4875 3.75 11.75C3.75 12.1478 3.90804 12.5294 4.18934 12.8107C4.47064 13.092 4.85218 13.25 5.25 13.25H14.25V11.75H5.565C5.51527 11.75 5.46758 11.7302 5.43242 11.6951C5.39725 11.6599 5.3775 11.6122 5.3775 11.5625C5.3775 11.525 5.385 11.495 5.4 11.4725L6.075 10.25H11.6625C12.225 10.25 12.72 9.935 12.975 9.4775L15.66 4.625C15.7125 4.505 15.75 4.3775 15.75 4.25C15.75 4.05109 15.671 3.86032 15.5303 3.71967C15.3897 3.57902 15.1989 3.5 15 3.5H3.9075L3.2025 2H0.75ZM5.25 14C4.4175 14 3.75 14.6675 3.75 15.5C3.75 15.8978 3.90804 16.2794 4.18934 16.5607C4.47064 16.842 4.85218 17 5.25 17C5.64782 17 6.02936 16.842 6.31066 16.5607C6.59196 16.2794 6.75 15.8978 6.75 15.5C6.75 14.6675 6.075 14 5.25 14Z" fill="white"/>
                                                </svg>
                                                <div class="f-18 f-700 text-white">LATEST ORDERS</div>
                                            </div>
                                        </div>
                                        <div class="cardYearList">
                                            <div class="tableCards">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>NAME</th>
                                                            <th>EMAIL</th>
                                                            <th>DATE AND TIME GENERATED</th>
                                                            <th>PRODUCT</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $order )
                                                        <tr>
                                                            <td class="c-7b f-16 whiteSpace">
                                                                {{$order->client->firstName}}
                                                                <svg class="ms-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M8.25 2.75H2.75V13.25H13.25V7.75M13.25 2.75L7.75 8.25M10.75 1.75H14.25V5.25" stroke="#4F4F52" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg></td>
                                                            <td class="c-7b f-16">{{$order->client->email}}</td>
                                                            <td class="c-7b f-16">{{date('d m Y H:i A',strtotime($order->order_date))}}</td>
                                                            <td class="c-7b f-16">{{$order->qty}} {{$order->lead_type->name}} | {{$order->age_group->age_from}}-{{$order->age_group->age_to}} Days Old </td>
                                                        </tr>
                                                        @endforeach

                                                        {{-- <tr>
                                                            <td class="c-7b f-16 whiteSpace">
                                                                John Doe
                                                                <svg class="ms-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M8.25 2.75H2.75V13.25H13.25V7.75M13.25 2.75L7.75 8.25M10.75 1.75H14.25V5.25" stroke="#4F4F52" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg></td>
                                                            <td class="c-7b f-16">johndoe@gmail.com</td>
                                                            <td class="c-7b f-16">06 26 2022 09:37AM</td>
                                                            <td class="c-7b f-16">1000 US Bulk Leads | 30-60 Days Old </td>
                                                        </tr> --}}
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mt-2 cursor-pointer d-flex align-items-center justify-content-center c-46 f-16 f-700" id='moreOrder'>
                                                LOAD MORE
                                                <svg class="ms-2" width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.16675 1.25L8.50008 8.58333L15.8334 1.25" stroke="#46679D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row dashRow mb-4">
                            <div class="col-12">
                                <div class="statsCard">
                                    <div class="cards pt-0 mb-0 position-relative">
                                        <div class="cardTop w-auto d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <svg class="me-2" width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.75 14C11.9175 14 11.25 14.6675 11.25 15.5C11.25 15.8978 11.408 16.2794 11.6893 16.5607C11.9706 16.842 12.3522 17 12.75 17C13.1478 17 13.5294 16.842 13.8107 16.5607C14.092 16.2794 14.25 15.8978 14.25 15.5C14.25 14.6675 13.575 14 12.75 14ZM0.75 2V3.5H2.25L4.95 9.1925L3.93 11.03C3.8175 11.24 3.75 11.4875 3.75 11.75C3.75 12.1478 3.90804 12.5294 4.18934 12.8107C4.47064 13.092 4.85218 13.25 5.25 13.25H14.25V11.75H5.565C5.51527 11.75 5.46758 11.7302 5.43242 11.6951C5.39725 11.6599 5.3775 11.6122 5.3775 11.5625C5.3775 11.525 5.385 11.495 5.4 11.4725L6.075 10.25H11.6625C12.225 10.25 12.72 9.935 12.975 9.4775L15.66 4.625C15.7125 4.505 15.75 4.3775 15.75 4.25C15.75 4.05109 15.671 3.86032 15.5303 3.71967C15.3897 3.57902 15.1989 3.5 15 3.5H3.9075L3.2025 2H0.75ZM5.25 14C4.4175 14 3.75 14.6675 3.75 15.5C3.75 15.8978 3.90804 16.2794 4.18934 16.5607C4.47064 16.842 4.85218 17 5.25 17C5.64782 17 6.02936 16.842 6.31066 16.5607C6.59196 16.2794 6.75 15.8978 6.75 15.5C6.75 14.6675 6.075 14 5.25 14Z" fill="white"/>
                                                </svg>
                                                <div class="f-18 f-700 text-white">LATEST IMPORTS</div>
                                            </div>
                                        </div>
                                        <div class="cardYearList">
                                            <div class="tableCards">
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Date and Time</th>
                                                            <th>Lead Type</th>
                                                            <th>Age</th>
                                                            <th>Imported by</th>
                                                            <th>Duplicates</th>
                                                            <th>Invalid</th>
                                                            <th>Uploaded</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="c-7b f-16 whiteSpace">
                                                                06 25 2022 09:30AM
                                                                <svg class="ms-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M8.25 2.75H2.75V13.25H13.25V7.75M13.25 2.75L7.75 8.25M10.75 1.75H14.25V5.25" stroke="#4F4F52" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg></td>
                                                            <td class="c-7b f-16">US Bulk Leads</td>
                                                            <td class="c-7b f-16">30-60 Days Old</td>
                                                            <td class="c-7b f-16">Joe Admin</td>
                                                            <td class="c-7b f-16">100</td>
                                                            <td class="c-7b f-16">50</td>
                                                            <td class="c-7b f-16">9850</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="c-7b f-16 whiteSpace">
                                                                06 25 2022 09:30AM
                                                                <svg class="ms-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M8.25 2.75H2.75V13.25H13.25V7.75M13.25 2.75L7.75 8.25M10.75 1.75H14.25V5.25" stroke="#4F4F52" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg></td>
                                                            <td class="c-7b f-16">US Bulk Leads</td>
                                                            <td class="c-7b f-16">30-60 Days Old</td>
                                                            <td class="c-7b f-16">Joe Admin</td>
                                                            <td class="c-7b f-16">100</td>
                                                            <td class="c-7b f-16">50</td>
                                                            <td class="c-7b f-16">9850</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mt-2 cursor-pointer d-flex align-items-center justify-content-center c-46 f-16 f-700">
                                                LOAD MORE
                                                <svg class="ms-2" width="17" height="10" viewBox="0 0 17 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.16675 1.25L8.50008 8.58333L15.8334 1.25" stroke="#46679D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $(document).on('click','#moreOrder',function(e){
                var more = 5;
                window.location.href= "{{route('home',5)}}";
            });
        });
    </script>
@endsection
