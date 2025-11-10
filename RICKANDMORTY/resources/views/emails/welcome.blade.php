<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Rick & Morty Portal</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: #0d0d0d; color: #ffffff; padding: 20px; margin:0;">
    <div style="max-width:600px; margin: 30px auto; background: linear-gradient(180deg, #131313 0%, #1a1a1a 100%); padding: 28px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.6); border: 1px solid rgba(255,255,255,0.03);">
        <div style="display:flex; align-items:center; gap:16px; margin-bottom:18px;">
            <div style="width:56px; height:56px; border-radius:10px; background: linear-gradient(135deg, #00ff99, #00b5cc); display:flex; align-items:center; justify-content:center; font-weight:700; color:#001; font-size:22px;">
                ⚛
            </div>
            <div>
                <h1 style="margin:0; font-size:20px; color:#00ff99; letter-spacing:0.6px;">Welcome, {{ $user->name }}!</h1>
                <p style="margin:4px 0 0 0; color:#aeb7b0; font-size:13px;">You're in — welcome to the Rick & Morty Portal.</p>
            </div>
        </div>

        <div style="background: rgba(255,255,255,0.02); padding:16px; border-radius:8px; border:1px solid rgba(255,255,255,0.02);">
            <p style="margin:0 0 12px 0; color:#e6f9f0; line-height:1.5;">
                Thanks for joining! You can now explore characters, locations, and episodes across the multiverse.
            </p>

            <ul style="margin:0 0 14px 18px; color:#bcdccf; font-size:14px; line-height:1.6;">
                <li>Browse <strong>Characters</strong> — all 800+ entities.</li>
                <li>Travel to <strong>Locations</strong> and discover dimensions.</li>
                <li>Relive your favorite <strong>Episodes</strong> and see character appearances.</li>
            </ul>

            <p style="margin:0 0 10px 0; color:#cfeee2;">If you ever need help, reply to this email — we got your back across dimensions.</p>

            <div style="margin-top:14px;">
                <a href="{{ url('/') }}" style="display:inline-block; padding:10px 18px; border-radius:10px; background: linear-gradient(90deg,#00ff99,#00b5cc); color:#001; text-decoration:none; font-weight:700;">Enter the Portal</a>
            </div>
        </div>

        <p style="margin:18px 0 0 0; font-size:12px; color:#9aa69f;">
            Happy adventures! 🚀
        </p>

        <p style="margin:8px 0 0 0; font-size:12px; color:#7f8b84;">
            — The Rick & Morty Portal Team
        </p>
    </div>
</body>
</html>
