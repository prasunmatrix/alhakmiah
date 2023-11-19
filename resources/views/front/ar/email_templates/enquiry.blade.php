@extends('front.ar.email_templates.layouts.general')

@section('content')

<tr>
  <td style="background:rgb(223, 223, 223); border:1px solid #ececec;  margin:0; padding:40px; color:#000; font-family:Arial, Helvetica, sans-serif;">
    <h2 style="display:block;margin:0 auto 20px;padding:0;font-family:'Lato', Arial, sans-serif;font-size:24px;font-weight:700;font-style:normal;line-height:26px;color:#292929;text-decoration:none;text-align: center;">تحقيق جديد</h2>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        <strong>يا فريق العمل,</strong>
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        بيانات الاستفسار الجديدة هي كما يلي:
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        اسم : <strong>{{ $name }}</strong>
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        البريد الإلكتروني : <a href="mailto:{{ $email }}" target="_blank" style="display:inline-block;padding:0;margin:0px;text-decoration:underline;font-family:'Lato', Arial, sans-serif;font-size:14px;font-weight:normal;font-style:normal;line-height:22px;color:#4D90FE;">{{ $email }}</a>
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        المشروع : <strong>{{ $project_name }}</strong>
    </p>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        من الموقع : {{ $fromsite }}
    </p>
    <br>
    <p style="font-size: 14px; line-height: 26px; font-weight: 400;">
        <strong>عند,<br/> {{ $name }}</strong>
    </p>
  </td>
</tr>
@endsection