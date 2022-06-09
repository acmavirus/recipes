<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("default/__head"); ?>
</head>

<body>
    <?php $this->load->view("default/$onePage->slug/_header"); ?>
    <?php if (!empty($main_content)) echo $main_content; ?>
    <?php $this->load->view("default/$onePage->slug/_footer"); ?>

    <?php $this->load->view("default/__script"); ?>
</body>

</html>