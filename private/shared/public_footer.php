  <footer>
    <p>Copyright <?php echo date('Y'); ?>, Globe Bank International </p>
  </footer>
  <p>This is a fictitious company created by <a href="http://linkedin.com">LinkedIn Corporation, or its affiliates</a>, solely for the creation and development of educational training materials. Any resemblance to real products or services is purely coincidental. Information provided about the products or services is also fictitious and should not be construed as representative of actual products or services on the market in a similar product or service category.</p>
  <?php if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1')) ) {?>
	<script src="//localhost:35729/livereload.js"></script>
  <?php
      }
  ?>
  <script src="<?php echo url_for('/assets/build/main.min.js');?>"></script>
  </body>
</html>