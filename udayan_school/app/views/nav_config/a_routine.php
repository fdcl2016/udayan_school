<div class="span12">

    <div class="widget ">

        <div class="widget-header">
            <i class="icon-list-ul"></i>
            <h3>Routine</h3>
        </div>
        <div class="widget-content">
            <div class="tabbable">
                <ul class="nav nav-tabs">

                    <li <?php if($rasel == 1) echo "class='active'";?>>
                        <a href="../routine/create_routine">Create Routine</a>
                    </li>
                    <li <?php if($rasel == 2) echo "class='active'";?>>
                        <a href="../routine/create_configuration">Create Configuration</a>
                    </li>
                    <li <?php if($rasel == 3) echo "class='active'";?>>
                        <a href="../routine/list_of_configuration">List of Configuration</a>
                    </li>
                    <li <?php if($rasel == 4) echo "class='active'";?>>
                        <a href="../routine/view_routine">View Routine Status</a>
                    </li>
                </ul>