<nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, hsla(231, 48%, 48%, 1) 0%, hsla(211, 36%, 46%, 1) 100%); height: 70px;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/boleto"><img width="110" class="text-center" src="{{ asset('images/CobreOnline.svg') }}" alt="Logo Cobre Online"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link navgation" href="{{ route ('cliente.index') }}"><i class="bi bi-people-fill mx-1"></i>CLIENTES</a>
        </li>
        <li class="nav-item">
            <a class="nav-link navgation" href="{{ route ('boleto.index') }}"><i class="bi bi-coin mx-1"></i>BOLETOS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link navgation" href="{{ route ('contrato.index') }}"><i class="bi bi-receipt mx-1"></i>VENDAS/CONTRATOS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link navgation" href="{{ route ('contrato.create') }}"><i class="bi bi-plus-lg mx-1"></i>EMITIR COBRANÇA</a>
        </li>
      </ul>
      <span class="navbar-text">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn-logout" type="submit"><i class="bi bi-box-arrow-right"></i></button>
        </form>
      </span>
    </div>
  </div>
</nav>
