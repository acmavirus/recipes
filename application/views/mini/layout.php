<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view(PATH . "__head"); ?>
</head>

<body>
    <div class="wrapper-frame">
        <?php $this->load->view(PATH . "_header"); ?>
        <?php if (!empty($main_content)) echo $main_content; ?>
        <?php $this->load->view(PATH . "_footer"); ?>
    </div>
    <?php $this->load->view(PATH . "__script"); ?>
</body>

</html>