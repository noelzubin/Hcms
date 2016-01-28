
    @extends('doctor.master')

    @section('title', 'doctor login')


    @section('content')

        <form action="login" method="POST">
            <label for="usrname">Username:</label>
            <input type="text" name="name">
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
