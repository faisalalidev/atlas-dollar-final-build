@extends('beautymail::templates.minty',['css' => '','logo' => ['path' => asset($logo)],'unsubscribe' => ''])

@section('content')

    @include('beautymail::templates.minty.contentStart',['css' => ''])
    <tr>
        <td class="title">
            Hello {{ $data->name }}
        </td>
    </tr>
    <tr>
        <td width="100%" height="10"></td>
    </tr>
    <tr>
        <td class="paragraph">
           Your account is now verified by admin, You can now login to our website to continue shopping.
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    <tr>
        <td>
            @include('beautymail::templates.minty.button', ['text' => 'Go to Website', 'link' => route(config('constants.WEB_PREFIX').'login').'?login=true'])
        </td>
    </tr>
    <tr>
        <td width="100%" height="25"></td>
    </tr>
    @include('beautymail::templates.minty.contentEnd',['css' => ''])

@stop
