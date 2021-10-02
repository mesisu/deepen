@extends('layouts.home')
@section('content')
<header>
  <div class="header1">
    <h1>
      <span>Deepen</span>
    </h1>
    <nav>
       <ul>
        <li>
            <a href="{{route('register') }}" class="btn-circle-fishy">
               Register
            </a>
        </li>
        <li>
            <a href="{{route('login') }}" class="btn-circle-fishy">
               Login
            </a>
        </li>
       </ul>
    </nav>
  </div>
</header>


@endsection


    



