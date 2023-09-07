<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Withdraw</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="processes/process-wallet.php" method="post">
                    <div class="mb-3">
                        <label for="amount" class="col-form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount" required>
                    </div>
                    <div>
                        <button type="submit" name="withdraw" class="btn btn-warning btn-sm">Withdraw</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>