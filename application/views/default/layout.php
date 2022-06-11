<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view("default/__head"); ?>
</head>

<body>
    <?php $this->load->view("default/$onePage->slug/_header"); ?>
    <?php if (!empty($main_content)) echo $main_content; ?>
    <?php $this->load->view("default/$onePage->slug/_footer"); ?>

    <div class="progress-wrap active-progress">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 169.217;"></path>
        </svg>
    </div>

    <?php $this->load->view("default/__script"); ?>
</body>

</html>