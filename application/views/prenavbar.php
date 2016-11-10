<div class="navbar navbar-inverse set-radius-zero">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="nav-brand" href="<?php echo base_url();?>home">
                    <img style="height: 180%; width: auto;" src="assets/img/header.png">
                </a>
            </div>
            <div class="right-div">
                Hallo, <b><?php echo $this->session->userdata('user_data')['name']; ?></b>
            </div>

        </div>
    