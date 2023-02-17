<!-- Modal -->
<div class="modal fade authModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body card flex text-center">
            <h3 class="chronoCommunity"><span class="chronoCommunity">Chronostep </span> <span class="chronoCommunity1">Community</span>  </h3>
            <h6 class="welcome">Welcome to the amazing community of engineers in Chronostep Inc.</h6>
            <div class="my-auto mt-2">
                <button class="btn btn-dark registerBtn">
                    <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                        Create Account
                    </a>
                </button><br>
                <span class="ms-auto me-auto text-light">or</span><br>
                <button class="btn btn-transparent">
                    <a href="{{ route('login') }}" class="text-decoration-none text-white login">
                        Login
                    </a>
                </button>
            </div>
        </div>
      </div>
    </div>
  </div>
