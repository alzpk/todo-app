<div style="width:400px; position: fixed; bottom: 20px; right: 20px;">

    @if(session('success'))

        <div class="card bg-success text-white flash-msg success" style="display: none;">
            <div class="card-header">
                <i class="fa fa-window-close mt-1 float-right hide-flash-msg" style="cursor: pointer;"></i>
                <h5 class="mb-0"><i class="fa fa-check"></i> Success</h5>
            </div>
            <div class="card-body">
                {{ session('success') }}
            </div>
        </div>

    @elseif(session('error'))

        <div class="card bg-danger text-white flash-msg error" style="display: none;">
            <div class="card-header">
                <i class="fa fa-window-close mt-1 float-right hide-flash-msg" style="cursor: pointer;"></i>
                <h5 class="mb-0"><i class="fa fa-times-circle"></i> Error</h5>
            </div>
            <div class="card-body">
                {{ session('error') }}
            </div>
        </div>

    @endif

</div>
