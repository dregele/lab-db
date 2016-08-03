<!DOCTYPE html>

<html lang="en">

<head>


  <meta charset="utf-8" />
  <style type="text/css">

      #container {
        position: relative;
        font-family:sans-serif;
        font-size:0.8em;
        max-width: 700px;
      }

      #header {
        position: relative;
        margin-top: 1em;
        margin-bottom: 2em;
      }

      #toprow {
        clear: both;
        margin-top: 1em;
      }

      #main {
        margin-top: 1em;
        max-width: 700px;
      }

      #logo {
        float:left;
        font-size:1.3em;
        font-family:sans-serif;
        font-weight:bolder;
        
      }

      #tablename {
        font-size:1.3em;
        font-family:sans-serif;
        font-weight: 100;

      }

      #entryname {
        font-size:1.5em;
        font-family:arial, sans-serif;
        font-weight:bold;
        margin: 1em;
      }

      .location {
        font-size:0.8em;
      }

      #description {
        font-size:1em;
        margin: 0.5em;
        margin-bottom: 2em;
      }

      #comment {
        margin: 1em;
      }

      .row {
        clear: both;
        display: inline-block;
          margin: 0.5em 0em 0.15em 0.15em;
          width: 100%;
      }

      .fieldname {
        float:left;
        width:  30%;
        font-size:0.9em;
        font-weight:bold;
      }

      .fieldvalue {
        font-size:0.9em;
        float:left;
        width:  60%;
      }
      
      .longfield {
      word-wrap: break-word;         /* All browsers since IE 5.5+ */
      overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
      width: 100%;
      }

  </style>

<title>Login</title>

</head>

<body>
<div id="logo">AanstadLab</div><div id="tablename">Database</div>
<br />
<div id="container">
<h2><?php echo lang('login_heading');?></h2>

<?php echo form_open("auth/login");?>

  <p>
    <div class="fieldname"><?php echo lang('login_identity_label', 'identity');?></div>
    <div class="fieldvalue"><?php echo form_input($identity);?></div>
  </p>

   <p>
    <div class="fieldname"><?php echo lang('login_password_label', 'password');?></div>
    <div class="fieldvalue"><?php echo form_input($password);?></div>
  </p>


  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>

  <p><div class="fieldname"><?php echo form_submit('submit', lang('login_submit_btn'));?></div></p>

<?php echo form_close();?>

</div>
</body>
</html>
