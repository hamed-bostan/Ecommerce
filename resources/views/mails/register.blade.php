<h2>Email from ClickHub</h2>
<h2>Hi {{ $first_name }}</h2>
<h3>Thank you for registering in our site, To verify your account click on link below</h3>

<a href={{ "http://localhost:8000/api/activation/" . $activation_token }}>ACTIVATING YOUR ACCOUNT</a>
