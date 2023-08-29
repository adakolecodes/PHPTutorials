<?php
session_start();
include_once 'config/db-connect.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM posts_temporal WHERE id = $id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Add navbar -->
    <?php include_once 'components/navbar.php'; ?>
    <!-- Feedback message -->
    <?php include_once 'components/feedback-message.php'; ?>

    <?php
        //Display success message if success session is set
        if(isset($_SESSION['success'])){
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }
        //Display error message if error session is set
        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }
    ?>
    <div class="container mt-5 mb-5">
        <div>
            <h1>Create Post</h1>
        </div>
        <div class="mt-5">
            <form action="processes/process-create-post2.php" method="post" enctype="multipart/form-data">
                <input type="text" name="id" value="<?php if(!empty($post['id'])){ echo $post['id'];}; ?>" hidden>
                <div class="row">
                    <div class="col-md-6">
                        <label for="title">Title*</label>
                        <input type="text" name="title" id="title" placeholder="Title" class="form-control shadow-sm" value="<?php if(!empty($post['title'])){ echo $post['title'];}; ?>" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="body">Body*</label>
                        <textarea name="body" id="body" rows="5" placeholder="Body" class="form-control shadow-sm" required><?php if(!empty($post['body'])){ echo $post['body'];}; ?></textarea>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="title">Image*</label>
                        <input type="file" name="featured_image" id="featured_image" class="form-control shadow-sm" required>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <?php if(isset($_GET['id'])){ ?>
                            <button type="submit" name="update" class="btn btn-secondary">Update Post</button>
                        <?php } else {?>
                            <button type="submit" name="create" class="btn btn-secondary">Create Post</button>
                        <?php }?>
                    </div>
                </div>
            </form>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>