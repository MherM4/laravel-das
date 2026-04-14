<form action="/register" method="POST">
    @csrf <input type="text" name="name" placeholder="Անուն" required>
    <input type="email" name="email" placeholder="Էլ․ հասցե" required>
    <input type="password" name="password" placeholder="Գաղտնաբառ" required>
    <input type="password" name="password_confirmation" placeholder="Կրկնել գաղտնաբառը" required>

    <button type="submit">Գրանցվել</button>
</form>
