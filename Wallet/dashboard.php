<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
}

$userId = $_SESSION['userid'];
$userEmail = $_SESSION['useremail'];

require_once "classes/Account.php";
$account = new Account();
require_once 'config/db-connect.php';
$accountBalance = $account->getAccountBalance($userId, $pdo);

$fundings = $account->getAllFundingsByUserId($userId);
$withdrawals = $account->getAllWithdrawalsByUserId($userId);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include_once 'components/navbar.php'; ?>
    <?php include_once 'components/feedback-message.php'; ?>
    <?php include_once 'components/fundwallet-modal.php'; ?>
    <?php include_once 'components/withdraw-modal.php'; ?>
    <div class="container mt-5 mb-5">
        <div>
            <h1>Dashboard</h1>
            <p>Welcome <?php echo $userEmail; ?></p>
            <hr>
        </div>
        <div class="mb-5">
            <div class="card">
                <div class="card-body p-5">
                    <h6 class="card-subtitle mb-2 text-body-secondary">Account Balance</h6> 
                    <h1 class="card-title mb-5">N<?php echo number_format($accountBalance['balance'], 2); ?></h1>
                    <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#fundWalletModal"><i class="bi bi-plus-circle-fill"></i> Fund Wallet</button>
                    <button type="button" class="btn btn-warning shadow-sm" data-bs-toggle="modal" data-bs-target="#withdrawModal"><i class="bi bi-plus-circle-fill"></i> Withdraw</button>
                </div>
            </div>
        </div>
        <div class="mb-5">
            <div class="mb-3">
                <h5>Transaction History</h5>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Fundings</h6>
                        <div class="list-group list-group-item-success">
                            <?php foreach($fundings as $funds): ?>
                            <a href="" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">N<?php echo number_format($funds['amount'], 2); ?></h5>
                                </div>
                                <small class="text-body-secondary"><?php echo $funds['date_of_transaction']; ?></small>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Withdrawals</h6>
                        <div class="list-group list-group-item-danger">
                            <?php foreach($withdrawals as $withdrawn): ?>
                            <a href="" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">N<?php echo number_format($withdrawn['amount'], 2); ?></h5>
                                </div>
                                <small class="text-body-secondary"><?php echo $withdrawn['date_of_transaction']; ?></small>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>