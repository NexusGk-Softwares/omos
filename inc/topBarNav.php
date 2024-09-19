<style>
  .user-img{
      position: absolute;
      height: 27px;
      width: 27px;
      object-fit: cover;
      left: -7%;
      top: -12%;
  }
  .user-dd:hover{
    color:#fff !important
  }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient-danger">
            <div class="container px-4 px-lg-5 ">
                <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <a class="navbar-brand" href="./">
                <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                <?php echo $_settings->info('short_name') ?>
                </a>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link text-white" aria-current="page" href="./">Home</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="./?p=products">Products</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="./?p=about">About</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="./?p=contact">Contact Us</a></li>
                        <?php 
                        if($_settings->userdata('id') != '' && $_settings->userdata('id') != 2):
                          $cart = $conn->query("SELECT SUM(quantity) FROM `cart_list` where customer_id = '{$_settings->userdata('id')}' ")->fetch_array()[0];
                        endif;
                        $cart = isset($cart) && $cart > 0 ? $cart : '';
                        ?>
                        <?php if($_settings->userdata('id') != '' && $_settings->userdata('login_type') == 2): ?>
                          <li class="nav-item"><a class="nav-link text-white" href="./?p=cart_list">Cart <span class="ml-2 badge badge-primary"><?= $cart > 0 ? format_num($cart) : '' ?></span></a></li>
                      <?php endif;?>
                    </ul>
                    <div class="d-flex align-items-center">
                    <?php if($_settings->userdata('id') != '' && $_settings->userdata('login_type') == 2): ?>
                      <div class="btn-group nav-link">
                        <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2 user-img" alt="User Image"></span>
                          <span class="ml-3"><?php echo ucwords($_settings->userdata('firstname').' '.$_settings->userdata('lastname')) ?></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="<?php echo base_url.'?p=user' ?>"><span class="fa fa-user"></span> My Account</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?php echo base_url.'?p=orders' ?>"><span class="fa fa-table"></span> My Orders</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?php echo base_url.'/classes/Login.php?f=logout_customer' ?>"><span class="fas fa-sign-out-alt"></span> Logout</a>
                        </div>
                    </div>
                    <?php else: ?>
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./login.php">Login</a>
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./register.php">Register</a>
                        <a class="font-weight-bolder text-light mx-2 text-decoration-none" href="./admin">Admin Panel</a>
                    <?php endif;?>
                    </div>
                </div>
            </div>
        </nav>
<script>
  $(function(){
    $('#search_report').click(function(){
      uni_modal("Search Request Report","report/search.php")
    })
    $('#navbarResponsive').on('show.bs.collapse', function () {
        $('#mainNav').addClass('navbar-shrink')
    })
    $('#navbarResponsive').on('hidden.bs.collapse', function () {
        if($('body').offset.top == 0)
          $('#mainNav').removeClass('navbar-shrink')
    })
  })

  $('#search-form').submit(function(e){
    e.preventDefault()
     var sTxt = $('[name="search"]').val()
     if(sTxt != '')
      location.href = './?p=products&search='+sTxt;
  })
</script>