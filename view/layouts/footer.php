    <div class="w-100 text-center" id="">Copyright <?php echo date("Y", time()); ?>, Chat App</div>
    </div>
    
    <script type="text/javascript" src="includes/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="includes/js/bootstrap.js"></script>
    <script type="text/javascript" src="includes/js/popper.min.js"></script>
    <script type="text/javascript" src="includes/js/ajax.js"></script>
    <script src="includes/js/jquery.js"></script>

    <script type="text/javascript" src="includes/js/script.js"></script>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>