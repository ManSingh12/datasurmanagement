
<link rel="stylesheet" href="<?php echo $style_css?>">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="<?php echo $fonts_css?>">
<link rel="stylesheet" href="<?php echo $gcustom_css?>">
<script src="<?php echo $custom_js?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="header_datasur">
    <?php
         include("".__DIR__."/header.php");
    ?>
</div>
<div class="contant_datasur">
    <?php 
        // echo "hello";
        // die();
        if(isset($_GET['action']) && file_exists("".__DIR__."/".$_GET['action'].".php"))
        {
            $page=$_GET['action'];
            include("".__DIR__."/".$page.".php");
        }
        else
        {
            include("".__DIR__."/home.php");
            $page='home';   
        }
    ?>
</div>
<script>
    var page='<?php echo $page ?>';
    if(page=='sales' || page=='services' || page=='marketing')
    {
        page='reporting';
    }
    else if(page=='file_list')
    {
        page='home';
    }
    jQuery('.'+page).css("color","#4d8ac7");
</script>

<div class="footer_datasur">

    <?php
        // include("".__DIR__."/footer.php");
    ?>
</div>
