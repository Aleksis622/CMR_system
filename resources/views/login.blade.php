
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <h2>Login</h2>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <form action="/login" method="POST">
        @csrf

        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder = "Name" required>
        </div>

        <div>
            <label>E-mail</label>
            <input type="email" name="email" placeholder = "E-mail" required>
        </div>

        <div>
            <label>Password</label>
            <input type="password" name="password" placeholder = "Password" required>
        </div>

        <button type="submit">Login</button>
    </form>

</body>
</html>