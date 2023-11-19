@extends('front.ar.email_templates.layouts.general')

@section('content')


<tr>
  <td style="background:rgb(223, 223, 223); border:1px solid #ececec;  margin:0; padding:40px; color:#000; font-family:Arial, Helvetica, sans-serif;">
    <h2 style="display:block;margin:0 auto 20px;padding:0;font-family:'Lato', Arial, sans-serif;font-size:24px;font-weight:700;font-style:normal;line-height:26px;color:#292929;text-decoration:none;text-align: center;">بيانات المتصل</h2>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        <strong>مرحبا الادارية</strong>
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        شخص ما يريد الاتصال بك. فيما يلي تفاصيل المستخدم:
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        اسم : <strong>{{ $name }}</strong>
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        البريد الإلكتروني : <a href="mailto:{{ $email }}" target="_blank" style="display:inline-block;padding:0;margin:0px;text-decoration:underline;font-family:'Lato', Arial, sans-serif;font-size:14px;font-weight:normal;font-style:normal;line-height:22px;color:#4D90FE;">{{ $email }}</a>
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        التليفون المحمول : <strong>{{ $number }}</strong>
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        رسالة : {{ $msg }}
    </p>
    <br>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        <strong>عند,<br/> {{ $name }}</strong>
    </p>
  </td>
</tr>
@endsection