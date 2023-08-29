<?php 
session_start();
include_once 'classes/Blog.php';
$blog = new Blog();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $post = $blog->getPostById($id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include_once 'components/navbar.php'; ?>
    <div class="container mt-5 mb-5">
        <div class="mb-5">
            <img src="uploads/<?php echo $post['featured_image']; ?>" alt="" class="img-fluid rounded-2 shadow-sm" width="50%">
        </div>
        <div>
            <h1><?php echo $post['title']; ?></h1>
            <p><?php echo $post['body']; ?></p>
        </div>
        <div>
            <a href="create-post.php?id=<?php echo $id; ?>" class="btn btn-secondary bt-sm">Edit</a>
            <a href="processes/delete-post.php?id=<?php echo $id; ?>" class="btn btn-secondary bt-sm">Delete</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>