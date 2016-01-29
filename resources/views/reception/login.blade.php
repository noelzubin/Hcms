
    @extends('reception.master')

    @section('title', 'desk login')


    @section('content')

        <form action="login" method="POST">
            <label for="id">id:</label>
            <input type="text" name="id">
            <label for="password">password:</label>
            <input type="password" name="password">
            <input type="submit" value="submit">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <li> {{ $error }}...<li>
                @endforeach
            @endif
        </form>

    @endsection
