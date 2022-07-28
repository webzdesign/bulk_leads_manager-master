@if($orders)
@foreach ($orders as $order )
<tr>
    <td class="c-7b f-16 whiteSpace">
        {{$order->client->firstName}}
        <svg class="ms-2" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.25 2.75H2.75V13.25H13.25V7.75M13.25 2.75L7.75 8.25M10.75 1.75H14.25V5.25" stroke="#4F4F52" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg></td>
    <td class="c-7b f-16">{{$order->client->email}}</td>
    <td class="c-7b f-16">{{date('d m Y H:i A',strtotime($order->order_date))}}</td>
    <td class="c-7b f-16">{{$order->qty}} {{$order->lead_type->name}} | @if($order->age_group) {{$order->age_group->age_from}}-{{$order->age_group->age_to}} Days Old @endif</td>
</tr>
@endforeach
@endif
