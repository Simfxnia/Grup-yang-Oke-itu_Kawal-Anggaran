<link href="{{ asset('css/navstyle.css') }}" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="divlog">
    <a href="/">
      <img class="logo" src="{{ asset('img/logo_KA.svg') }}" alt="K | A">
    </a>
  </div>
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-around" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ ($title === "Regional Income" ? 'active' : '') }}" href="/dashboard/regIncome" id="regNavIncome">Regional Income</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === "Regional Expenditure" ? 'active' : '') }}" href="/dashboard/regExp" id="regNavExpend">Regional Expenditure</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === "Regional Financing" ? 'active' : '') }}" href="/dashboard/regFin" id="regNavFinance">Regional Financing</a>
        </li>
      </ul>
    </div>
  </div>
</nav>