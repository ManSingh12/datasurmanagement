
 <div class="nave-top-wgs">
    <nav class="navbar navbar-inverse ">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand"></a>
            </div>
            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                  <li id="home"  class="nav-item"><a href="<?php echo $modulelink; ?>&action=home" class="home"><i class="wgs-flat-icon fa fa-home"></i> Homepage</a></li>
                  <li class="dropdown"><a class="dropdown-toggle reporting" data-toggle="dropdown" href="#" aria-expanded="false"><i class="wgs-flat-icon fa fa-file"></i>Reporting<span class="caret"></span></a>
                    <ul class="dropdown-menu" style="position:absolute;">
                      <li><a href="<?php echo $modulelink; ?>&action=sales" class="sales"><i class="wgs-flat-icon fa fa-file"></i>Sales</a></li>						
                      <li><a href="<?php echo $modulelink; ?>&action=services" class="services"><i class="wgs-flat-icon fa fa-file"></i>Services</a></li>						
                      <li><a href="<?php echo $modulelink; ?>&action=marketing"><i class="wgs-flat-icon fas fa-poll"></i>Marketing</a></li>			
                    </ul>
                  </li>
                  <li id="contact"  class="nav-item"><a href="<?php echo $modulelink; ?>&action=fullsaleprocess" class="fullsaleprocess"><i class="wgs-flat-icon fas fa-poll"></i>Full Sales Process</a></li>
                  <li id="contact"  class="nav-item"><a href="<?php echo $modulelink; ?>&action=progressbar" class="progressbar"><i class="wgs-flat-icon fas fa-poll"></i>Progress Bar</a></li>
                  <li id="contact"  class="nav-item"><a href="<?php echo $modulelink; ?>&action=kpi_details" class="kpi_details"><i class="wgs-flat-icon fas fa-ticket-alt fa-fw"></i>KPI For Support Tickets</a></li>
                </ul>
            </div>
        </nav>

 </div>
  