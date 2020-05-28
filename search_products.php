<?php 

$products = [];

if( isset($_GET['submit']) ){
  
  $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
  $search = trim($search);

  if( $search ){

    $dbcon = 'mysql:host=localhost;dbname=eshop;charset=utf8';
    $db = new PDO($dbcon, 'root', '');
    $sql = "SELECT * FROM products WHERE title LIKE ? OR body LIKE ?";
    $query = $db->prepare($sql);
    $query->execute(["%$search%", "%$search%"]);
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    
  }

}

function old($fn){
  return $_REQUEST[$fn] ?? '';
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <title>Search Products - autocomplete with ajax</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-12 mt-3">
        <h1 class="display-4">Search Products - autocomplete with ajax</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8 mt-3">
        <form id="search-products-from" action="" method="GET" autocomplete="off" novalidate="novalidate">
          <div class="form-group">
            <label for="search" class="d-none">Search Product</label>
            <div class="input-group mb-3">
              <input value="<?= old('search'); ?>" type="text" class="form-control" placeholder="Search Product"
                name="search" id="search">
              <div class="input-group-append">
                <button name="submit" class="btn btn-primary search-btn" type="submit" id="button-addon2">Go</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php if( !empty($search)): ?>
    <div class="row">
      <div class="col-12 mt-3">
        You search for: <b><?= $search; ?></b>, <?= count($products) ?> products found
      </div>
    </div>
    <?php endif; ?>
    <?php if( !empty($products) ): ?>
    <div class="row">
      <?php foreach($products as $product): ?>
      <div class="col-12 mt-3">
        <div class="card">
          <div class="card-header">
            <?= $product['title']; ?>
          </div>
          <div class="card-body">
            <p><?= $product['body']; ?></p>
            <p><b>Price: </b>$<?= $product['price']; ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="js/script.js"></script>
</body>

</html>