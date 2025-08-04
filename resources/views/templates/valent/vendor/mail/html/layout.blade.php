<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ site('name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            padding: 24px 0;
            font-family: 'Noto Sans', sans-serif;
        }

        .container {
            width: 100%;
            overflow: auto;
            padding: 12px;
        }

        .email-wrapper {
            max-width: 1200px;
            background-color: white;
            margin: auto;
        }

        .header {
            height: 25vh;
            background-color: #C3D8FF;
            display: flex;
            align-items: center;
            position: relative;
        }

        .header img.bg-img {
            position: absolute;
            right: 0;
            height: 100%;
        }

        .header .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            padding: 0 40px;
        }

        .content {
            width: 100%;
            padding: 7rem 20px;
            margin-bottom: 40px;
            font-size: 18px;
            line-height: 1.6;
            text-align: justify;
            display: block;
            box-sizing: border-box;
        }

        .footer {
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
        }

        .footer p {
            color: #B4B1B1;
            margin-bottom: 12px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .social-icons div {
            padding: 10px;
            background-color: #F9F8F8;
            border-radius: 6px;
        }

        .contact-section {
            background-color: #3F7DF2;
            width: 95%;
            margin: auto;
            border-radius: 10px 10px 0 0;
            padding: 16px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .contact-item {
            display: flex;
            gap: 10px;
            align-items: center;
            color: white;
            flex: 1 1 30%;
        }

        .contact-icon {
            padding: 12px;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="email-wrapper">
            <div class="header">
                <img src="{{ asset('assets/templates/valent/images/vector-illustration-bitcoin-crypto1.png') }}"
                    alt="crypto-img" class="bg-img">
                <div class="overlay">
                    <img src="{{ asset('assets/images/' . site('logo_rec')) }}" alt="logo">
                </div>
            </div>
            <div class="content" style="margin:7rem 0px;">

                {{ Illuminate\Mail\Markdown::parse($slot) }}

                {{ $subcopy ?? '' }}

            </div>
            <div class="footer">

                <div class="social-icons">
                    @php
                        $socialMedia = ['instagram', 'facebook', 'pinterest', 'twitter', 'youtube', 'linkedin'];
                    @endphp
                    @foreach ($socialMedia as $media)
                        @if (site($media))
                            <div>
                                <a href="{{ site($media) }}">
                                    <img src="{{ asset('/assets/templates/valent/images/icon/blue_social_icon_' . $media . '.svg') }}"
                                        alt="icon">
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
            <div class="contact-section">
                <div class="contact-item">
                    <div class="contact-icon"><img
                            src="{{ asset('assets/templates/valent/images/icon/white-outline-email.svg') }}"
                            alt="icon">
                    </div>
                    <div>
                        <p><strong>Email</strong></p>
                        <p>{{ site('email') }}</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><img
                            src="{{ asset('assets/templates/valent/images/icon/white-outline-phone-line.svg') }}"
                            alt="icon"></div>
                    <div>
                        <p><strong>Phone</strong></p>
                        <p>{{ site('phone') }}</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon"><img
                            src="{{ asset('assets/templates/valent/images/icon/white-outline-location.svg') }}"
                            alt="icon"></div>
                    <div>
                        <p><strong>Location</strong></p>
                        <p>{{ site('address') }}, {{ site('city') }}, {{ site('state') }}, {{ site('country') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
