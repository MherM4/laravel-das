<form action="/login" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Էլ․ հասցե" required>
    <input type="password" name="password" placeholder="Գաղտնաբառ" required>

    <button type="submit">Մուտք գործել</button>
</form>

@if(session('success'))
    <div style="color: green; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif
