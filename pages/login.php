<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="../actions/login_action.php" method="POST">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <select name="role" required>
            <option value="RH">RH</option>
            <option value="Secretaria">Secretaria</option>
            <option value="Professor">Professor</option>
            <option value="Aluno">Aluno</option>
        </select>
        <button type="submit">Login</button>
    </form>
</body>
</html>
