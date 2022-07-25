@if($leads)
                                                            @foreach ($leads as $lead )
                                                            <tr>
                                                                <td class="c-7b f-16 whiteSpace">
                                                                    {{date('d m Y H:i A',strtotime($lead->uploaded_datetime))}}
                                                                    <svg class="ms-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M8.25 2.75H2.75V13.25H13.25V7.75M13.25 2.75L7.75 8.25M10.75 1.75H14.25V5.25" stroke="#4F4F52" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg></td>
                                                                <td class="c-7b f-16">{{$lead->lead_type->name}}</td>
                                                                <td class="c-7b f-16">{{$lead->age_group->age_from}}-{{$lead->age_group->age_to}} Days Old</td>
                                                                <td class="c-7b f-16">{{$lead->user->firstName}}</td>
                                                                <td class="c-7b f-16">{{$lead->duplicate_row}}</td>
                                                                <td class="c-7b f-16">{{$lead->invalid_row}}</td>
                                                                <td class="c-7b f-16">{{$lead->total_row}}</td>
                                                            </tr>
                                                            @endforeach
                                                        @endif
