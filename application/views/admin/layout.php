<!DOCTYPE html>
<html lang="en">
<?php if (!empty($__head)) echo $__head;
else $this->load->view('admin/__head'); ?>
<?php if (!empty($page) && !empty($this->load->view("admin/$page/__style", [], true))) $this->load->view("admin/$page/__style"); ?>
<script>
    let base_url = '<?php echo base_url(); ?>';
</script>

<body data-sidebar="dark">
    <?php if (!empty($main)) echo $main; ?>
    <?php if (!empty($__script)) echo $__script;
    else $this->load->view('admin/__script'); ?>
    <?php if (!empty($page) && !empty($this->load->view("admin/$page/__script", [], true))) $this->load->view("admin/$page/__script"); ?>
</body>

</html>